<?php

App::uses('AppController', 'Controller');

/**
 * @property Event $Event
 */
class EventsController extends AppController {

    public $uses = array('Event', 'Post');

    public $cacheAction = array(
//        'index' => array('callbacks' => true, 'duration' => '1200'),
//        'hot' => array('callbacks' => true, 'duration' => '1200'),
//        'old' => array('callbacks' => true, 'duration' => '1200'),
//        'view' => array('callbacks' => true, 'duration' => '300'),
    );

    public function index($page = 1) {
        $this->request->params['named']['page'] = $page;

        $title = 'Mới nhất | ' . $this->website;
        $titleEvent = 'Hóng mới nhất';
        $whichPage = 'Event';

        $this->Paginator->settings = array(
            'recursive' => -1,
            'order' => array('Event.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $eventsList = $this->Paginator->paginate('Event');

        $this->set(compact('eventsList', 'title', 'titleEvent', 'whichPage'));

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'index');
        }
    }

    public function hot($page = 1) {
        $this->request->params['named']['page'] = $page;

        $title = 'Nóng nhất | ' . $this->website;
        $titleEvent = 'Hóng nóng hổi';
        $whichPage = 'EventHot';

        $this->Paginator->settings = array(
            'recursive' => -1,
            'conditions' => array('Event.hot' => 1),
            'order' => array('Event.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $eventsList = $this->Paginator->paginate('Event');

        $this->set(compact('eventsList', 'title', 'titleEvent', 'whichPage'));

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'hot');
        }
    }

    public function old($page = 1) {
        $this->request->params['named']['page'] = $page;

        $title = 'Cũ người mới ta | ' . $this->website;
        $titleEvent = 'Hóng cũ người mới ta';
        $whichPage = 'EventOld';

        $this->Paginator->settings = array(
            'recursive' => -1,
            'conditions' => array('Event.old' => 1),
            'order' => array('Event.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $eventsList = $this->Paginator->paginate('Event');

        $this->set(compact('eventsList', 'title', 'titleEvent', 'whichPage'));

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'old');
        }
    }

    /**
     * view event by $id
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null, $page = 1) {
        if (!$this->Event->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy yêu cầu của bạn!'));
        }

        $this->request->params['named']['page'] = $page;

        $order = !isset($this->params['url']['o']) ? 'desc' : ($this->params['url']['o'] == 'tu-dau' ? 'asc' : 'desc');

        $option = array(
            'conditions' => array('Post.event_id' => $id),
            'order' => array('Post.id' => $order),
            'limit' => $this->limitPost
        );

        $event = $this->Event->findById($id);
        $title = $event['Event']['name'] . ' | ' . $this->website;

        if (DEVICE == 'mobile') {
            $this->Paginator->settings = $option;

            $posts = $this->Paginator->paginate('Post');
            $this->set(compact('event', 'title', 'posts'));
            $this->render($this->prefix.'view');
        } else {
            $posts = $this->Post->find('all', $option);    
            $this->set(compact('event', 'title', 'posts'));
        }
    }
}
