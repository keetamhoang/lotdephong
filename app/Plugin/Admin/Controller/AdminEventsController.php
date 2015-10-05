<?php

App::uses('AdminAppController', 'Admin.Controller');

/**
 * AdminEvents Controller
 *
 */
class AdminEventsController extends AdminAppController {

    public $scaffold;
    public $uses = array('Event', 'CategoriesEvent', 'Category', 'Post', 'Follow', 'Waiting');

    public function index($page = 1) {
//        $this->request->params['named']['page'] = $page;

        $heading = 'Sự kiện';
        $overview = 'Tất cả';

        $this->set(compact('heading', 'overview'));

        $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'';

        if ($keyword) {
            $keyword = '%'.$keyword.'%';

            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'order' => array('Event.updated_at' => 'desc'),
                'conditions' => array('OR' => array('name LIKE' => $keyword, 'slug LIKE' => $keyword)),
                'limit' => $this->limit
            );
        } else {
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'order' => array('Event.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        }

        $eventsList = $this->Paginator->paginate('Event');

        $this->set(compact('eventsList'));
    }

    public function edit($id = null) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy sự kiện này.'));
        }

        $heading = 'Sự kiện';
        $overview = 'Chỉnh sửa';

        $this->set(compact('heading', 'overview'));
        
        if ($this->request->is(array('post', 'put'))) {

            $data = $this->request->data['Event'];

            $image = $data['image'];

            if (!empty($image['tmp_name'])) {
                $imageName = $image['name'];
                $dir = WWW_ROOT . 'img\main\posts';
                $slas = '\\';

                if (file_exists($dir . $slas . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . $imageName;
                }

                if (move_uploaded_file($image['tmp_name'], $dir . $slas . $imageName)) {
                    $data['img'] = $imageName;
                } else {
                    $this->Session->setFlash(__('Ảnh tải lên không hợp lệ'), 'warning');
                }
            }

            //updating hot old
            $data['updating'] = !empty($data['updating']) ? '1' : '0';
            $data['hot'] = !empty($data['hot']) ? '1' : '0';
            $data['old'] = !empty($data['old']) ? '1' : '0';

            if ($this->Event->save($data)) {
                $this->Session->setFlash(__('Sự kiện đã được cập nhật thành công.'), 'warning');

                //update correct slug
                $this->Event->id = $id;
                $slug = $id . '-' . $this->request->data['Event']['slug'];

                $this->Event->saveField('slug', $slug);

                //category
                $this->CategoriesEvent->deleteAll(array('event_id' => $id), true);

                if (!empty($this->request->data['Category'])) {
                    foreach ($this->request->data['Category'] as $category) {
                        $this->CategoriesEvent->create();
                        $this->CategoriesEvent->save(array('category_id' => $category, 'event_id' => $id));
                    }
                }

                //clear cache
                $this->clearCache();

                $this->redirect(array('plugin' => 'admin', 'controller' => 'events', 'action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('Lỗi! Sự kiện chưa được cập nhật, hãy thử lại!'), 'warning');
            }
        } else {
            $options = array('conditions' => array('Event.' . $this->Event->primaryKey => $id));
            $this->request->data = $this->Event->find('first', $options);

            $options = array(
                'joins' => array(
                    array(
                        'table' => 'categories_events',
                        'alias' => 'CE',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'CE.category_id = Category.id'
                        )
                    ),
                    array(
                        'table' => 'events',
                        'alias' => 'E',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'E.id = CE.event_id',
                            'E.id' => $id
                        )
                    )
                ),
                'recursive' => '2',
                'fields' => array('id', 'name')
            );

            $this->request->data['CategoriesEvent'] = $this->Category->find('all', $options);

            $this->request->data['Category'] = $this->Category->find('all', array(
                'recursive' => '-1',
                'fields' => array('id', 'name')
            ));
        }
    }

    public function add() {
        $heading = 'Sự kiện';
        $overview = 'Thêm mới';

        $this->set(compact('heading', 'overview'));

        if ($this->request->is('post')) {
            if (is_uploaded_file($this->request->data['image']['tmp_name'])) {
                $image = $this->request->data['image'];
                $imageName = $image['name'];
                $dir = WWW_ROOT . 'img\main\posts';
                $slas = '\\';

                if (file_exists($dir . $slas . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . $imageName;
                }

                if (move_uploaded_file($image['tmp_name'], $dir . $slas . $imageName)) {
                    $this->request->data['img'] = $imageName;

                    $this->Event->create();
                    if ($this->Event->save($this->request->data)) {
                        $this->Session->setFlash(__('Sự kiện mới đã được thêm thành công.'), 'warning');

                        //update correct slug
                        $lastId = $this->Event->getLastInsertId();
                        $this->Event->id = $lastId;
                        $slug = $lastId . '-' . $this->request->data['slug'];

                        $this->Event->saveField('slug', $slug);

                        return $this->redirect(array('plugin' => 'admin', 'controller' => 'events', 'action' => 'edit', $lastId));
                    } else {
                        $this->Session->setFlash(__('Lỗi! Sự kiện thêm không thành công, hãy thử lại!'), 'warning');
                    }
                } else {
                    $this->Session->setFlash(__('Ảnh tải lên không hợp lệ'), 'warning');
                }
            } else {
                $this->Session->setFlash(__('Hãy tải Ảnh Đại Diện cho sự kiện này'), 'warning');
            }
        } else {
            $this->request->data['Category'] = $this->Category->find('all', array(
                'recursive' => '-1',
                'fields' => array('id', 'name')
            ));
        }
    }

    public function delete($id = null) {
        $this->autoRender = false;

        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy sự kiện này.'), 'warning');
        }

        $this->Follow->deleteAll(array('event_id' => $id), true);
        $this->Post->deleteAll(array('event_id' => $id), true);
        $this->Waiting->deleteAll(array('event_id' => $id), true);

        if ($this->Event->delete($id, $cascade = true)) {
            $this->Session->setFlash(__('Xóa thành công sự kiện'), 'warning');

            //clear cache
            $this->clearCache();

            $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công sự kiện'), 'warning');
            $this->redirect($this->request->referer());
        }
    }

    public function view($id = null, $page = 1) {
        $heading = 'Sự kiện';

        $event = $this->Event->find('first', array(
            'recursive' => -1,
            'conditions' => array('id' => $id),
            'fields' => array('id', 'name', 'slug')
        ));

        $overview = $event['Event']['name'];

        $this->set(compact('heading', 'overview'));

        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy sự kiện này.'));
        }

        $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'';

        if ($keyword) {
            $keyword = '%'.$keyword.'%';
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'conditions' => array(
                    'Post.event_id' => $id,
                    'OR' => array(
                        'content LIKE' => $keyword,
                        'name LIKE' => $keyword,
                        'author LIKE' => $keyword
                    )
                ),
                'order' => array('Post.updated_at' => 'desc'),
                'limit' => $this->limit

            );
        } else {
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'conditions' => array('Post.event_id' => $id),
                'order' => array('Post.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        }

        $allPosts = $this->Paginator->paginate('Post');

        $this->set(compact('allPosts', 'event'));
    }

    public function censorship($id = null, $page = 1) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy sự kiện này.'));
        }

        $heading = 'Duyệt bài';

        $event = $this->Event->find('first', array(
            'recursive' => -1,
            'conditions' => array('id' => $id),
            'fields' => array('id', 'name', 'slug')
        ));

        $overview = $event['Event']['name'];
        $this->set(compact('heading', 'overview', 'event'));

        $this->Paginator->settings = array(
            'paramType' => 'querystring',
            'recursive' => -1,
            'conditions' => array('is_published' => 0, 'event_id' => $id),
            'order' => array('Waiting.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $postsList = $this->Paginator->paginate('Waiting');

        $this->set(compact('postsList'));
    }

}
