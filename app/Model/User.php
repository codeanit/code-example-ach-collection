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

class User extends AppModel {

	public $validate = array(
			'username' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'A username is required'
					)
			),
			'password' => array(
					'required' => array(
							'rule' => array('notEmpty'),
							'message' => 'A password is required'
					)
			),
//			'role' => array(
//					'valid' => arra(
//							'rule' => array('inList', array('customer', 'merchant')),
//							'message' => 'Please enter a valid role',
//							'allowEmpty' => false
//					)
//			)
	);

	public $belongsTo = array(
			'Merchant' => array(
					'className' => 'Merchant',
					'foreignKey' => 'role'));

	public function beforeSave($options = null) {
		$this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
		return true;
	}

}