<?php
App::uses('AppModel', 'Model');
App::uses('Customer', 'Model');

/**
 * BankAccount Model
 *
 * @property PaymentAccount $PaymentAccount
 * @property BankAccountsEncrypted $BankAccountsEncrypted
 */
class BankAccount extends AppModel {

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'id';

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
            'payment_account_id' => array(
                    'uuid' => array(
                            'rule' => array('uuid'),
                            //'message' => 'Your custom message here',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
            ),
            'encrypted_data' => array(
                    'uuid' => array(
                            'rule' => array('uuid'),
                            'message' => 'Field must be an UUID',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
            ),
            'routing_number' => array(
                    'minLength' => array(
                            'rule' => array('minLength', '9'),
                            'message' => 'Routing number must be 9 numbers in length',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
                    'maxLength' => array(
                            'rule' => array('maxLength', '9'),
                            'message' => 'Routing number can only be 9 numbers in length',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
                    'numeric' => array(
                            'rule' => array('numeric'),
                            'message' => 'Routing number must be numeric',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
            ),
            'account_number_last_four_digits' => array(
                    'maxLength' => array(
                            'rule' => array('maxLength', '4'),
                            'message' => 'Field must contain minimum 4 digits.',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
                    'minLength' => array(
                            'rule' => array('minLength', '4'),
                            'message' => 'Field can contain maximum 4 digits.',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
                    'numeric' => array(
                            'rule' => array('numeric'),
                            'message' => 'Field can only have digits.',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
            ),
            'account_type' => array(
                    'inList' => array(
                            'rule' => array('inList', array('savings', 'checking')),
                            'message' => 'Fields can only store be either `savings` or `checking`',
                            //'allowEmpty' => false,
                            //'required' => false,
                            //'last' => false, // Stop validation after this rule
                            //'on' => 'create', // Limit validation to 'create' or 'update' operations
                    ),
            ),
    );

    /**
     * belongsTo associations
     *
     * @var array
     */
    public $belongsTo = array(
        'PaymentAccount' => array(
            'className' => 'PaymentAccount',
            'foreignKey' => 'payment_account_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        ),
        'BankAccountsEncrypted' => array(
            'className' => 'BankAccountsEncrypted',
            'foreignKey' => 'encrypted_data',
            'conditions' => '',
            'fields' => '',
            'order' => ''));

    public function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);
    }

    /**
     * Create Customers Payment Account.
     * 
     * Creation process is Transaction and ACID compliant.
     * 
     * @param array $data array(
        'customer_id' => '5344d346-cef4-41e3-8f42-2c7c6aac1de6',
        'subtype' => 'bank_accounts',
        'routing_number' => '655060042',
        'account_number_last_four_digits' => '1234',
        'account_type' => 'savings');
     * @return array array('success' => 'true', 'paylod' => array()) OR
     *  array('success' => 'false', 'message' => string)
     */
    public function createPaymentAccount($data) {
        $this->__setBankAccount($data);
        $this->__setBankAccountEncrypted($data);
        $this->__setPaymentAccount($data);
        $this->saveAssociated($this->data);

        if(($insertID = $this->getInsertID()) != null) {
            $condition = array('BankAccount.id' => $insertID);
            $fields = array('PaymentAccount.id');
            $return = $this->success($condition, $fields);
        } else {
            $return = $this->error($this->getInvalidError($this->invalidFields()));
        }
        return $return;
    }

    /**
     * Set PaymentAccount model data.
     * @param array $data
     */
    private function __setPaymentAccount($data) {
        $this->data['PaymentAccount']['subtype'] = $data['subtype'];
        $this->data['PaymentAccount']['customer_id'] = $data['customer_id'];
        $this->PaymentAccount->useDbConfig = 'default';
    }

    /**
     * Set BankAccount model data
     * 
     * @param array $data
     */
    private function __setBankAccount($data) {
        $this->data['BankAccount'] = array(
          'routing_number' => $data['routing_number'],
          'account_number_last_four_digits' => $data['account_number_last_four_digits'],
          'account_type' => $data['account_type']);
    }

    /**
     * Set BankAccountEncrypted model data
     * 
     * @param array $data
     */
    private function __setBankAccountEncrypted($data) {
        $Customer = new Customer();
        $customersEncryptedData = $Customer->getBankAccountEncryptedData($data);
        $this->data['BankAccountsEncrypted'] = array('datum' => $customersEncryptedData);
        $this->BankAccountsEncrypted->useDbConfig = 'default';
    }
}