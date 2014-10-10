<?php
/**
 * CustomerFixture
 *
 */
class CustomerFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'merchant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9, 'key' => 'index'),
		'name' => array('type' => 'string', 'null' => false, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Encrypted', 'charset' => 'utf8'),
		'email' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Encrypted', 'charset' => 'utf8'),
		'mobile_phone' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Encrypted', 'charset' => 'utf8'),
		'work_phone' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Encrypted', 'charset' => 'utf8'),
		'default_payment_account' => array('type' => 'string', 'null' => true, 'default' => null, 'collate' => 'utf8_general_ci', 'comment' => 'Encrypted', 'charset' => 'utf8'),
		'creation_time' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_merchant_id_on_customers' => array('column' => 'merchant_id', 'unique' => 0)
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
			'id' => '52e0e107-38a8-4ae5-bbfc-40576aac1de6',
			'merchant_id' => 1,
			'name' => 'Lorem ipsum dolor sit amet',
			'email' => 'Lorem ipsum dolor sit amet',
			'mobile_phone' => 'Lorem ipsum dolor sit amet',
			'work_phone' => 'Lorem ipsum dolor sit amet',
			'default_payment_account' => 'Lorem ipsum dolor sit amet',
			'creation_time' => '2014-01-23 15:14:43'
		),
	);

}
