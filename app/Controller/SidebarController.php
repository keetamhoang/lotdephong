<?php
App::uses('AppController', 'Controller');

class SidebarController extends AppController
{
    public $uses = array('Event', 'Category');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->autoRender = false;
    }

    public function beforeRender() {
        $this->viewPath = 'Elements';
    }

    public function relate_events($count) {
        $randomEvent = $this->Event->randomList($count);

        $events = $this->Event->find('all', array(
            'recursive' => -1,
            'conditions' => array('Event.id' => $randomEvent),
            'order' => 'RAND()'
        ));

        return $events;
    }

    public function maybe_events($count) {
        $randomEvent = $this->Event->randomList($count);

        $events = $this->Event->find('all', array(
            'recursive' => -1,
            'conditions' => array('Event.id' => $randomEvent),
            'order' => 'RAND()'
        ));

        return $events;
    }

    public function hot_events() {
        $randomEvent = $this->Event->randomListHot(5);

        $events = $this->Event->find('all', array(
            'recursive' => -1,
            'conditions' => array('Event.id' => $randomEvent),
            'order' => 'RAND()'
        ));

        return $events;
    }
}