<?php
/**
 * BankAccountsEncryptedFixture
 *
 */
class BankAccountsEncryptedFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'bank_accounts_encrypted';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'datum' => array('type' => 'binary', 'null' => false, 'default' => null, 'comment' => 'json array with keys account_number, customer_name'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1)
		),
		'tableParameters' => array('charset' => 'utf8', 'collate' => 'utf8_general_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => '52eb1a99-c1e8-4488-8aa9-4d946aac1de6',
			'datum' => 'Lorem ipsum dolor sit amet'
		),
	);

}
