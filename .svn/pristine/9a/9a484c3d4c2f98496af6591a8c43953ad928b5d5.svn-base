<?php
/**
 * NoticeOfChangeTransactionFixture
 *
 */
class NoticeOfChangeTransactionFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'vericheck_transaction_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'gateway_transaction_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'merchant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9),
		'notice_of_change_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 4, 'key' => 'index', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'return_date' => array('type' => 'date', 'null' => false, 'default' => null),
		'corrected_data' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 29, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_notice_of_change_transactions_code_notice_of_changes' => array('column' => 'notice_of_change_id', 'unique' => 0)
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
			'id' => 1,
			'vericheck_transaction_id' => 'Lorem ipsum dolor sit amet',
			'gateway_transaction_id' => 'Lorem ipsum dolor sit amet',
			'merchant_id' => 1,
			'notice_of_change_id' => 'Lo',
			'return_date' => '2014-08-05',
			'corrected_data' => 'Lorem ipsum dolor sit amet'
		),
	);

}
