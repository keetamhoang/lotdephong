<?php

App::uses('AppController', 'Controller');

class AdminAppController extends AppController {

    public $components = array(
        'Paginator',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email'),
                    'userModel' => 'Manager'
                )
            ),
//            'authorize' => array('Controller'),
            'loginAction' => array('plugin' => 'Admin', 'controller' => 'AdminUsers', 'action' => 'login'),
            //url redirect after login
            'loginRedirect' => array('plugin'=>'Admin','controller' => 'AdminPages','action' => 'index'),
            //url redirect after logout
            'logoutRedirect' => array('plugin'=>'Admin','controller' => 'AdminUsers','action' => 'login'),
            'authError' => 'Bạn phải là người quản trị mới xem được trang này',
            'loginError' => 'E-mail hoặc Mật khẩu không đúng'
        ),
        'Session'
    );

    public $helper = array('Html', 'Form', 'Sort', 'Time');

    public $limit = 10;

    public function beforeFilter() {
        parent::beforeFilter();

        AuthComponent::$sessionKey = 'Auth.Manager';

        $this->Auth->allow('login');
        $this->layout = 'Admin.admin';

        if ($this->Session->read('Auth.Manager')) {
            $user['id'] = $this->Session->read('Auth.Manager.id');
            $user['username'] = $this->Session->read('Auth.Manager.username');
            $this->set('user', $user);
        }
    }

    public function beforeRender() {
        if($this->name == 'CakeError') {
            $this->layout = 'error-default';
        }
    }

    protected function clearCache() {
        clearCache();
        clearCache($params = null, $type = 'views/mobiles/views', $ext = '.php');
    }
}
