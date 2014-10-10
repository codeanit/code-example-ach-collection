<?php
/**
 * StatusChangeFixture
 *
 */
class StatusChangeFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'uuid' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'transaction_id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 32, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'merchant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'change_timestamp' => array('type' => 'timestamp', 'null' => false, 'default' => 'CURRENT_TIMESTAMP'),
		'origination_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'effective_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'settlement_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'return_date' => array('type' => 'date', 'null' => true, 'default' => null),
		'return_code' => array('type' => 'string', 'null' => true, 'default' => null, 'length' => 3, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'status' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 1, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'reason' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
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
			'id' => 1,
			'uuid' => 'Lorem ipsum dolor sit amet',
			'transaction_id' => 'Lorem ipsum dolor sit amet',
			'merchant_id' => 1,
			'change_timestamp' => 1407232614,
			'origination_date' => '2014-08-05',
			'effective_date' => '2014-08-05',
			'settlement_date' => '2014-08-05',
			'return_date' => '2014-08-05',
			'return_code' => 'L',
			'status' => 'Lorem ipsum dolor sit ame',
			'reason' => 'Lorem ipsum dolor sit amet'
		),
	);

}
