<?php
App::uses('UsersController', 'Admin.Controller');

/**
 * UsersController Test Case
 */
class UsersControllerTest extends ControllerTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.admin.user',
		'plugin.admin.follow',
		'plugin.admin.event',
		'plugin.admin.category',
		'plugin.admin.categories_event'
	);

}
