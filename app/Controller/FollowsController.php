<?php
App::uses('AppController', 'Controller');
/**
 * Follows Controller
 *
 * @property Follow $Follow
 * @property PaginatorComponent $Paginator
 */
class FollowsController extends AppController {

    public $uses = array('User', 'Event', 'Follow');

    public $components = array(
        'Session',
        'Auth'
    );

    function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow();
        $this->autoRender = false;
    }

    /**
     * Follow event from now
     * @param $event_id
     * @param null $user_id
     * @throws NotFoundException
     */
    public function follow($event_id, $user_id = null){
        if (!$this->Event->exists($event_id)) {
            throw new NotFoundException(__('Yêu cầu không được chấp nhận! Hãy thử lại.'));
        }

        $redirectFrom = $this->request->referer();

        if ($user_id == null) {
            $this->Session->write('login.redirect.from', $redirectFrom);

            $this->redirect(array('controller' => false, 'action' => 'dang-nhap'));
        }

        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Yêu cầu không được chấp nhận! Hãy thử lại.'));
        }

        $isExist = $this->Follow->find('first', array(
            'recursive' => '-1',
            'fields' => 'Follow.id',
            'conditions' => array('Follow.event_id' => $event_id, 'Follow.user_id' => $user_id)
        ));

        if (!$isExist) {
//            $this->redirect($redirectFrom);
            $this->Follow->create();
            $data = array('user_id' => $user_id, 'event_id' => $event_id);
        } else {
            $data = array('id' => $isExist['Follow']['id'], 'followed' => '1');
        }

        if ($this->Follow->save($data)) {
            return $this->redirect($redirectFrom);
        } else {
            $this->Session->setFlash(__('The follow could not be saved. Please, try again.'));
        }
    }

    /**
     * Cancel follow
     * @param $event_id
     * @param null $user_id
     */
    public function not_follow($event_id, $user_id = null){
        $redirectFrom = $this->request->referer();

        if (!$this->Event->exists($event_id)) {
            throw new NotFoundException(__('Yêu cầu không được chấp nhận! Hãy thử lại.'));
        }

        if ($user_id == null) {
            $this->Session->write('login.redirect.from', $redirectFrom);

            $this->redirect(array('controller' => false, 'action' => 'dang-nhap'));
        }

        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Yêu cầu không được chấp nhận! Hãy thử lại.'));
        }
        
        $isExist = $this->Follow->find('first', array(
            'recursive' => '-1',
            'fields' => 'Follow.id',
            'conditions' => array('Follow.event_id' => $event_id, 'Follow.user_id' => $user_id)
        ));

        if (!$isExist) {
            $this->redirect($redirectFrom);
        }

        $this->Follow->id = $isExist['Follow']['id'];

        if ($this->Follow->save(array('followed' => 0))) {
            $this->redirect($redirectFrom);
        } else {
            $this->redirect($redirectFrom);
        }
    }

    public function checkFollow($event_id = null, $user_id = null) {
        $isFollow = $this->Follow->find('first',
            array(
                'conditions' => array('user_id' => $user_id, 'event_id' => $event_id),
                'recursive' => -1
            )
        );

        if (!$isFollow) {
            return false;
        } else {
            if ($isFollow['Follow']['followed'] == 0) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function countNoti($user_id = null) {
        $countNoti = $this->Follow->find('count', array(
            'conditions' => array('Follow.user_id' => $user_id, 'Follow.is_read' => 0)
        ));

        return $countNoti;
    }

    public function showNewNoti() {
        if( $this->request->is('ajax') ) {
            $user_id = $this->request->data['user_id'];

            $listNoti = $this->Follow->find('all', array(
                'recursive' => 0,
                'fields' => array('Follow.updated_at', 'Event.id', 'Event.name', 'Event.slug'),
                'conditions' => array('Follow.user_id' => $user_id, 'Follow.is_read' => 0),
                'order' => array('Follow.updated_at' => 'desc'),
                'limit' => 5
            ));

            $this->Follow->updateAll(
                array('Follow.is_read' => '1'),
                array('Follow.user_id' => $user_id)
            );

            return json_encode(array('success' => true, 'listNoti' => $listNoti));
        }

    }

    /*
     * show all notification
     */
    public function showAll($user_id = null) {
        if ($user_id == null) {
            return false;
        }

        if (!$this->User->exists($user_id)) {
            throw new NotFoundException(__('Yêu cầu không được chấp nhận! Hãy thử lại.'));
        }

        $listNoti = $this->Follow->find('all', array(
            'recursive' => 0,
            'fields' => array('Follow.updated_at', 'Event.id', 'Event.name', 'Event.img'),
            'conditions' => array('Follow.user_id' => $user_id),
            'order' => array('Follow.updated_at' => 'desc'),
        ));

        return $listNoti;
    }

}
