<?php
/**
 * VERICHECK INC CONFIDENTIAL
 * 
 * Vericheck Incorporated 
 * All Rights Reserved.
 * 
 * NOTICE: 
 * All information contained herein is, and remainsa the property of 
 * Vericheck Inc, if any.  The intellectual and technical concepts 
 * contained herein are proprietary to Vericheck Inc and may be covered 
 * by U.S. and Foreign Patents, patents in process, and are protected 
 * by trade secret or copyright law. Dissemination of this information 
 * or reproduction of this material is strictly forbidden unless prior 
 * written permission is obtained from Vericheck Inc.
 *
 * @copyright VeriCheck, Inc. 
 * @version $$Id: AppModel.php 1694 2013-09-26 09:26:01Z anit $$
 */

App::uses('AppModel', 'Model');
App::uses('BankAccount', 'Model');
App::uses('BankAccountsEncrypted', 'Model');

/**
 * PaymentAccount Model
 *
 * @property Customer $Customer
 */
class PaymentAccount extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

	public $useDbConfig = 'default';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
//		'id' => array(
//			'uuid' => array(
//				'rule' => array('uuid'),
//				//'message' => 'Your custom message here',
//				//'allowEmpty' => false,
//				//'required' => false,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
//		),
		'customer_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				'message' => '`uuid` MUST BE UUID',
				//'allowEmpty' => false,
//				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => '`customer_id` CANNOT BE EMPTY.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subtype' => array(
//			'notEmpty' => array(
//				'rule' => array('notEmpty'),
//				'message' => '`sutype` CANNOT BE EMPTY.',
//				//'allowEmpty' => false,
//				'required' => true,
//				//'last' => false, // Stop validation after this rule
//				//'on' => 'create', // Limit validation to 'create' or 'update' operations
//			),
			'inList' => array(
				'rule' => array('inList', array('bank_accounts','credit_cards','debit_cards')),
				'message' => 'SHOULD BE A LIST of `bank_accounts`,`credit_cards`,`debit_cards`',
//				'allowEmpty' => false,
//				'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Customer' => array(
			'className' => 'Customer',
			'foreignKey' => 'customer_id',
			'conditions' => array('Customer.active' => 'yes'),
			'fields' => 'Customer.*',
			'order' => ''
		));

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}

	/**
	 * 
	 * @param type $requestData
	 * @return boolean
	 */
	public function addPaymentAccount($requestData) {
		$paymentAccountData['PaymentAccount']['subtype'] = $requestData['subtype'];
		$paymentAccountData['PaymentAccount']['customer_id'] =
						$requestData['customer_id'];

		return $this->__switchDifferentPaymentAcccountSubType($paymentAccountData,
						$requestData);

	}

}