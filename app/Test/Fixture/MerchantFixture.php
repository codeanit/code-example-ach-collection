<?php
/**
 * MerchantFixture
 *
 */
class MerchantFixture extends CakeTestFixture {

/**
 * Fields
 *
 * @var array
 */
	public $fields = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9, 'key' => 'primary'),
		'primary_data_source' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 9, 'key' => 'index'),
		'indexes' => array(
			'PRIMARY' => array('column' => 'id', 'unique' => 1),
			'fk_data_sources_idx' => array('column' => 'primary_data_source', 'unique' => 0)
		),
		'tableParameters' => array('charset' => 'latin1', 'collate' => 'latin1_swedish_ci', 'engine' => 'InnoDB')
	);

/**
 * Records
 *
 * @var array
 */
	public $records = array(
		array(
			'id' => 1,
			'primary_data_source' => 1
		),
	);

}
