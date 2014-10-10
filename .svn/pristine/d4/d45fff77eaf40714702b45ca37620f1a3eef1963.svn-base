<?php
App::uses('Ppd', 'Model');

/**
 * Ppd Test Case
 *
 */
class PpdTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.ppd',
		'app.ach_transaction',
		'app.transaction',
		'app.payment_account',
		'app.customer',
		'app.merchant',
		'app.api_key',
		'app.ccd'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Ppd = ClassRegistry::init('Ppd');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Ppd);

		parent::tearDown();
	}

}
