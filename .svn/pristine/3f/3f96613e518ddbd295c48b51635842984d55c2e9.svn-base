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
 * @version $$Id:$$
 */

App::uses('AppModel', 'Model');
App::uses('Holiday', 'Model');
App::uses('VciBusinessDay', 'Lib');

/**
 * AchTransaction Model
 *
 * @property Transaction $Transaction
 * @property Ccd $Ccd
 * @property Ppd $Ppd
 */
class AchTransaction extends AppModel {

        public $useDbConfig = 'default';

	/**
	 * Primary key field
	 *
	 * @var string
	 */
	public $primaryKey = 'id';

	public $actsAs = array('Containable');
/**
 * Validation rules
 *
 * @var array
 */
        public $validate = array(
                'id' => array(
                        'uuid' => array(
                                'rule' => array('uuid'),
                                'message' => 'Must be a UUID',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'transaction_id' => array(
                        'uuid' => array(
                                'rule' => array('uuid'),
                                'message' => 'Must be a UUID',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'transaction_type' => array(
                        'inList' => array(
                                'rule' => array('inList', array('debit', 'credit')),
                                'message' => 'Must be in the list (`debit`, `credit`)',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'company_entry_description' => array(
                        'maxLength' => array(
                                'rule' => array('maxLength', '10'),
                                'message' => 'Field can only contain only 10 characters',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                        'notEmpty' => array(
                                'rule' => array('notEmpty'),
                                'message' => 'Cannot be empty',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'standard_entry_class_code' => array(
                        'inList' => array(
                                'rule' => array('inList', array('ppd', 'ccd', 'web', 'tel', 'boc')),
                                'message' => 'Fields can only store be either `ppd`, `ccd`, `web`, `tel`, `boc`',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'check_number' => array(
                        'numeric' => array(
                                'rule' => array('numeric'),
                                'message' => 'Check number must be numeric',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
        );

        //The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
        public $belongsTo = array(
                'Transaction' => array(
                        'className' => 'Transaction',
                        'foreignKey' => 'transaction_id',
                        'conditions' => '',
                        'fields' => '',
                        'order' => ''
                )
        );

    /**
     * hasMany associations
     *
     * @var array
     */
    public $hasOne = array('Ccd', 'Ppd');

    /**
     * Cakephp default function called before save
     * 
     * @param array $options
     */
    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        return $this->__checkDuplicateTransaction();
    }

    /**
     * Checks thme transction duplicate for two busniessday cutoff.
     * 
     * @return boolean true/false
     */
    private function __checkDuplicateTransaction() {
        $VciBusinessDay = new VciBusinessDay();
        $lastBusinessDate = date('Y-m-d', 
            $VciBusinessDay->businessDaysAtCutoff(time(), '-2'));

        $duplicate = $this->find('all', array(
          'conditions' => array(
            'Ccd.routing_number' => $this->data['Ccd']['routing_number'],
            'Ccd.account_number' => $this->data['Ccd']['account_number'],
            'Ccd.amount' => $this->data['Ccd']['amount'],
            'Transaction.creation_time >' => $lastBusinessDate,
            'Transaction.payment_account_id' =>
            $this->data['Transaction']['payment_account_id'])));

        return empty($duplicate) ? true : false;
    }

    /**
     * Seperate type of AchTransaction being processed.
     * 
     * @param string $standarEntryClassCode Either Ppd or Ccd
     * @return string Either Ppd or Ccd
     */
    private function __getStandardEntryClassCode($standarEntryClassCode) {
        $standarEntryClassCode = ucfirst($standarEntryClassCode);
        if($standarEntryClassCode == 'Ppd') {
            $this->unBindModel(array('hasOne' => array('Ccd')));
        } else {
            $this->unBindModel(array('hasOne' => array('Ppd')));
        }

        return $standarEntryClassCode;
    }

    /**
     * Create AchTransaction.
     * 
     * Creation process is Transaction and ACID compliant.
     * 
     * @param array $data
     * @return type
     */
    public function createAchTransaction($data) {
        $standarEntryClassCode = $this->__getStandardEntryClassCode(
            $data['standard_entry_class_code']);
        $this->__setTransactionToData($data);
        $this->__setAchTranactionToData($data);
        $this->__setAchTransactionTypeToData($standarEntryClassCode, $data);

        $this->saveAssociated($this->data);

        if(($insertID = $this->getInsertID()) != null) {
            $this->unBindModel(array('belongsTo' => array('Transaction')));
            $condition = array('AchTransaction.id' => $insertID);
            $fields = array('AchTransaction.transaction_id');
            $return = $this->success($condition, $fields);
        } else {
            $error = empty($this->invalidFields())? 'Duplicate Transaction Error!!!':
                $this->getInvalidError($this->invalidFields());
            $return = $this->error($error);
        }
        return $return;
    }

    /**
     * Set Transaction model data.
     * @param type $data
     */
    public function __setTransactionToData($data) {
        $this->data['Transaction'] = array(
            'payment_account_id' => $data['payment_account_id'],
            'amount' => $data['amount'],
            'subtype' => $data['subtype'],
            'creation_time' => date('Y-m-d h:i:s'));
        $this->Transaction->useDbConfig = 'default';
    }

    /**
     * Set AchTransaction model data
     * 
     * @param array $data
     */
    public function __setAchTranactionToData($data) {
        $this->data['AchTransaction'] = array(
            'transaction_type' => $data['transaction_type'],
            'company_entry_description' => $data['company_entry_description'],
            'standard_entry_class_code' => $data['standard_entry_class_code'],
            'check_number' => $data['check_number']);
    }

    /**
     * Set AchTransaction type either Ccd or Ppd data.
     * 
     * @param string $standarEntryClassCode Either "Ccd" or "Ppd"
     * @param array $data
     */
    public function __setAchTransactionTypeToData($standarEntryClassCode, $data) {
        $this->data[$standarEntryClassCode] = array(
            'transaction_code' => $data['transaction_code'],
            'routing_number' => $data['routing_number'],
            'account_number' => $data['account_number'],
            'amount' => $data['standard_entry_class_code_amount'],
            'name' => $data['name'],
            'discretionary_data' => $data['discretionary_data']);
          $this->$standarEntryClassCode->useDbConfig = 'default';
    }

    
}