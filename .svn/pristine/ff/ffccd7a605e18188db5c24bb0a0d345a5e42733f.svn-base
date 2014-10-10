<?php
App::uses('NoticeOfChangeTransaction', 'Model');

/**
 * NoticeOfChangeTransaction Test Case
 *
 */
class NoticeOfChangeTransactionTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notice_of_change_transaction',
		'app.merchant',
		'app.api_key',
		'app.customer',
		'app.payment_account',
		'app.notice_of_change'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NoticeOfChangeTransaction = ClassRegistry::init('NoticeOfChangeTransaction');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NoticeOfChangeTransaction);

		parent::tearDown();
	}

}
