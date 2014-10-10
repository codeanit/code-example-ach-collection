<?php

App::uses('VciBusinessDay', 'Lib');
App::uses('Holiday', 'Model');

/**
 * Test VciBusinessDay
 *
 */
class VciBusinessDayTest extends CakeTestCase {

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp() {
        parent::setUp();
        $this->VciBusinessDay = new VciBusinessDay();
    }

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
            unset($this->VciBusinessDay);

            parent::tearDown();
	}

    /**
     * 
     */
    public function testTwoBusinessDaysCutoff() {
        $expected = "2014-04-09";

        $holiday = new Holiday();
        $holidays = $holiday->getHolidays();

        $actual = $this->VciBusinessDay->businessDaysAtCutoff(
            strtotime('14 April 2014'),
//            time(),
            '-2',
            $holidays
            );
        $actual = date('Y-m-d', $actual);
        $this->assertEqual($actual, $expected);
    }
}
