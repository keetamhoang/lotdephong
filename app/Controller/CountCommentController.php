<?php
App::uses('AppController', 'Controller');

class CountCommentController extends AppController
{
    public $uses = array('Event');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->autoRender = false;
    }

    public function updateComment() {
        if ($this->Session->read('Auth.Manager')) {
            $events = $this->Event->find('all', array(
                'recursive' => -1,
                'fields' => array('Event.id', 'Event.slug')
            ));

            foreach ($events as $event) {
                $data['id'] = $event['Event']['id'];

                $url = Router::url('/', true) . 'su-kien/' . $event['Event']['slug'];
                $json = json_decode(file_get_contents('https://graph.facebook.com/?ids=' . $url));

                $data['count_cmt'] = isset($json->$url->comments) ? $json->$url->comments : 0;

                $this->Event->save($data);
            }
        }
    }

    public function updateCache() {
        $new_event = $this->request->data['event_slug'];
        $array_comment = array();
        $old_comment = Cache::read('array_event', 'short');
        $is_exist = false;

        if (!empty($old_comment)) {
            if (in_array($new_event, $old_comment)) {
                $is_exist = true;
            }
        }

        if (!$is_exist) {
            foreach ($old_comment as $comment) {
                $array_comment[] = $comment;
            }
            $array_comment[] = $new_event;

            Cache::write('array_event', $array_comment, 'short');
        }
    }
}