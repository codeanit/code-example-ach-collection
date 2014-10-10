<?php
App::uses('BankAccount', 'Model');

/**
 * BankAccount Test Case
 *
 */
class BankAccountTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bank_account',
		'app.payment_account',
		'app.customer',
		'app.merchant',
		'app.api_key',
		'app.bank_accounts_encrypted'
	);

	public $autoFixtures = false;

	public $import = array('records' => true);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
			$this->BankAccount = ClassRegistry::init( array(
			'class' => 'BankAccount',
			'table' => 'bank_accounts'));

		$this->BankAccount->useDbConfig = 'default';
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BankAccount);

		parent::tearDown();
	}

	public function testCreatePaymentAccount() {
		$paymentAccountData['PaymentAccount'] = array(
				'customer_id' => '52e62476-7088-4e0e-87f3-15346aac1de6',
				'subtype' => 'bank_accounts');

		$subTypeData = array(
				'routing_number' => '240060556',
				'account_number_last_four_digits' => '4321',
				'account_type' => 'checkings');

		$this->BankAccount->createPaymentAccount($paymentAccountData,
						$subTypeData);

		$insertID = $this->BankAccount->getInsertID();
		$invalidFields = $this->BankAccount->invalidFields();

		$this->assertEmpty($invalidFields);
		$this->assertTrue($insertID != NULL);
	}
}
