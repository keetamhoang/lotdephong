<?php
App::uses('AppController', 'Controller');

class CategoriesController extends AppController {
    public $uses = array('Category', 'CategoriesEvent');

    public $components = array('Paginator');

    public $cacheAction = array(
        'index' => '2 days',
        'view' => '1 day'
    );

    public function index($page = 1) {
        $this->request->params['named']['page'] = $page;

        $this->Paginator->settings = array(
            'recursive' => -1,
            'order' => array('Category.id' => 'desc'),
            'limit' => $this->limit
        );

        $categoryList = $this->Paginator->paginate('Category');

        $title = 'Quá nhiều để hóng | '.$this->website;
        $titleCategory = 'Quá nhiều để hóng';

        $this->set(compact('categoryList', 'title', 'titleCategory', 'alas'));

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'index');
        }
    }

    public function view($id = null, $page = 1) {
        if (!$this->Category->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy yêu cầu của bạn!'));
        }

        $this->request->params['named']['page'] = $page;

        $this->Paginator->settings = array(
            'conditions' => array('CategoriesEvent.category_id' => $id),
            'order' => array('CategoriesEvent.id' => 'desc'),
            'limit' => $this->limit
        );

        $eventsList = $this->Paginator->paginate('CategoriesEvent');

        $category = $this->Category->find(
            'first',
            array(
                'conditions' => array('Category.id' => $id),
                'fields' => array('Category.name', 'Category.slug'),
                'recursive' => -1
            )
        );

        $title = $category['Category']['name'].' | '.$this->website;
        $titleCategory = $category['Category']['name'];
        $slugCategory = $category['Category']['slug'];

        $this->set(compact('eventsList', 'title', 'titleCategory', 'slugCategory'));

        if (DEVICE == 'mobile') {
            $this->render($this->prefix.'view');
        }
    }

    public function listCategories() {
        $this->autoRender = false;

        $option = array(
            'recursive' => -1,
            'fields' => array('Category.id', 'Category.name', 'Category.slug'),
            'order' => array('Category.name' => 'asc')
        );

        $listCategories = $this->Category->find('all',$option);

        return $listCategories;
    }
}
