<?php
/**
 * CcdFixture
 *
 */
class CcdFixture extends CakeTestFixture {

/**
 * Table name
 *
 * @var string
 */
	public $table = 'ccd';

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'ach_transaction_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'transaction_code' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'routing_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 9, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'account_number' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 17, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'amount' => array('type' => 'float', 'null' => false, 'default' => null, 'length' => '10,2'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 22, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'discretionary_data' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 2, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'ach_transaction_id', 'unique' => 1)
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
			'ach_transaction_id' => '5346175a-594c-4b4d-8bf3-73106aac1de6',
			'transaction_code' => '',
			'routing_number' => 'Lorem i',
			'account_number' => 'Lorem ipsum dol',
			'amount' => 1,
			'name' => 'Lorem ipsum dolor si',
			'discretionary_data' => ''
		),
	);

}
