<?php
App::uses('AppController', 'Controller');
App::uses('CakeEmail', 'Network/Email');

/**
 * @property Send $Send
 */
class SendController extends AppController
{
    public $uses = array('Event', 'Waiting');
    public $myEmail = 'testkeetamhoang@gmail.com';

    public $cacheAction = array(
//        'send_post_user' => '30 days',
        'send_post_each_event' => '30 days'
    );

    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->autoRender = false;
    }

    public function beforeRender() {
        parent::beforeRender();
        $this->viewPath = 'Elements\Send';
    }

//    public function send_post_user()
//    {
//        if ($this->request->is('post')) {
//            $emailer = trim($this->request->data['email']);
//            $subject = trim($this->request->data['subject']);
//            $name = trim($this->request->data['name']);
//            $content = trim($this->request->data['content']);
//
//            $email = new CakeEmail('smtp');
//
//            $email->from(array($emailer => 'Yêu cầu đăng bài | ' . $name . ' | ' . $emailer))
//                ->to($this->myEmail)
//                ->subject($subject);
//
//            if ($email->send($content)) {
//                $this->Session->setFlash('E-mail của bạn đã được gửi đi thành công!', 'default', array('class' => 'alert alert-success'));
//            } else {
//                $this->Session->setFlash('Có lỗi trong việc gửi thư của bạn, hãy thử lại lần nữa nhé!', 'default', array('class' => 'alert alert-warning'));
//            }
//        }
//
//        $title = 'Gửi bài cho chúng tôi | ' . $this->website;
//
//        $this->set(compact('title'));
//
//        if (DEVICE == 'mobile') {
//            $this->render($this->prefix.'send_post');
//        } else {
//            $this->render('send_post');
//        }
//    }

    public function send_post_each_event($id = null) {
        $title = 'Gửi bài cho chúng tôi | ' . $this->website;

        $this->set(compact('title'));

        if ($this->request->is('post')) {
            $data['event_id'] = trim($this->request->data['event_id']);
            $data['event_id'] = htmlspecialchars($data['event_id']);
            $data['sender_name'] = trim($this->request->data['name']);
            $data['sender_name'] = htmlspecialchars($data['sender_name']);
            $data['content'] = trim($this->request->data['content']);
            $data['content'] = htmlspecialchars($data['content']);

            $this->Waiting->create();

            if ($this->Waiting->save($data)) {
                $this->Session->setFlash('Bài viết của bạn đã được gửi đi thành công!', 'default', array('class' => 'alert alert-success'));
                return $this->redirect(array('controller' => 'gui-bai', 'action' => $data['event_id']));
            }
        } else {
            $options = array(
                'recursive' => -1,
                'fields' => array('id', 'name', 'slug'),
                'conditions' => array('id' => $id),
            );

            $event = $this->Event->find('first', $options);

            if (!$event) {
                throw new NotFoundException(__('Không tìm thấy sự kiện này.'));
            }

            $this->set(compact('event'));
        }

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'send_post_each_event');
        } else {
            $this->render('send_post_each_event');
        }
    }
}
