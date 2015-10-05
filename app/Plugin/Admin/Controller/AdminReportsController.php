<?php
App::uses('AdminAppController', 'Admin.Controller');

/**
 * AdminReports Controller
 *
 */
class AdminReportsController extends AdminAppController
{

    public $scaffold;

    public $uses = array('Report', 'Link');

    public function index()
    {
        $heading = 'Báo cáo';
        $overview = 'Tất cả';

        $this->set(compact('heading', 'overview'));

        $keyword = !empty($this->params->query['search']) ? $this->params->query['search'] : '';

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => 2,
                'conditions' => array(
                    'OR' => array(
                        'Report.content LIKE' => $keyword,
                        'Link.name LIKE' => $keyword
                    )
                ),
                'order' => array('Report.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        } else {
            $this->Paginator->settings = array(
                'paramType' => 'querystring',
                'recursive' => 2,
                'order' => array('Report.updated_at' => 'desc'),
                'limit' => $this->limit
            );
        }

        $allReports = $this->Paginator->paginate('Report');
//        pr($allReports);die;

        $this->set(compact('allReports'));
    }

    public function delete($id = null) {
        $this->autoRender = false;

        if (!$this->Report->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy báo cáo này.'), 'warning');
        }

        if ($this->Report->delete($id, $cascade = true)) {
            $this->Session->setFlash(__('Xóa thành công báo cáo'), 'warning');
            $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công báo cáo'), 'warning');
            $this->redirect($this->request->referer());
        }
    }
}
