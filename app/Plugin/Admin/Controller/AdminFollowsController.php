<?php
App::uses('AdminAppController', 'Admin.Controller');
/**
 * AdminFollows Controller
 *
 */
class AdminFollowsController extends AdminAppController {
    
    public $scaffold;

    public $uses = array('Follow', 'User');

    public function following() {
        $heading = 'Theo dõi';
        $overview = 'Đang theo dõi';

        $this->set(compact('heading', 'overview'));

        $keyword = !empty($this->params->query['search']) ? $this->params->query['search'] : '';

        if ($keyword) {
            $keyword = '%' . $keyword . '%';

            $options = array(
                'paramType' => 'querystring',
                'joins' => array(
                    array(
                        'table' => 'follows',
                        'alias' => 'F',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'F.user_id = User.id',
                        )
                    ),
                    array(
                        'table' => 'events',
                        'alias' => 'Event',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'Event.id = F.event_id',
                        )
                    )
                ),
                'conditions' => array('F.followed' => '1', 'OR' => array(
                    'User.username LIKE' => $keyword,
                    'Event.name LIKE' => $keyword,
                )),
                'fields' => array('Event.id', 'Event.name', 'Event.slug', 'User.username', 'User.facebook_id'),
                'recursive' => 0,
                'order' => array('User.username' => 'asc'),
                'limit' => $this->limit
            );
        } else {
            $options = array(
                'paramType' => 'querystring',
                'joins' => array(
                    array(
                        'table' => 'follows',
                        'alias' => 'F',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'F.user_id = User.id',
                        )
                    ),
                    array(
                        'table' => 'events',
                        'alias' => 'Event',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'Event.id = F.event_id',
                        )
                    )
                ),
                'conditions' => array('F.followed' => '1'),
                'fields' => array('Event.id', 'Event.name', 'Event.slug', 'User.username', 'User.facebook_id'),
                'recursive' => 0,
                'order' => array('User.username' => 'asc'),
                'limit' => $this->limit
            );
        }

        $this->Paginator->settings = $options;
        $allUsers = $this->Paginator->paginate('User');
//        pr($allUsers);die;

        $this->set(compact('allUsers'));
    }

    public function unfollow() {
        $heading = 'Theo dõi';
        $overview = 'Hết theo dõi';

        $this->set(compact('heading', 'overview'));

        $keyword = !empty($this->params->query['search']) ? $this->params->query['search'] : '';

        if ($keyword) {
            $keyword = '%' . $keyword . '%';

            $options = array(
                'paramType' => 'querystring',
                'joins' => array(
                    array(
                        'table' => 'follows',
                        'alias' => 'F',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'F.user_id = User.id',
                        )
                    ),
                    array(
                        'table' => 'events',
                        'alias' => 'Event',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'Event.id = F.event_id',
                        )
                    )
                ),
                'conditions' => array('F.followed' => '0', 'OR' => array(
                    'User.username LIKE' => $keyword,
                    'Event.name LIKE' => $keyword,
                )),
                'fields' => array('Event.id', 'Event.name', 'Event.slug', 'User.username', 'User.facebook_id'),
                'recursive' => 0,
                'order' => array('User.username' => 'asc'),
                'limit' => $this->limit
            );
        } else {
            $options = array(
                'paramType' => 'querystring',
                'joins' => array(
                    array(
                        'table' => 'follows',
                        'alias' => 'F',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'F.user_id = User.id',
                        )
                    ),
                    array(
                        'table' => 'events',
                        'alias' => 'Event',
                        'type' => 'INNER',
                        'foreignKey' => false,
                        'conditions' => array(
                            'Event.id = F.event_id',
                        )
                    )
                ),
                'conditions' => array('F.followed' => '0'),
                'fields' => array('Event.id', 'Event.name', 'Event.slug', 'User.username', 'User.facebook_id'),
                'recursive' => 0,
                'order' => array('User.username' => 'asc'),
                'limit' => $this->limit
            );
        }

        $this->Paginator->settings = $options;
        $allUsers = $this->Paginator->paginate('User');
//        pr($allUsers);die;

        $this->set(compact('allUsers'));
    }

}
