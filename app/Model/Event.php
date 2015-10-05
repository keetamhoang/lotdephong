<?php
App::uses('AppModel', 'Model');
/**
 * Event Model
 *
 * @property Follow $Follow
 * @property Post $Post
 * @property Category $Category
 */
class Event extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'updating' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'img' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'description' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'hot' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
    );

/**
 * hasAndBelongsToMany associations
 *
 * @var array
 */
    public $hasAndBelongsToMany = array(
        'Category' => array(
            'className' => 'Category',
            'joinTable' => 'categories_events',
            'foreignKey' => 'event_id',
            'associationForeignKey' => 'category_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public function featuredEvents(){
        $option = array(
            'recursive' => -1,
            'conditions' => array('hot' => '1'),
            'order' => 'RAND()',
            'limit' => 6
        );

        $featuredEvents = $this->find('all', $option);

        if ($featuredEvents) {
            return $featuredEvents;
        } else {
            return false;
        }
    }

    public function randomList($count, $id = null){
        $option = array(
            'recursive' => -1,
            'fields' => 'id',
            'conditions' => array('id !=' => $id),
            'order' => 'RAND()',
            'limit' => $count
        );

        $random = $this->find('list', $option);

        return $random;
    }

    public function randomListHot($count) {
        $option = array(
            'recursive' => -1,
            'fields' => 'id',
            'conditions' => array('hot' => 1),
            'order' => 'RAND()',
            'limit' => $count
        );

        $random = $this->find('list', $option);

        return $random;
    }
}
