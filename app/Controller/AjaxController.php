<?php
App::uses('AppController', 'Controller');

class AjaxController extends AppController
{
    public $uses = array('Event', 'Post');

    public $components = array('Paginator');

    public function beforeFilter() {
        parent::beforeFilter();
        $this->autoRender = false;
    }

    public function load_more_posts($id, $page = 1) {
        $this->request->params['named']['page'] = $page;

        $order = !isset($this->params['url']['o'])?'desc':($this->params['url']['o']=='tu-dau'?'asc':'desc');

        $this->Paginator->settings = array(
            'conditions' => array('Post.event_id' => $id),
            'order' => array('Post.id' => $order),
            'limit' => $this->limitPost
        );

        $posts = $this->Paginator->paginate('Post');

        $view = new View($this, false);
        $view->layout = false;
        $view->viewPath = 'Elements/Ajax';
        $view->set(compact('posts', $posts));
        $data = $view->render('load_more_posts');

        return $data;
    }
}