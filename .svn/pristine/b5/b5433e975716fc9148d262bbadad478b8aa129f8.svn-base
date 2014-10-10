<?php
App::uses('BankAccountsEncrypted', 'Model');

/**
 * BankAccountsEncrypted Test Case
 *
 */
class BankAccountsEncryptedTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.bank_accounts_encrypted',
		'app.bank_account',
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
		$this->BankAccountsEncrypted = ClassRegistry::init('BankAccountsEncrypted');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->BankAccountsEncrypted);

		parent::tearDown();
	}

}
