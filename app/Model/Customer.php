<?php

App::uses('AppModel', 'Model');

/**
 * Customer Model
 *
 * @property Merchant $Merchant
 * @property PaymentAccount $PaymentAccount
 */
class Customer extends AppModel {

	/**
	 * Use database config
	 *
	 * @var string
	 */
	public $useDbConfig = 'default';

	/**
	 * Use table
	 *
	 * @var mixed False or table name
	 */
	public $useTable = 'customers';

	/**
	 * Display field
	 *
	 * @var string
	 */
	public $displayField = 'name';

	/**
	 * Validation rules
	 *
	 * @var array
	 */
	public $validate = array(
			'id' => array(
					'uuid' => array(
							'rule' => array('uuid'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'merchant_id' => array(
					'minLength' => array(
							'rule' => array('minLength', '1'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'name' => array(
					'alphabetsOnly' => array(
							'rule' => '/^[a-zA-Z]+$/i',
							'message' => 'Please enter alphabets only.',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'notEmpty' => array(
							'rule' => array('notEmpty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'email' => array(
					'email' => array(
							'rule' => array('email'),
							'message' => 'Email address is required.',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'notEmpty' => array(
							'rule' => array('notEmpty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'mobile_phone' => array(
					'numeric' => array(
							'rule' => array('numeric'),
							'message' => 'Please enter numbers.',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
					'notEmpty' => array(
							'rule' => array('notEmpty'),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
			'active' => array(
					'inList' => array(
							'rule' => array('inList', array('yes', 'no')),
					//'message' => 'Your custom message here',
					//'allowEmpty' => false,
					//'required' => false,
					//'last' => false, // Stop validation after this rule
					//'on' => 'create', // Limit validation to 'create' or 'update' operations
					),
			),
	);

	/**
	 * belongsTo associations
	 *
	 * @var array
	 */
	public $belongsTo = array(
			'Merchant' => array(
					'className' => 'Merchant',
					'foreignKey' => 'merchant_id',
//			'conditions' => array('Merchant.active '=> 'yes'),
//			'fields' => 'Merchant.*',
					'order' => ''
			)
	);

	/**
	 * hasMany associations
	 *
	 * @var array
	 */
	public $hasMany = array(
			'PaymentAccount' => array(
					'className' => 'PaymentAccount',
					'foreignKey' => 'customer_id',
					'dependent' => false,
					'conditions' => '',
					'fields' => '',
					'order' => '',
					'limit' => '',
					'offset' => '',
					'exclusive' => '',
					'finderQuery' => '',
					'counterQuery' => ''
			)
	);

	/**
	 * Add new customers.
	 * 
	 * @return array array('success' => 'success',
	 * 											'payload'=>  @param $condition array('conditions' => array('Nkey' => 'Nval'))
	 * @return array array('success' => 'true',
	 * 'payload'=> array(
	 * 			"Customer" => array(
	  "id" => "52e62476-7088-4e0e-87f3-15346aac1de6",
	  "merchant_id" => "1",
	  "name"  => "Jan",
	  "email"  => null,
	  "mobile_phone"  => "9841374040",
	  "work_phone"  => null,
	  "default_payment_account"  => null,
	  "active"  => "yes",
	  "creation_time"  => null
	  ),
	  "Merchant" => array(
	  "id"  => "1",
	  "merchants_data_id"  => "1",
	  "active"  => "yes"
	  ),
	  "PaymentAccount"  => (
	  "id"  => "52f2001a-06f8-449c-84ae-f8646aac1de6",
	  "customer_id"  => "52e62476-7088-4e0e-87f3-15346aac1de6",
	  "subtype"  => "bank_accounts",
	  "creation_date"  => "2014-02-05 13:10:49")))
	 * OR 
	 * array('success' => 'false',
	 * 				'message'=> String)
	 */
	public function addCustomer($data) {
		$this->unBindModel(array('hasMany' => array('PaymentAccount')));
		$this->data = array('Customer' => $data);
		$this->save();

		if (($insertID = $this->getInsertID()) != null) {
			$condition = array('Customer.id' => $insertID);
			$fields = array('Customer.id');
			$return = $this->success($condition, $fields);
		} else {
			$return = $this->error($this->getInvalidError($this->invalidFields()));
		}
		
		return $return;
	}

	/**
	 * Generic function find()
	 * 
	 * @param array $conditions array("condtion" => array("key" => "val")
	 * @return array array('success' => 'true',
	 * 'payload'=> array(
	 * 			"Customer" => array(
	  "id" => "52e62476-7088-4e0e-87f3-15346aac1de6",
	  "merchant_id" => "1",
	  "name"  => "Jan",
	  "email"  => null,
	  "mobile_phone"  => "9841374040",
	  "work_phone"  => null,
	  "default_payment_account"  => null,
	  "active"  => "yes",
	  "creation_time"  => null
	  ),
	  "Merchant" => array(
	  "id"  => "1",
	  "merchants_data_id"  => "1",
	  "active"  => "yes"
	  ),
	  "PaymentAccount"  => (
	  "id"  => "52f2001a-06f8-449c-84ae-f8646aac1de6",
	  "customer_id"  => "52e62476-7088-4e0e-87f3-15346aac1de6",
	  "subtype"  => "bank_accounts",
	  "creation_date"  => "2014-02-05 13:10:49")))
	 * OR 
	 * array('success' => 'false',
	 * 				'message'=> String)
	 */
	public function findCustomers($conditions = null) {
		$customers = $this->success($conditions);
		if (empty($this->_payload)) {
			$return = $this->error('Customers Not Found!');
		} else {
			$return = $customers;
		}
		return $return;
	}

	/**
	 * Prepare and encrypt BankAccountEncrypted model data.
	 * 
	 * @param array $data
	 * @return json {"customer_name": "Anit Shrestha",
	 * "account_number" : "123456789"}
	 */
	public function getBankAccountEncryptedData($data) {
		$accountNumber = array_key_exists('account_number', $data) ?
						$data['account_number'] : '';
		$result = $this->findById($data['customer_id']);
		$data = array('customer_name' => $result['Customer']['name'],
				'account_number' => $accountNumber);
		return $encryptedData = json_encode($data);
	}

}