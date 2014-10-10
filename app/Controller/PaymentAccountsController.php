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

App::uses('AppController', 'Controller');
App::uses('PaymentAccount', 'Model');
App::uses('Customer', 'Model');

/**
 * Customers content controller.
 *
 *
 * @package app.Controller
 */

class PaymentAccountsController extends AppController {

	public function beforeFilter() {
		parent::beforeFilter();
		$this->RequestHandler->ext = 'json';
	}

	/**
	 * Returns all customers
	 */
	public function api_index() {
		$customers = $this->PaymentAccount->find('all');
		$this->set(array(
				'paymentaccount' => $customers,
				'_serialize' => array('paymentaccount')
		));
	}

	/**
	 * Displays view based on the GET parameters.
	 */
	public function api_view($id) {
		$customers = $this->PaymentAccount->find(
				'all', array(
						'conditions' => array('Customer.id ' => $id)));

		$this->set(array(
				'customers' => $customers,
				'_serialize' => array('customers')));
	}

	/**
	 * Inserts row in customers table.
	 */
	public function api_add() {
		$data = $this->request->input('json_decode', true);

		$data = $this->Customer->addCustomer($data);

		if (empty($data)) {
			$lastInsertID = $this->Customer->getInsertID();
			$this->set(array('id' => $lastInsertID,
					'_serialize' => array('id')));

		} else {
			$this->set(array('Error' => "Sorry. There was an error.",
					 '_serialize' => array('customers')));
		}
	}

	public function isAuthorized($user) {
		$merchantData = $this->Merchant->find('first',
						array('conditions' => array('Merchant.id ' => $user['role'])));

		if(!empty($merchantData)) {
//						&& $merchantData[0]['Merchant']['active'] == 'yes'
//						&& $merchantData[0]['ApiKey']['active'] == 'yes'
			return true;
		} else {
			return false;
		}

		if(count($merchantData) > 0)
			return true;

		return false;
	}

}