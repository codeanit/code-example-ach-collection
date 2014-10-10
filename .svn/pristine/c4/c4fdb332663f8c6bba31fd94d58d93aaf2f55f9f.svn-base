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

Class RequestMicrotime extends AppModel {


	/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'requests';

	/**
	 * Insert into requests
	 * 
	 * @param array $requests
	 * 
	 * @return stging UUID latest insertID
	 */
	public function insertElapsedMicrotime($requests) {
		$this->save($requests);
		return $this->getInsertID();
	}
}