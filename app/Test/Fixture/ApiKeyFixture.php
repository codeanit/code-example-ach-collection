<?php
/**
 * ApiKeyFixture
 *
 */
class ApiKeyFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'string', 'null' => false, 'default' => null, 'length' => 36, 'key' => 'primary', 'collate' => 'utf8_general_ci', 'charset' => 'utf8'),
		'merchant_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_merchant_id_api_keys' => array('column' => 'merchant_id', 'unique' => 0)
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
			'id' => '52ea1f91-8238-4cdf-96d8-e0e86aac1de6',
			'merchant_id' => 1
		),
	);

}
