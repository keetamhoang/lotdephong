<?php
/**
 * Link Fixture
 */
class LinkFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'primary'),
		'post_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false, 'key' => 'index'),
		'link' => array('type' => 'integer', 'null' => false, 'default' => null, 'unsigned' => false),
		'created_at' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'updated_at' => array('type' => 'timestamp', 'null' => false, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'post_id' => array('column' => 'post_id', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_unicode_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'post_id' => 1,
			'link' => 1,
			'created_at' => 1440601086,
			'updated_at' => 1440601086
		),
	);

}
