<?php
App::uses('NoticeOfChange', 'Model');

/**
 * NoticeOfChange Test Case
 *
 */
class NoticeOfChangeTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'app.notice_of_change',
		'app.notice_of_change_transaction'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->NoticeOfChange = ClassRegistry::init('NoticeOfChange');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->NoticeOfChange);

		parent::tearDown();
	}

}
