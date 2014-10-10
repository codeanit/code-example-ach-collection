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

App::uses('AppShell', '/Console/Command');
App::uses('HttpSocket', 'Network/Http');

/**
 * Access Customers REST APIs
 * 
 */
class CustomersShell extends AppShell {

	private $HttpSocket;

	public function __construct() {
		$this->HttpSocket = new HttpSocket();

		parent::__construct();
	}

	public function getOptionParser() {
		$parser = parent::getOptionParser();
		
		$parser->description('Smoke Test Customers REST API.')
						->addOption('list', array('short' => 'l',
								'help' => 'List Customers', 'required' => false))
						->addOption('insert', array('short' => 'i',
								'help' => 'Insert Customers', 'required' => false));

		return $parser;
	}

	public function main() {
		if (key($this->params) == "list") {
//				$params = $this->params[''];
			$this->__getCustomers();

		} elseif ((key($this->params) == "insert")) {
			$this->__insertCustomers();

		} else {
			$this->out($this->OptionParser->help());
			$this->out(__d('cake_console',
					"Please choose one option."));
		}
	}

	/**
	 * 
	 */
	private function __getCustomers() {
		$response = $this->HttpSocket->get(
						'http://localhost/Collection/trunk/Customers.json');
		debug($response['body']);
	}

	/**
	 * 
	 */
	private function __insertCustomers() {
			$POST = array('name' => 'Anit Shrestha',
					'mobile_phone' => '9841374040');
			$jsonString = json_encode($POST);

			$response = $this->HttpSocket->post(
					'http://localhost/Collection/trunk/Customers/add.json',
					$jsonString
			);

debug($response);

	
	}

}