<?php
App::uses('AchTransaction', 'Model');

/**
 * AchTransaction Test Case
 *
 */
class AchTransactionTest extends CakeTestCase {

    /**
     * Fixtures
     *
     * @var array
     */
//    public $fixtures = array(
//            'app.ach_transaction',
//            'app.transaction',
//            'app.payment_account',
//            'app.customer',
//            'app.merchant',
//            'app.api_key',
//            'app.ccd',
//            'app.ppd');

        /**
	 *
	 * @var boolean 
	 */
	public $autoFixtures = false;
    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->AchTransaction = ClassRegistry::init('AchTransaction');
        $this->AchTransaction->useDbConfig = 'default';
    }

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
            unset($this->AchTransaction);

            parent::tearDown();
	}

    /**
     * 
     */
    public function testCreateAchTransaction() {
       $expectedPOST = array(
		'payment_account_id' => '534605f2-1968-4aae-a98d-3e346aac1de6',
		'amount' => '12.01',
		'subtype' => 'ach_transactions',
		'transaction_type' => 'debit',
		'company_entry_description' => 'testing',
                'standard_entry_class_code' => 'ccd',
                'check_number' => '1234', 
                'transaction_code' => 'C1',
                'routing_number' => '123456789',
                'account_number' => '12345679123456789',
                'standard_entry_class_code_amount' => '12.04',
                'discretionary_data' => 'D2',
                'name' => 'Anit',
                'creation_time' => date('Y-m-d h:i:s'));
       
        $return = $this->AchTransaction->createAchTransaction($expectedPOST);
        $this->assertEqual($return['success'], 'true');

        $params = array('conditions' => array(
            'AchTransaction.transaction_id'=> $return['payload'][0]['AchTransaction']
            ['transaction_id']));
        $return = $this->AchTransaction->find('all', $params);

       $this->assertEqual($return[0]['Transaction']['payment_account_id'],
           $expectedPOST['payment_account_id']);
       $this->assertEqual($return[0]['Transaction']['amount'],
           $expectedPOST['amount']);
       $this->assertEqual($return[0]['Transaction']['subtype'],
           $expectedPOST['subtype']);

       $this->assertEqual($return[0]['AchTransaction']['transaction_type'],
           $expectedPOST['transaction_type']);
       $this->assertEqual($return[0]['AchTransaction']['company_entry_description'],
           $expectedPOST['company_entry_description']);
       $this->assertEqual($return[0]['AchTransaction']['standard_entry_class_code'],
           $expectedPOST['standard_entry_class_code']);
       $this->assertEqual($return[0]['AchTransaction']['check_number'],
           $expectedPOST['check_number']);

       $this->assertEqual($return[0]['Ccd']['transaction_code'],
           $expectedPOST['transaction_code']);
       $this->assertEqual($return[0]['Ccd']['routing_number'],
           $expectedPOST['routing_number']);
       $this->assertEqual($return[0]['Ccd']['account_number'],
           $expectedPOST['account_number']);
       $this->assertEqual($return[0]['Ccd']['amount'], $expectedPOST['standard_entry_class_code_amount']);
       $this->assertEqual($return[0]['Ccd']['name'], $expectedPOST['name']);
       $this->assertEqual($return[0]['Ccd']['discretionary_data'],
           $expectedPOST['discretionary_data']);
    }

    public function testCheckDuplicateTrans() {
        $expectedPOST = array(
                'payment_account_id' => '534605f2-1968-4aae-a98d-3e346aac1de6',
                'amount' => '12.01',
                'subtype' => 'ach_transactions',
                'transaction_type' => 'debit',
                'company_entry_description' => 'testing',
                'standard_entry_class_code' => 'ccd',
                'check_number' => '1234', 
                'transaction_code' => 'C1',
                'routing_number' => '123456789',
                'account_number' => '12345679123456789',
                'standard_entry_class_code_amount' => '12.04',
                'discretionary_data' => 'D2',
                'name' => 'Anit',
                'creation_time' => date('Y-m-d h:i:s'));

            $return = $this->AchTransaction->createAchTransaction($expectedPOST);
            $this->assertEqual($return['success'], 'false');
    }

}