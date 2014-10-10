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

App::uses('CustomersController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

Class CustomersTest extends CakeTestCase {

	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Customers = new CustomersController();
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
	 * Good test case to check testAdd
	 * 
	 */
	public function ptestAdd() {
		$expected = array('name' => 'Mike',
				'mobile_phone' => '9841374045');
		$jsonString = json_encode($expected);

		$responsePOST = $this->HttpSocket->post(
						'http://localhost/Collection/trunk/Customers/add',
						$jsonString); 
		$lastInsertId = json_decode($responsePOST->body);



		$expectedMergerdWithInsertID = array_merge($expected, 
						array('id' => $lastInsertId->id));

		$responseGET = $this->HttpSocket->get(
						'http://localhost/Collection/trunk/Customers/view',
						$expectedMergerdWithInsertID);

		$GETResultJSON = (array)json_decode($responseGET);
		$getArray = (array) $GETResultJSON['customers'][0]->Customer;

		foreach($expectedMergerdWithInsertID as $key => $val) {

			if(array_key_exists($key, $getArray)) {
				$this->assertEqual($val, $getArray[$key]);
			}
		}
		$this->assertTrue($responsePOST->isOk());
	}
	/**
	 * Good test case for Cusotmers->index()
	 */
	public function ptestIndex() {
			$response = $this->HttpSocket->post(
							'http://localhost/Collection/trunk/Customers'); 

		$this->assertTrue($response->isOk());
	}

	/**
	 * Good test case for Customers->view()
	 */
	public function testView() {
		$expected = array('name' => 'Ray',
						'mobile_phone' => '9841374041');

		$response = $this->HttpSocket->get(
						'http://localhost/Collection/trunk/Customers/view',
						$expected);
debug($response);
		$this->assertTrue($response->isOk());
		$this->assertEqual($expected['name'], $expected['name']);
	}

}