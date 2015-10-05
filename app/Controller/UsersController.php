<?php
App::uses('AppController', 'Controller');

class UsersController extends AppController {

    public $components = array(
        'Paginator',
        'Session',
        'RequestHandler',
        'Auth' => array(
            'authenticate' => array(
                'Form' => array(
                    'fields' => array('username' => 'email')
                )
            ),
            'authorize' => 'Controller'
        )
    );

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow('login', 'logout', 'isAuthorized', 'afterFacebookLogin', 'beforeFacebookLogin', 'insert_user');
//        $this->Auth->loginRedirect = '/';
        $this->Auth->logoutRedirect = '/';
    }

    function login() {
        if ($this->Session->read('Auth.User')) {
            $this->redirect('/');
        }

        $redirectFrom = $this->request->referer();
        $this->Session->write('login.redirect.from', $redirectFrom);
    }

    function logout() {
        if (!$this->Session->read('Auth.User')) {
            $this->redirect('/');
        }

        $this->Auth->logout();
        $this->Session->delete('Auth.User');
//        $this->Session->destroy();
        $this->redirect('/');
    }

    public function isAuthorized($user) {
        if (isset($user['role']) && $user['role'] === '1') {
            return true;
        }

        return false;
    }

    public function insert_user() {
        if( $this->request->is('ajax') ) {
            $this->autoRender = false;
            $user_id = $this->request->data['user_id'];
            $user_name = $this->request->data['user_name'];
            $user_email = $this->request->data['user_email'];
            $user_picture = $this->request->data['user_picture'];

            $isExist = $this->User->find('first', array(
                'recursive' => '-1',
                'fields' => 'User.id',
                'conditions' => array('User.facebook_id' => $user_id)
            ));

            if (!$isExist) {
                $this->User->create();
                $data = array(
                    'username' => $user_name,
                    'email' => $user_email,
                    'facebook_id' => $user_id,
                    'image_profile' => $user_picture
                );
            } else {
                $data = array(
                    'id' => $isExist['User']['id'],
                    'username' => $user_name,
                    'email' => $user_email,
                    'facebook_id' => $user_id,
                    'image_profile' => $user_picture
                );
            }

            $isSave = $this->User->insertUser($data);

            if ($isSave) {
                $this->Auth->login(array('id' => $this->User->id, 'avatar' => $user_picture));

                $redirectFrom = $this->Session->read('login.redirect.from');

                $this->Session->delete('login.redirect.from');

                if ($redirectFrom == '') $redirectFrom = Router::url('/');

                return json_encode(array('success' => true, 'redirect' => $redirectFrom));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                return json_encode(array('success' => false));
            }
        }
    }
}
