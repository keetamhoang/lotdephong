<?php
App::uses('AppModel', 'Model');
/**
 * Report Model
 *
 * @property Link $Link
 */
class Report extends AppModel {

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'content' => array(
			'notBlank' => array(
				'rule' => array('notBlank'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'link_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Link' => array(
			'className' => 'Link',
			'foreignKey' => 'link_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);
}
