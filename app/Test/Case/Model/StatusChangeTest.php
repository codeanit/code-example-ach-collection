<?php
App::uses('StatusChange', 'Model');

/**
 * StatusChange Test Case
 *
 */
class StatusChangeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.status_change',
		'app.transaction',
		'app.payment_account',
		'app.customer',
		'app.merchant',
		'app.api_key'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->StatusChange = ClassRegistry::init('StatusChange');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->StatusChange);

		parent::tearDown();
	}

}
