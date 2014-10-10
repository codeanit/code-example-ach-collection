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

App::uses('Customer', 'Model');

class CustomerTest extends CakeTestCase {

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Customer = ClassRegistry::init(
						array('class' => 'Customer', 'table' => 'customers'));

		$this->Customer->useDbConfig = 'default';
	}

	
/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Customer);
		parent::tearDown();
	}

	/**
	 * Test addCustomer.
	 * 
	 * Checks inserting single customer in `collection`.`customers`
	 * 
	 * TODO deprecated
	 */
	public function xtestAddCustomers() {
//		$expected = array(
//				'merchantID' => '3',
//				'name' => 'Brandy',
//				'mobile_phone' => '9841374052');
//
//		$actual = $this->Customer->addCustomer($expected);

		$customers = $this->Customer->find(
					'all', array(
							'fields' => array('*'),
//							'conditions' => $expected)
						));
//debug($customers); die;
		foreach($expected as $key => $val) {
			$this->assertEqual($val, $customers[0]['Customer'][$key]);
		}

		$this->assertEmpty($actual);
	}

	public function testAdd() {
		$data = array(
		'name' => 'Marchy',
		'mobile_phone' => '9841374042',
		'merchant_id' => '1');

		$return = $this->Customer->addCustomer($data);
		$this->assertEqual($return['success'], 'true');
	}
}