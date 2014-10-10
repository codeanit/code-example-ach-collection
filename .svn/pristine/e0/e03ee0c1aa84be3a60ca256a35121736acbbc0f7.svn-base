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
 */

App::uses('AppModel', 'Model');

/**
 * Merchant Model
 *
 */
class Merchant extends AppModel {

	/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';
	

	public $hasOne = array(
			'ApiKey' => array(
				'className' => 'ApiKey'));

	public $hasMany = array(
			'Customer' => array(
					'className' => 'Customer',
					'foreignKey' => 'merchant_id',
//					'conditions' => array('Comment.status' => '1'),
//					'order' => 'Comment.created DESC',
//					'limit' => '5',
//					'dependent' => false
					));
	

}
