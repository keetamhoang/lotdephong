<?php
App::uses('AppModel', 'Model');
/**
 * Post Model
 *
 * @property Event $Event
 * @property Link $Link
 */
class Post extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
    public $validate = array(
        'event_id' => array(
            'numeric' => array(
                'rule' => array('numeric'),
            ),
        ),
        'name' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'img' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
        'author' => array(
            'notBlank' => array(
                'rule' => array('notBlank'),
            ),
        ),
    );

/**
 * hasMany associations
 *
 * @var array
 */
    public $hasMany = array(
        'Link' => array(
            'className' => 'Link',
            'foreignKey' => 'post_id',
            'dependent' => true,
        )
    );

}
