<?php
App::uses('Tip', 'Model');

/**
 * Tip Test Case
 */
class TipTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.tip'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Tip = ClassRegistry::init('Tip');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Tip);

		parent::tearDown();
	}

}
