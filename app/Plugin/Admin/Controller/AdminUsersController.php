<?php
App::uses('AdminAppController', 'Admin.Controller');
/**
 * Users Controller
 *
 */
class AdminUsersController extends AdminAppController {

    public $scaffold;

    public $uses = array('Manager', 'User');

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow('login', 'registerUser', 'logout');
    }

    public function login() {
        $this->layout = 'login';
        //if already logged-in, redirect
        if($this->Session->check('Auth.Manager')){
            $this->redirect(array('plugin' => 'Admin', 'controller' => 'AdminPages', 'action' => 'index'));
        }

        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                if ($this->Auth->user('role') === '1') {
                    $userData = $this->Auth->user();
                    $this->redirect($this->Auth->redirectUrl());
                } else if ($this->Auth->user('role') === '0') {
                    $this->Session->delete('Auth.Manager');
                    $this->Session->setFlash('Bạn không có quyền truy cập trang này!', 'warning');
                }
            } else {
                $this->Session->setFlash('Email hoặc mật khẩu không đúng!', 'warning');
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
        $this->Session->delete('Auth.Manager');
    }

    public function registerUser() {
        $this->layout = 'Admin.register';

        if ($this->request->is('post')) {
            $this->Manager->create();

            if ($this->Manager->save($this->request->data)) {
                $this->Session->setFlash(__('Tài khoản của bạn đã được đăng ký!'), 'warning');
                $this->redirect(array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'login'));
            } else {
                $this->Session->setFlash('Không thể tạo người dùng mới, hãy thử lại!', 'warning');
            }
        }
    }

    public function member() {
        $heading = 'Thành viên';
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
                        'username LIKE' => $keyword,
                        'email LIKE' => $keyword,
                        'facebook_id LIKE' => $keyword
                    )
                ),
                'order' => array('User.id' => 'desc'),
                'limit' => $this->limit
            );
        } else {
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'order' => array('User.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        }

        $allUsers = $this->Paginator->paginate('User');

        $this->set(compact('allUsers'));
    }

    public function manager() {
        $heading = 'Quản trị viên';
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
                        'username LIKE' => $keyword,
                        'email LIKE' => $keyword
                    )
                ),
                'order' => array('Manager.role' => 'desc'),
                'limit' => $this->limit
            );
        } else {
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => -1,
                'order' => array('Manager.role' => 'desc'),
                'limit' => $this->limit
            );
        }

        $allUsers = $this->Paginator->paginate('Manager');

        $this->set(compact('allUsers'));
    }

    public function edit($id = null) {
        if (!$this->Manager->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy người này.'));
        }

        $heading = 'Quản trị viên';
        $overview = 'Chỉnh sửa';

        $this->set(compact('heading', 'overview'));

        if ($this->request->is(array('post', 'put'))) {
//            pr($this->request->data);die;
            $data = $this->request->data;

//            pr($data);die;
            if ($this->Manager->save($data)) {
                $this->Session->setFlash(__('Người này đã được cập nhật thành công.'), 'warning');

                $this->redirect($this->request->referer());
            } else {
                debug($this->Manager->validationErrors); //show validationErrors
                debug($this->Manager->getDataSource()->getLog(false, false)); //show last sql query
                die;
                $this->Session->setFlash(__('Lỗi! Người này chưa được cập nhật, hãy thử lại!'), 'warning');
            }
        } else {
            $options = array('conditions' => array('Manager.' . $this->Manager->primaryKey => $id));
            $this->request->data = $this->Manager->find('first', $options);
        }
    }

    public function deleteManager($id = null) {
        $this->autoRender = false;

        if (!$this->Manager->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy người này.'), 'warning');
        }

        if ($this->Manager->delete($id, $cascade = true)) {
            $this->Session->setFlash(__('Xóa thành công người này'), 'warning');
            $this->redirect(array('plugin' => 'admin', 'controller' => 'users', 'action' => 'manager'));
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công người này'), 'warning');
            $this->redirect($this->request->referer());
        }
    }

    public function deleteMember($id = null) {
        $this->autoRender = false;

        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy người này.'), 'warning');
        }

        if ($this->User->delete($id, $cascade = true)) {
            $this->Session->setFlash(__('Xóa thành công người này'), 'warning');
            $this->redirect(array('plugin' => 'admin', 'controller' => 'users', 'action' => 'member'));
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công người này'), 'warning');
            $this->redirect($this->request->referer());
        }
    }
}
