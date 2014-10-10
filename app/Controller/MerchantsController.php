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
App::uses('Merchant', 'Model');

/**
 * Merchant content controller.
 *
 *
 * @package app.Controller
 */	

class MerchantsController extends AppController {

	protected $_merchantID;
	
	public $uses = array('PendingMerchant','Merchant');
	
	public function constructClasses() {
		parent::constructClasses();
	}

	public function beforeFilter() {
		parent::beforeFilter();
		$this->RequestHandler->ext = 'json';
	}
	
	public function isAuthorized($user) {
		$this->_merchantID = $user[0]['Merchant']['id'];

		$merchantData = $this->Merchant->find('first', array('conditions' => 
				array('Merchant.id ' => $this->_merchantID)));

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
	 * Returns all Merchants
	 * 
	 * TODO: the find all should be filtered by merchant who is
	 * accessing it.
	 */
	public function api_index() {
		$this->_viewData = $this->PendingMerchant->find('all');
	}
	
	/**
	 * Inserts row in merchants table.
	 */
	public function api_add() {
		$data = $this->request->input('json_decode', true);
		$this->_viewData = $this->PendingMerchant->addMerchant($data);
	}
	
	/**
	 * Displays view based on the GET parameters.
	 * 
	 * @param $merchantID UUID
	 */
	public function api_view($merchantID) {
		$condition = array('PendingMerchant.id' => $merchantID);

		$this->_viewData = $this->PendingMerchant->findMerchant($condition);
	}

}