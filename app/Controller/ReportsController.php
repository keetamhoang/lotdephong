<?php
App::uses('AppController', 'Controller');
/**
 * Reports Controller
 *
 * @property Report $Report
 * @property PaginatorComponent $Paginator
 */
class ReportsController extends AppController {
    public $uses = array('Link', 'Report');

    public function send_report() {
        $this->autoRender = false;
        $redirectFrom = $this->request->referer();

        $link_id = isset($this->request->data['linkid'])?$this->request->data['linkid']:'';

        if (!$this->Link->exists($link_id)) {
            throw new NotFoundException(__('Yêu cầu không được chấp nhận! Hãy thử lại.'));
        }

        if ($this->request->is('post')) {
            $typeReport = $this->request->data['reason'];
            $otherReport = $this->request->data['reasonOther'];

            $data['link_id'] = $link_id;

            if ($typeReport == 1) {
                $data['id_type'] = 1;
                $data['content'] = 'Link sai, link hỏng';
            } else {
                $data['id_type'] = 2;
                $data['content'] = $otherReport;
            }

            $this->Report->create();

            if ($this->Report->save($data)) {
                $this->Session->setFlash('Báo cáo của bạn đã được gửi đi thành công!', 'default', array('class' => 'alert alert-success'));
                $this->redirect($redirectFrom);
            } else {
                $this->redirect($redirectFrom);
            }
        }
    }
}
