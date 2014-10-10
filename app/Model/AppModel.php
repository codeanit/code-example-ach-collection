<?php

/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

	/**
	 * Transaction status either 'true' or 'false'
	 * 
	 * @var String
	 */
	protected $_success;

	/**
	 * Contains array from find()
	 * 
	 * @var Array
	 */
	protected $_payload;

	/**
	 *
	 * @var type 
	 */
	protected $error;

	/**
	 * Error code for the transaction
	 * 
	 * @var type 
	 */
	protected $code;

	/**
	 * Error message for the transaction
	 * 
	 * @var String 
	 */
	protected $_message;

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);

		$this->_success = FALSE;
		$this->_payload = NULL;
		$this->_message = NULL;
		$this->_code = NULL;
	}

	/**
	 * Save discrete models in one transaction.
	 * 
	 * @todo Implement the functionality. http://tickets.evericheck.com/issues/373
	 */
	protected function discreteTransactionSave() {
		
	}

	/**
	 * Generate success data
	 * 
	 * @param $condition array('conditions' => array('Nkey' => 'Nval'))
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
	  "creation_date"  => "2014-02-05 13:10:49"))
	 */
	public function success($condition, $fields = null) {
		$this->setPayload($condition, $fields);
		$this->setSuccess('true');

		return array('success' => $this->_success, 'payload' => $this->_payload);
	}

	/**
	 * Generate error message.
	 * 
	 * @param String $message
	 * @return array array('success' => 'false', 'message'=> String)
	 */
	public function error($message) {
		$this->setMessage($message);
		$this->setSuccess('false');
		return array('success' => $this->_success, 'message' => $message);
	}

	/**
	 * Get model validation error.
	 * 
	 * @param $invalidError array
	 * @return String
	 */
	public function getInvalidError($invalidError = array()) {
		$falt = Hash::flatten($invalidError);
		$single = array();
		$orgKey = '';
		$errorMessage = '';
//debug($invalidError); die;
		foreach ($falt as $key => $val) {
			$keyExploded = explode('.', $key);
			$orgKey = count($keyExploded) === 2 ? $keyExploded[0] : $keyExploded[1];
			if (!\array_key_exists($orgKey, $single)) {
				$single[$orgKey] = $val;
				$errorMessage .= $orgKey . ' : ' . $val . " | ";
			}
		}
		return substr($errorMessage, 0, -3);
	}

	/**
	 * Set $_payload
	 * 
	 * @param type $conditions
	 */
	public function setPayload($conditions, $fields = null) {
		$filterConditions = empty($conditions) ? array() :
						array('conditions' => $conditions);

		$fields = empty($fields) ? array() : array('fields' => $fields);
		$params = array_merge($filterConditions, $fields);
		$this->_payload = $this->find('all',$params);
	}

	/**
	 * Get $_payload.
	 * 
	 * @return $_payload
	 */
	public function getPayload() {
		return $this->_payload;
	}

	/**
	 * Set $_success.
	 * 
	 * @param String $success
	 */
	public function setSuccess($success) {
		$this->_success = $success;
	}

	/**
	 * Set $_success
	 * 
	 * @return $this->_success
	 */
	public function getSuccess() {
		return $this->_success;
	}

	/**
	 * Set $_message.
	 * 
	 * @param String $message
	 */
	public function setMessage($message) {
		$this->_message = $message;
	}

	/**
	 * Get $_message.
	 * 
	 * @return $_message
	 */
	public function getMessage() {
		return $this->_message;
	}

}
