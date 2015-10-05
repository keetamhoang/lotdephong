<?php
App::uses('AdminAppController', 'Admin.Controller');

/**
 * AdminPosts Controller
 *
 */
class AdminPostsController extends AdminAppController
{

    public $scaffold;

    public $uses = array('Event', 'Link', 'Post', 'Follow');

    public function index()
    {
        $heading = 'Post';
        $overview = 'Tất cả';

        $this->set(compact('heading', 'overview'));

        $keyword = !empty($this->params->query['search'])?$this->params->query['search']:'';

        if ($keyword) {
            $keyword = '%'.$keyword.'%';
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'conditions' => array(
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
                'order' => array('Post.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        }

        $allPosts = $this->Paginator->paginate('Post');

        $this->set(compact('allPosts'));
    }

    public function add($id = null)
    {
        $heading = 'Post';
        $overview = 'Thêm mới';

        $this->set(compact('heading', 'overview'));

        $options = array(
            'recursive' => -1,
            'fields' => array('id', 'name'),
            'order' => array('id' => 'desc')
        );

        $listEvents = $this->Event->find('all', $options);

        $this->set(compact('listEvents'));

        if ($this->request->is('post')) {
            $data['Post'] = $this->data['Post'];
            $data['Link'] = $this->data['Link'];

            if (is_uploaded_file($data['Post']['image']['tmp_name'])) {
                $image = $data['Post']['image'];
                $imageName = $image['name'];
                $dir = WWW_ROOT . 'img\main\posts';
                $slas = '\\';

                if (file_exists($dir . $slas . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . $imageName;
                }

                if (move_uploaded_file($image['tmp_name'], $dir . $slas . $imageName)) {
                    $data['Post']['img'] = $imageName;
                } else {
                    $this->Session->setFlash(__('Ảnh tải lên không hợp lệ'), 'warning');
                }
            }

            $this->Post->create();

            if ($this->Post->save($data['Post'])) {
                $this->Session->setFlash(__('Post mới đã được thêm thành công.'), 'warning');

                $lastId = $this->Post->getLastInsertId();

                //update link
                foreach ($data['Link']['name'] as $key => $value) {
                    $this->Link->create();
                    $input = array();
                    $input['name'] = $value;
                    $input['post_id'] = $lastId;
                    $input['link'] = $data['Link']['link'][$key];
                    $this->Link->save($input);
                }

                //notification
                $this->Follow->updateAll(
                    array('is_read' => '0', 'updated_at' => 'NOW()'),
                    array('followed' => '1', 'event_id' => $data['Post']['event_id'])
                );

                //Update time event
                $this->Event->updateAll(
                    array('updated_at' => 'NOW()'),
                    array('id' => $data['Post']['event_id'])
                );

                //clear cache
                $this->clearCache();

                $this->redirect(array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $lastId));
            } else {
                $this->Session->setFlash(__('Lỗi! Sự kiện thêm không thành công, hãy thử lại!'));
            }
        } else {
            $this->request->data['id_event'] = 0;

            if ($id != null) {
                $this->request->data['id_event'] = $id;
            }
        }
    }

    public function edit($id = null)
    {
        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy bài viết này.'));
        }

        $heading = 'Post';
        $overview = 'Chỉnh sửa';

        $this->set(compact('heading', 'overview'));

        $options = array(
            'recursive' => -1,
            'fields' => array('id', 'name'),
            'order' => array('id' => 'desc')
        );

        $listEvents = $this->Event->find('all', $options);

        $this->set(compact('listEvents'));

        if ($this->request->is(array('post', 'put'))) {

            $data['Post'] = $this->request->data['Post'];
            $data['Link'] = $this->request->data['Link'];

            $image = $data['Post']['image'];

            if (!empty($image['tmp_name'])) {
                $imageName = $image['name'];
                $dir = WWW_ROOT . 'img\main\posts';
                $slas = '\\';

                if (file_exists($dir . $slas . $imageName)) {
                    //create full filename with timestamp
                    $imageName = date('His') . $imageName;
                }

                if (move_uploaded_file($image['tmp_name'], $dir . $slas . $imageName)) {
                    $data['Post']['img'] = $imageName;
                } else {
                    $this->Session->setFlash(__('Ảnh tải lên không hợp lệ'), 'warning');
                }
            }

            if ($this->Post->save($data['Post'])) {
                $this->Session->setFlash(__('Sự kiện đã được cập nhật thành công.'), 'warning');

                $this->Link->deleteAll(array('post_id' => $id), true);
                //update link
                foreach ($data['Link']['name'] as $key => $value) {
                    $this->Link->create();
                    $input = array();
                    $input['name'] = $value;
                    $input['post_id'] = $id;
                    $input['link'] = $data['Link']['link'][$key];
                    $this->Link->save($input);
                }

                //clear cache
                $this->clearCache();

                $this->redirect(array('plugin' => 'admin', 'controller' => 'posts', 'action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('Lỗi! Sự kiện chưa được cập nhật, hãy thử lại!'), 'warning');
            }
        } else {
            $options = array('recursive' => -1, 'conditions' => array('Post.' . $this->Post->primaryKey => $id));
            $this->request->data = $this->Post->find('first', $options);

            $options = array('recursive' => -1, 'conditions' => array('post_id' => $id), 'fields' => array('id', 'name', 'link'));
            $this->request->data['Link'] = $this->Link->find('all', $options);
        }
    }

    public function delete($id = null) {
        $this->autoRender = false;

        if (!$this->Post->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy post này.'));
        }

        if ($this->Post->delete($id, $cascade = true)) {
            $this->Session->setFlash(__('Xóa thành công post'), 'warning');

            //clear cache
            $this->clearCache();

            $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công posts'), 'warning');
            $this->redirect($this->request->referer());
        }
    }
}
