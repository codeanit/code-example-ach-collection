<?php
App::uses('PendingMerchant', 'Model');

/**
 * PendingMerchant Test Case
 *
 */
class PendingMerchantTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.pending_merchant',
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->PendingMerchant = ClassRegistry::init('PendingMerchant');
		
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->PendingMerchant);

		parent::tearDown();
	}

	public function testAddMerchant() {
		$data = array(
		"name" => "Acme Sportswear Inc",
		"dba" => "Acme Sports",
		"federal_tax_id" => "837273270",
		"phone" => "532-623-7543",
		"fax" => "254-235-4543",
		"website" => "acmesportswear.com",
		"naics" => "324632",
	//	"allow_customer_credit" => false,
		"expected_trans_per_month" => 2000,
		"expected_average_amount" => 150,
		"lowest_amount_allowed" => 1,
		"highest_amount_allowed" => 600,
		//"check_for_duplicates" => true,
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

		$return = $this->PendingMerchant->addMerchant($data);
		$this->assertEqual($return['success'], 'true');
		
		$merchants = $this->PendingMerchant->find(
					'all', array(
							'fields' => array('*'),
						));
		foreach($data as $key => $val) {
			$this->assertEqual($val, $merchants[0]['PendingMerchant'][$key]);
		}
	}
	
	public function testFindMerchant() {
		$return = $this->PendingMerchant->findMerchant();
		$this->assertEqual($return['success'], 'true');
		$this->assertNotEmpty($return['payload']);
		$this->assertEqual($return['payload'][0]['PendingMerchant']['id'], '53b65a82-2400-4da1-bfc0-12c06aac1de6');
	}
	
}
