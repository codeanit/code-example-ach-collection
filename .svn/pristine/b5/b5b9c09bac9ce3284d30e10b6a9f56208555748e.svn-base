<?php
App::uses('Ccd', 'Model');

/**
 * Ccd Test Case
 *
 */
class CcdTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ccd',
		'app.ach_transaction',
		'app.transaction',
		'app.payment_account',
		'app.customer',
		'app.merchant',
		'app.api_key',
		'app.ppd'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ccd = ClassRegistry::init('Ccd');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ccd);

		parent::tearDown();
	}

}
