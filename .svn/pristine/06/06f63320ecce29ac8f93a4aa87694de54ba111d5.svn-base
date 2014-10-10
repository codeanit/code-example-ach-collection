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

App::uses('MerchantsController', 'Controller');
App::uses('HttpSocket', 'Network/Http');

/**
 * CustomersController Test Case
 *
 */
class MerchantsControllerTest extends ControllerTestCase {


	
	/**
	 * setUp method
	 *
	 * @return void
	 */
	public function setUp() {
		parent::setUp();

		$this->Merchants = new MerchantsController();
		$this->HttpSocket = new HttpSocket();
		$this->HttpSocket->configAuth('Basic', 'admin', 'admin');

	}

	/**
	 * tearDown method
	 * 
	 *  @return void
	 */
	public function tearDown() {
		unset($this->Merchants);
		unset($this->HttpSocket);
		parent::tearDown();
	}


/**
 * testApiView method
 *
 * @return void
 */
	public function ptestApiView() {
		$expected = array("id" => "53ba27da-330c-4b54-a662-14806aac1de6",
		"name" => "Acme Sportswear Inc");

		$response = $this->HttpSocket->get(
						'http://localhost/collection-vci/api/Merchants/view/53ba27da-330c-4b54-a662-14806aac1de6',
						$expected);
		
		
		$GETResultJSON = (array) json_decode($response->body);
		$getArray = (array) $GETResultJSON['payload'][0]->PendingMerchant;
		
		$this->assertTrue($response->isOk());
		$this->assertEqual($getArray['name'], $expected['name']);
		$this->assertEqual($getArray['id'], $expected['id']);
	}

/**
 * testApiAdd method
 *
 * @return void
 */
	public function testApiAdd() {
		$expected = array(
		"name" => "Acme Sportswear Inc123",
		"dba" => "Acme Sports123",
		"federal_tax_id" => "837273270",
		"phone" => "532-623-7543",
		"fax" => "254-235-4543",
		"website" => "acmesportswear.com",
		"naics" => "324632",
		"allow_customer_credit" => 'false',
		"expected_trans_per_month" => 2000,
		"expected_average_amount" => 150,
		"lowest_amount_allowed" => 1,
		"highest_amount_allowed" => 600,
		"check_for_duplicates" => 'true',
		"partner_approved_tier" => "green",
		"routing" => "143367854",
		"account" => "7384323245352",
		"type" => "checking",
		"address1" => "235 Coconut Drive",
		"address2" => "Suite 432",
		"city" => "Atlanta",
		"state" => "GA",
		"zip" => "30308",
		"support_contact_name" => "Adam Smith",
		"support_contact_email" => "support@acmesportswear.com",
		"support_contact_phone" => "134-242-6342",
		"principal_name" => "Bob Damon",
		"principal_address1" => "352 Windy Drive",
		"principal_address2" => "",
		"principal_city" => "Dunwoody",
		"principal_state" => "GA",
		"principal_zip" => "30082",
		"principal_phone" => "342-253-4563",
		"principal_email" => "bob.damon@acmesportswear.com",
		"account_executive_name" => "Jack Davis",
		"account_executive_phone" => "432-635-1254",
		"account_executive_email" => "jack.davis@mercurypay.com",
		"standard_entry_classes" => "CCD");

		$jsonString = json_encode($expected);
		$responsePOST = $this->HttpSocket->post(
						'http://localhost/collection-vci/api/Merchants/add',
						$jsonString); 
		$LastInsertID = json_decode($responsePOST, true);
		$id = $LastInsertID['payload'][0]['PendingMerchant']['id'];
		$expectedMergerdWithInsertID = array_merge($expected, 
						array('id' => $id));
		$responseGET = $this->HttpSocket->get(
						'http://localhost/collection-vci/api/Merchants/view/'.$id,
						$expectedMergerdWithInsertID);
		$GETResultJSON = (array) json_decode($responseGET->body);
		$getArray = (array) $GETResultJSON['payload'][0]->PendingMerchant;
		foreach($expectedMergerdWithInsertID as $key => $val) {
			if(array_key_exists($key, $getArray)) {
				$this->assertEqual($val, $getArray[$key]);
			} 
		}
		$this->assertTrue($responsePOST->isOk());
		$this->assertEqual($getArray['name'], $expected['name']);
	}


}
