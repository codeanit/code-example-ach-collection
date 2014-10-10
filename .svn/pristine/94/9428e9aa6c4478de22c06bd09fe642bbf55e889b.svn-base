<?php

App::uses('AppModel', 'Model');

/**
 * ApiKey Model
 *
 * @property Merchant $Merchant
 */
class ApiKey extends AppModel {

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'id';
	public $actsAs = array('HexUUID');

	//The Associations below have been created with all possible keys, those that are not needed can be removed

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
			'Merchant' => array(
					'className' => 'Merchant',
					'foreignKey' => 'merchant_id',
					'conditions' => '',
					'fields' => '',
					'order' => ''
			)
	);

	public function login() {
		echo '1234';
		die;
	}

}