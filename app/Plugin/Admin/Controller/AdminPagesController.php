<?php
App::uses('AdminAppController', 'Admin.Controller');
/**
 * AdminPages Controller
 *
 */
class AdminPagesController extends AdminAppController {

    public $scaffold;

    public $uses = array('Event', 'Post', 'Follow', 'Report');

    public function index() {
        $heading = 'Dashboard';
        $overview = 'Xem nhanh';

        $this->set(compact('heading', 'overview'));

        $options = array('recursive' => -1);

        $countEvent = $this->Event->find('count', $options);
        $countPost = $this->Post->find('count', $options);
        $countFollow = $this->Follow->find('count', array('recursive' => -1, 'conditions' => array('followed' => '1')));
        $countReport = $this->Report->find('count', $options);

        $this->set(compact('countEvent', 'countPost', 'countFollow', 'countReport'));
    }

}
