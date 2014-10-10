<?php
App::uses('AppModel', 'Model');
/**
 * Transaction Model
 *
 * @property PaymentAccount $PaymentAccount
 */
class Transaction extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'id';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				'message' => 'Must be UUID'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'payment_account_id' => array(
			'uuid' => array(
				'rule' => array('uuid'),
				'message' => 'Must be UUID'
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'amount' => array(
			'decimal' => array(
				'rule' => array('decimal', 2),
				'message' => 'Must be a decimal 2',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'subtype' => array(
			'inList' => array(
				'rule' => array('inList', array('ach_transactions', 'credit_card_transactions', 'debit_card_transactions', 'icl_transactions')),
                                'message' => 'Must be either one of them `ach_transactions`, `credit_card_transactions`, `debit_card_transactions`, `icl_transactions` ',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'creation_time' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				'message' => 'Must be a datetime FORMAT YYYY:MM:DD HH:MM::SS',
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
		'PaymentAccount' => array(
			'className' => 'PaymentAccount',
			'foreignKey' => 'payment_account_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

}