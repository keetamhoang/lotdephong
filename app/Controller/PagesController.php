<?php

App::uses('AppController', 'Controller');

class PagesController extends AppController {

    public $uses = array('Event', 'Category', 'Post');

    public $cacheAction = array(
//        'index' => '300',
        'clause' => '30 days',
        'contact' => '30 days'
    );

    public function index($page = 1) {
//        Cache::clear(false);
        $array_comment = Cache::read('array_event', 'short');
        if ($array_comment) {
            pr($array_comment);die;
        }
        $this->request->params['named']['page'] = $page;

        $title = 'Trang chủ | ' . $this->website;

        $this->Paginator->settings = array(
            'recursive' => -1,
            'order' => array('Event.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $newEvents = $this->Paginator->paginate('Event');

        // slider featured events
        $featuredEvents = $this->Event->featuredEvents();

        $this->set(array(
            'title' => $title,
            'featuredEvents' => $featuredEvents,
            'newEvents' => $newEvents
        ));

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'index');
        }
    }

    public function clause() {
        $title = 'Điều khoản sử dụng | ' . $this->website;

        $this->set(compact('title'));
    }

    public function contact() {
        $title = 'Liên hệ | ' . $this->website;

        $this->set(compact('title'));
    }

    public function showAll() {
        $title = 'Tất cả thông báo | ' . $this->website;

        $this->set(compact('title'));
    }

}
