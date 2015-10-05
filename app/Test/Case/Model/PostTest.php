<?php
App::uses('Post', 'Model');

/**
 * Post Test Case
 */
class PostTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.post',
		'app.event',
		'app.category_event',
		'app.follow',
		'app.user',
		'app.category',
		'app.categories_event',
		'app.link',
		'app.report'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Post = ClassRegistry::init('Post');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Post);

		parent::tearDown();
	}

}
