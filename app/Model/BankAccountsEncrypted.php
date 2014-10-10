<?php
App::uses('AppModel', 'Model');
/**
 * BankAccountsEncrypted Model
 *
 * @property BankAccount $BankAccount
 */
class BankAccountsEncrypted extends AppModel {

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

/**
 * Use table
 *
 * @var mixed False or table name
 */
	public $useTable = 'bank_accounts_encrypted';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'datum' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				'message' => 'Cannot be empty.',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasOne associations
 *
 * @var array
 */
	public $hasOne = array(
		'BankAccount' => array(
			'className' => 'BankAccount',
			'foreignKey' => 'encrypted_data',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

	public function __construct($id = false, $table = null, $ds = null) {
		parent::__construct($id, $table, $ds);
	}

}
