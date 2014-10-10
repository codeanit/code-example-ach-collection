<?php
App::uses('AppModel', 'Model');
/**
 * NoticeOfChangeTransaction Model
 *
 * @property VericheckTransaction $VericheckTransaction
 * @property NoticeOfChange $NoticeOfChange
 */
class NoticeOfChangeTransaction extends AppModel {

/**
 * Use database config
 *
 * @var string
 */
	public $useDbConfig = 'olap_api';

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
			'minLength' => array(
				'rule' => array('minLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'vericheck_transaction_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'gateway_transaction_id' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'uuid' => array(
				'rule' => array('uuid'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'merchant_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'notice_of_change_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'return_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'notEmpty' => array(
				'rule' => array('notEmpty'),
				//'message' => 'Your custom message here',
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
            'NoticeOfChange' => array(
                    'className' => 'NoticeOfChange',
                    'foreignKey' => 'notice_of_change_id',
                    'conditions' => '',
                    'fields' => '',
                    'order' => ''
            )
    );

    /**
     * Get transacitons with notice of changes
     * 
     * @param array $contdition array('return_date' => YYYY-MM-DD)
     * @return array 
     */
    public function getTransWithNOC($merchantID, $condition) {
        $condition['merchant_id'] = $merchantID;

        if (!key_exists('return_date', $condition)
            || $condition['return_date'] === ''
            || !preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $condition['return_date'])) {
            $result = $this->error(
                '`return_date` is required in the format YYYY-MM-DD!');
        } else {
            $feilds = array('vericheck_transaction_id', 
              'gateway_transaction_id', 'corrected_data', 'NoticeOfChange.*');
            $data = $this->success($condition, $feilds);
            $result = $this->formatData($data['payload']);
        }
        return $result;
    }

    /**
     * Format payload array structure to 
     * (
                [vericheck_transaction_id] => 534e3626-98f0-43a0-a654-91986aac1de6
                [gateway_transaction_id] => 534e3626-98f0-43a0-a654-91986aac1de6
                [corrected_data] => 464647934
                [notice_of_change] => Array
                    (
                        [code] => 2
                        [reason] => Incorrect transit/routing number
                        [description] => Once valid transit/routing number must be changed
                    )

            )
     * @param array $data
     * @return array
     */
    public function formatData($data) {
        $changedOutput = array();
        for ($i=0; $i < count($data); $i++) {
            $changedOutput[$i] = $data[$i]['NoticeOfChangeTransaction'];
            if ($data[$i]['NoticeOfChange']['code'] === 1
                || $data[$i]['NoticeOfChange']['code'] == 6) {
                $changedOutput[$i]['corrected_data'] = null;
            }
            $changedOutput[$i]['notice_of_change'] = 
                $this->__setNoticeOfChangeData($data[$i]);
        }
        return array('success' => true, 'payload' => $changedOutput); 
    }

    /**
     * Append "C0" or "C" to NoticeOfChange.code
     */
    private function __setNoticeOfChangeData($noticeOfChange) {
        $noticeOfChange['NoticeOfChange']['code'] =
            intval($noticeOfChange['NoticeOfChange']['code']) > intval(9) ?
            'C' . $noticeOfChange['NoticeOfChange']['code'] :
            'C0' . $noticeOfChange['NoticeOfChange']['code'];
        return $noticeOfChange['NoticeOfChange'];
    }
}