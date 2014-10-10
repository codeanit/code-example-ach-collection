<?php
App::uses('AppModel', 'Model');
/**
 * Ppd Model
 *
 * @property AchTransaction $AchTransaction
 */
class Ppd extends AppModel {

    /**
     * Use table
     *
     * @var mixed False or table name
     */
    public $useTable = 'ppd';

    /**
     * Primary key field
     *
     * @var string
     */
    public $primaryKey = 'ach_transaction_id';

    /**
     * Display field
     *
     * @var string
     */
    public $displayField = 'name';

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'ach_transaction_id' => array(
                'uuid' => array(
                        'rule' => array('uuid'),
                        'message' => 'Field must be a UUID',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
        ),
        'transaction_code' => array(
                'minLength' => array(
                        'rule' => array('minlength', 2),
                        'message' => 'Must be 2 minimum in length.',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
        ),
        'routing_number' => array(
                'minLength' => array(
                        'rule' => array('minLength', 9),
                        'message' => 'Cannot be less than 9 in length.',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
                'numeric' => array(
                        'rule' => array('numeric'),
                        'message' => 'Must be numberic',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
        ),
        'account_number' => array(
                'minLength' => array(
                        'rule' => array('minLength', '17'),
                        'message' => 'Must be 17 in lenght',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
        ),
        'amount' => array(
                'decimal' => array(
                        'rule' => array('decimal', 2),
                        'message' => 'Must be 2 decimal number',
                        //'allowEmpty' => false,
                        //'required' => false,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),
        ),
        'name' => array(
                'alphabetsOnly' => array(
                        'rule' => '/^[a-zA-Z]+$/i',
                        'message' => 'Please enter alphabets only.',
//				'allowEmpty' => false,
//				'required' => true,
                        //'last' => false, // Stop validation after this rule
                        //'on' => 'create', // Limit validation to 'create' or 'update' operations
                ),

        ),
        'discretionary_data' => array(
                'maxLength' => array(
                        'rule' => array('maxLength', '2'),
                        'message' => 'Cannot be more than 2 in length',
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
            'AchTransaction' => array(
                    'className' => 'AchTransaction',
                    'foreignKey' => 'ach_transaction_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            )
    );
}
