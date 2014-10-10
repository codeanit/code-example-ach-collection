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
//App::uses('AppAuthController', 'Controller');
App::uses('AppController', 'Controller');

/**
 * Customers content controller.
 *
 *
 * @package app.Controller
 */
class CustomersController extends AppController {

	public $uses = array('Customer', 'Merchant', 'BankAccount',
			'AchTransaction');

	/**
	 *
	 * @var int Merchant ID. 
	 */
	protected $_merchantID;

	public function constructClasses() {
		parent::constructClasses();
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->RequestHandler->ext = 'json';
	}

	/**
	 * Cakephp default BASIC authentication mechanism, which is called
	 * automatically.
	 * 
	 * @param type $user array('username'=> '', 'role'=>'')
	 * @return boolean
	 * @throws MethodNotAllowedException
	 * @throws NotFoundException
	 */
	public function isAuthorized($user) {
		$this->_merchantID = $user[0]['Merchant']['id'];

		$merchantData = $this->Merchant->find('first', array('conditions' => 
				array('Merchant.id ' => $this->_merchantID)));

		//debug($merchantData);
		if (!empty($merchantData) && $merchantData['Merchant']['active'] == 'yes' 
						//&& $merchantData['ApiKey']['active'] == 'yes'
						) {
			return true;
		} elseif (!empty($merchantData) && 
						$merchantData['Merchant']['active'] == 'no') {
			$this->_viewData = $this->Merchant->error('Merchant Not Active!!!');
			$this->_setResponse(true);
		} elseif (!empty($merchantData) && 
						$merchantData['ApiKey']['active'] == 'no') {
			$this->_viewData = $this->Merchant->error('Merchant Not Active!!!');
			$this->_setResponse(true);
		} else {
			$this->_viewData = $this->Merchant->error('Merchant Not Found!!!');
			$this->_setResponse(true);
		}
	}

	/**
	 * Returns all customers
	 * 
	 * TODO: the find all should be filtered by merchant who is
	 * accessing it.
	 */
	public function api_index() {
		$condition = array('Merchant.id' => $this->_merchantID);
		if ($customerID != null) {
			$condition = array_merge($condition, array('Customer.id' => $customerID));
		}
		$this->_viewData = $this->Customer->findCustomers($condition);
	}

	/**
	 * Displays view based on the GET parameters.
	 * 
	 * @param $customerID UUID
	 */
	public function api_view($customerID) {
		$condition = array('Merchant.id' => $this->_merchantID,
				'Customer.id' => $customerID);

		$this->_viewData = $this->Customer->findCustomers($condition);
	}

	/**
	 * Inserts row in customers table.
	 */
	public function api_add() {
		$data = $this->request->input('json_decode', true);
		$data['merchant_id'] = $this->_merchantID;

		$this->_viewData = $this->Customer->addCustomer($data);
	}

	/**
	 * Add payment account of the customer.
	 */
	public function api_addPaymentAccount() {
		$requestData = $this->request->input('json_decode', true);

		switch ($requestData['subtype']) {
			case "bank_accounts":
				$this->_viewData = $this->BankAccount->createPaymentAccount($requestData);
				break;
			case "credit_cards":
				throw new NotFoundException('Feature not implemented at the moment.');
				break;
			case "debit_cards":
				throw new NotFoundException('Feature not implemented at the moment.');
				break;
			default:
				$return = $this->BankAccount->error('Please specify valid customers payment account subtype.');
		}
	}

	/**
	 * Create Customers transaction
	 */
	public function api_createTransaction() {
		$requestData = $this->request->input('json_decode', true);
		$this->_viewData = $this->AchTransaction->createAchTransaction($requestData);
	}

}