<?php

/**
 * VERICHECK INC CONFIDENTIAL
 * 
 * Vericheck Incorporated 
 * All Rights Reserved.
 * 
 * NOTICE: 
 * All information contained herein is, and remains the property of 
 * Vericheck Inc, if any.  The intellectual and technical concepts 
 * contained herein are proprietary to Vericheck Inc and may be covered 
 * by U.S. and Foreign Patents, patents in process, and are protected 
 * by trade secret or copyright law. Dissemination of this information 
 * or reproduction of this material is strictly forbidden unless prior 
 * written permission is obtained from Vericheck Inc.
 *
 * @copyright VeriCheck, Inc. 
 * @version $$Id: $$
 */

App::uses('MicrotimeComponent', 'Component');
App::uses('HttpSocket', 'Network/Http');

Class MicrotimeTest extends CakeTestCase {

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Customers = new MicrotimeComponent();
		$this->HttpSocket = new HttpSocket();
	}

	/**
	 * tearDown method
	 * 
	 *  @return void
	 */
	public function tearDown() {
		unset($this->Customers);
		unset($this->HttpSocket);
		parent::tearDown();
	}

	/**
	 * Good test case to check start().
	 * 
	 * TODO
	 */
	public function testStart() {}

	/**
	 * Good test case to check stop().
	 * 
	 * TODO
	 */
	public function testStop() {}
}