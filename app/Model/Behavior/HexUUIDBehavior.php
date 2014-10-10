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
App::uses('ModelBehavior', 'Model');

/**
 * 
 */
class HexUUIDBehavior extends ModelBehavior {

  public function beforeSave(Model $model, $options = array()) {
    $uuid = String::uuid();
    $model->data['ApiKey']['id'] = $uuid;
  }

  private function __hexUUID($uuid) {
    $uuid = str_replace('-', '', $uuid);
    $unhexed = pack('H*', $uuid);
  }
}