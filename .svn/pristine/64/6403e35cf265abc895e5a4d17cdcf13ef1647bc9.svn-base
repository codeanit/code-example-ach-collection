<?php
App::uses('PaymentAccount', 'Model');

/**
 * PaymentAccount Test Case
 *
 */
class PaymentAccountTest extends CakeTestCase {

//	public $import = array('table' => 'payment_accounts',
//				'records' => true);



	
/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PaymentAccount = ClassRegistry::init( array(
			'class' => 'PaymentAccount',
			'table' => 'payment_accounts'));

		$this->PaymentAccount->useDbConfig = 'default';
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PaymentAccount);

		parent::tearDown();
	}

	public function testAddPaymentAccount() {
		$this->PaymentAccount->data = array(
				'customer_id' => '52e0e8f8-2b10-4225-8583-db506aac1de6',
				'subtype' => 'bank_acc');

		$this->PaymentAccount->addPaymentAccount();

		$insertID = $this->PaymentAccount->getInsertID();
		$invalidFields = $this->PaymentAccount->invalidFields();

		$this->assertEmpty($invalidFields);
		$this->assertFalse(!empty($lastInsertID));
	}
}
