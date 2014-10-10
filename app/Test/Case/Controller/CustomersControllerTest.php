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

App::uses('CustomersController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * CustomersController Test Case
 *
 */
class CustomersControllerTest extends ControllerTestCase {


	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Customers = new CustomersController();
		$this->HttpSocket = new HttpSocket();
		$this->HttpSocket->configAuth('Basic', 'admin', 'admin');

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
 * testApiIndex method
 *
 * @return void
 */
	public function ptestApiIndex() {
		$response = $this->HttpSocket->post(
							'http://localhost/collection-vci/api/Customers');
 
		$this->assertTrue($response->isOk());
	}

/**
 * testApiView method
 *
 * @return void
 */
	public function testApiView() {
		$expected = array('name' => 'Jan1',
						'mobile_phone' => '9841374040');

		$response = $this->HttpSocket->get(
						'http://localhost/collection-vci/api/Customers/view/52e62476-7088-4e0e-87f3-15346aac1de6',
						$expected);
		
		$GETResultJSON = (array) json_decode($response->body);
		$getArray = (array) $GETResultJSON['customers'][0]->Customer;
		
		$this->assertTrue($response->isOk());
		$this->assertEqual($getArray['name'], $expected['name']);
	}

/**
 * testApiAdd method
 *
 * @return void
 */
	public function ptestApiAdd() {
		$expected = array('name' => 'Mike',
				'mobile_phone' => '9841374045'
				);
		$jsonString = json_encode($expected);
		$responsePOST = $this->HttpSocket->post(
						'http://localhost/collection-vci/api/Customers/add',
						$jsonString); 
		$lastInsertId = json_decode($responsePOST->body);
		$expectedMergerdWithInsertID = array_merge($expected, 
						array('id' => $lastInsertId->id));
		$id = $lastInsertId->id;
		$responseGET = $this->HttpSocket->get(
						'http://localhost/collection-vci/api/Customers/view/'.$id,
						$expectedMergerdWithInsertID);
		$GETResultJSON = (array) json_decode($responseGET->body);
		$getArray = (array) $GETResultJSON['customers'][0]->Customer;

		foreach($expectedMergerdWithInsertID as $key => $val) {

			if(array_key_exists($key, $getArray)) {
				$this->assertEqual($val, $getArray[$key]);
			}
		}
		$this->assertTrue($responsePOST->isOk());
		$this->assertEqual($getArray['name'], $expected['name']);
	}

/**
 * testApiAddPaymentAccount method
 *
 * @return void
 */
	public function ptestApiAddPaymentAccount() {
		$expected = array(
			'customer_id' => '52e62476-7088-4e0e-87f3-15346aac1de6',
			'subtype' => 'bank_accounts');
		$jsonString = json_encode($expected);

		$responsePOST = $this->HttpSocket->post(
						'http://localhost/collection-vci/api/Customers/addPaymentAccount',
						$jsonString); 
		$lastInsertId = json_decode($responsePOST->body);

		if(array_key_exists('id' ,$lastInsertId)) {
				$expectedMergerdWithInsertID = array_merge($expected, 
								array('id' => $lastInsertId->id));
				$id = $lastInsertId->id;
				$responseGET = $this->HttpSocket->get(
								'http://localhost/collection-vci/api/Customers/paymentAccount/52e62476-7088-4e0e-87f3-15346aac1de6',
								$expectedMergerdWithInsertID);
				$GETResultJSON = (array) json_decode($responseGET->body);
				$getArray = (array) $GETResultJSON['payment'][0]->PaymentAccount;

				foreach($expectedMergerdWithInsertID as $key => $val) {

					if(array_key_exists($key, $getArray)) {
						$this->assertEqual($val, $getArray[$key]);
					}
				}
				$this->assertTrue($responsePOST->isOk());
		
		} else {
			pr($lastInsertId->Error);
		}
	}

/**
 * testApiPaymentAccount method
 *
 * @return void
 */
	public function ptestApiPaymentAccount() {
		$expected = array('id' => '52e8ce7c-a358-468f-8b18-12886aac1de6',
						'customer_id' => '52e62476-7088-4e0e-87f3-15346aac1de6');

		$response = $this->HttpSocket->get(
						'http://localhost/collection-vci/api/Customers/paymentAccount/52e62476-7088-4e0e-87f3-15346aac1de6',
						$expected);
		
		$GETResultJSON = (array) json_decode($response->body);
		$getArray = (array) $GETResultJSON['payment'][0]->PaymentAccount;
		
		$this->assertTrue($response->isOk());
		$this->assertEqual($getArray['id'], $expected['id']);
	}
	

}
