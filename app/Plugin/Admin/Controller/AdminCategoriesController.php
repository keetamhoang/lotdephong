<?php
App::uses('AdminAppController', 'Admin.Controller');

/**
 * AdminCategories Controller
 *
 */
class AdminCategoriesController extends AdminAppController
{
    public $scaffold;

    public $uses = array('Category');

    public function beforeRender() {
        parent::beforeFilter();
    }

    public function index()
    {
        $heading = 'Danh mục';
        $overview = 'Tất cả';

        $this->set(compact('heading', 'overview'));

        $keyword = !empty($this->params->query['search']) ? $this->params->query['search'] : '';

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'conditions' => array(
                    'OR' => array(
                        'name LIKE' => $keyword,
                        'slug LIKE' => $keyword,
                        'description LIKE' => $keyword
                    )
                ),
                'order' => array('Category.id' => 'desc'),
                'limit' => $this->limit
            );
        } else {
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'order' => array('Category.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        }

        $allCategories = $this->Paginator->paginate('Category');

        $this->set(compact('allCategories'));
    }

    public function add()
    {
        $heading = 'Danh mục';
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

                    $this->Category->create();
                    if ($this->Category->save($this->request->data)) {
                        $this->Session->setFlash(__('Danh mục mới đã được thêm thành công.'), 'warning');

                        //update correct slug
                        $lastId = $this->Category->getLastInsertId();
                        $this->Category->id = $lastId;
                        $slug = $lastId . '-' . $this->request->data['slug'];

                        $this->Category->saveField('slug', $slug);

                        //clear cache
                        $this->clearCache();

                        return $this->redirect(array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'edit', $lastId));
                    } else {
                        debug($this->Category->validationErrors); //show validationErrors

                        debug($this->Category->getDataSource()->getLog(false, false)); //show last sql query
                        die;
                        $this->Session->setFlash(__('Lỗi! Danh mục thêm không thành công, hãy thử lại!'), 'warning');
                    }
                } else {
                    $this->Session->setFlash(__('Ảnh tải lên không hợp lệ'), 'warning');
                }
            } else {
                $this->Session->setFlash(__('Hãy tải Ảnh Đại Diện cho danh mục này'), 'warning');
            }
        }
    }

    public function edit($id = null)
    {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy danh mục này.'));
        }

        $heading = 'Danh mục';
        $overview = 'Chỉnh sửa';

        $this->set(compact('heading', 'overview'));

        if ($this->request->is(array('post', 'put'))) {

            $data = $this->request->data;

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

            if ($this->Category->save($data)) {
                $this->Session->setFlash(__('Danh mục đã được cập nhật thành công.'), 'warning');

                //update correct slug
                $this->Category->id = $id;
                $slug = $id . '-' . $this->request->data['slug'];

                $this->Category->saveField('slug', $slug);

                //clear cache
                $this->clearCache();

                $this->redirect(array('plugin' => 'admin', 'controller' => 'categories', 'action' => 'edit', $id));
            } else {
                $this->Session->setFlash(__('Lỗi! Danh mục chưa được cập nhật, hãy thử lại!'), 'warning');
            }
        } else {
            $options = array('conditions' => array('Category.' . $this->Category->primaryKey => $id));
            $this->request->data = $this->Category->find('first', $options);
        }
    }

    public function delete($id = null) {
        $this->autoRender = false;

        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy danh mục này.'), 'warning');
        }

        if ($this->Category->delete($id, $cascade = true)) {
            $this->Session->setFlash(__('Xóa thành công danh mục'), 'warning');

            //clear cache
            $this->clearCache();

            $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công danh mục'), 'warning');
            $this->redirect($this->request->referer());
        }
    }
}
