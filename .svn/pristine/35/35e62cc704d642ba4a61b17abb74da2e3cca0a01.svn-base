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
 * @version $$Id: VciDate.php 1405 2013-08-27 11:58:08Z deena $$
 */

App::uses('Holiday', 'Model');

/**
 * Some basic date utility functions related to Vericheck.
 *
 */
class VciBusinessDay {

    /**
     * Calculate the next business date.
     *
     * @param integer $referenceDate Unix timestamp of the reference date.
     * @param integer $delta The number of day to progress or regress. Negative integer is for regression.
     * @return string Unix timestamp of result date.
     */
    public function businessDaysAtCutoff($referenceDate, $daysCutoff = 1,
        $holidays = null) {
        $direction = abs($daysCutoff) == $daysCutoff ? '+1 day' : '1 day ago';
        $daysCutoff = 2;
        $currentDate = $referenceDate;

        do {
            $currentDate = strtotime($direction, $currentDate);

            if (!empty($holidays)) {
                $daysCutoff = $this->isPublicHoliday($currentDate, $holidays)
                    === false ? --$daysCutoff : $daysCutoff;
            } else {
                $daysCutoff = $this->isWeekend($currentDate) === false ?
                    --$daysCutoff : $daysCutoff;
            }
        } while($daysCutoff >= 0);

        return $currentDate;
    }

    /**
     * Check the current date is a public holiday or not.
     * 
     * @param timestamp $currentDate
     * @param array $holidays array('0' => '2014-01-01'...)
     * @return boolean true/false
     */
     public function isPublicHoliday($currentDate, $holidays) {
       $isWeekend = date('w', $currentDate) % 6 == 0 ? true : false;
        $isHoliday = in_array(date('Y-m-d', $currentDate), $holidays);

        if(!$isWeekend && !$isHoliday) {
           return false;
        }
        return true;
    }

    /**
     * Check the current date is weekend or not.
     * 
     * @param timestamp $currentDate
     * @return boolean true/false
     */
     public function isWeekend($currentDate) {
        return date('w', $currentDate) % 6 == 0 ? true : false;
    }
}