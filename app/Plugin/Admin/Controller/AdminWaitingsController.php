<?php
App::uses('AdminAppController', 'Admin.Controller');
/**
 * AdminWaitings Controller
 *
 */
class AdminWaitingsController extends AdminAppController {

    public $scaffold;

    public $uses = array('Waiting');

    public function publish($id = null) {
        if (!$this->Waiting->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy post này.'));
        }

        $data['id'] = $id;
        $data['is_published'] = 1;

        if ($this->Waiting->save($data)) {
            return $this->redirect($this->request->referer());
        } else {
            throw new NotFoundException(__('Lỗi.'));
        }
    }

    public function delete($id = null) {
        $this->autoRender = false;

        if (!$this->Waiting->exists($id)) {
            throw new NotFoundException(__('Không tìm thấy post này.'));
        }

        if ($this->Waiting->delete($id)) {
            $this->Session->setFlash(__('Xóa thành công'), 'warning');
            $this->redirect($this->request->referer());
        } else {
            $this->Session->setFlash(__('Lỗi! Xóa không thành công'), 'warning');
            $this->redirect($this->request->referer());
        }
    }

    public function wait() {
        $heading = 'Duyệt bài';
        $overview = 'Danh sách chờ';

        $this->set(compact('heading', 'overview'));

        $this->Paginator->settings = array(
            'paramType' => 'querystring',
            'joins' => array(
                array(
                    'table' => 'events',
                    'alias' => 'Event',
                    'type' => 'INNER',
                    'conditions' => '`Waiting`.`event_id` = `Event`.`id`'
                )
            ),
            'conditions' => array('is_published' => 0),
            'fields' => array('Waiting.*', 'Event.id', 'Event.name', 'Event.slug'),
            'order' => array('Waiting.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $waitsList = $this->Paginator->paginate('Waiting');

        $this->set(compact('waitsList'));
    }

    public function done() {
        $heading = 'Duyệt bài';
        $overview = 'Đã duyệt';

        $this->set(compact('heading', 'overview'));

        $this->Paginator->settings = array(
            'paramType' => 'querystring',
            'joins' => array(
                array(
                    'table' => 'events',
                    'alias' => 'Event',
                    'type' => 'INNER',
                    'conditions' => '`Waiting`.`event_id` = `Event`.`id`'
                )
            ),
            'conditions' => array('is_published' => 1),
            'fields' => array('Waiting.*', 'Event.id', 'Event.name', 'Event.slug'),
            'order' => array('Waiting.updated_at' => 'desc'),
            'limit' => $this->limit
        );

        $waitsList = $this->Paginator->paginate('Waiting');

        $this->set(compact('waitsList'));
    }
}
