<?php
App::uses('AppModel', 'Model');
/**
 * StatusChange Model
 *
 */
class StatusChange extends AppModel {

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
		'uuid' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'transaction_id' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'minLength' => array(
				'rule' => array('minLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'money' => array(
				'rule' => array('money'),
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
		),
		'change_timestamp' => array(
			'datetime' => array(
				'rule' => array('datetime'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'origination_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'effective_date' => array(
			'date' => array(
				'rule' => array('date'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'settlement_date' => array(
			'date' => array(
				'rule' => array('date'),
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
		),
		'return_code' => array(
			'maxLength' => array(
				'rule' => array('maxLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'status' => array(
			'alphaNumeric' => array(
				'rule' => array('alphaNumeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'reason' => array(
			'maxLength' => array(
				'rule' => array('maxLength'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

       /**
     * Get transacitons with status changes.
     * 
     * @param array $contdition array('return_date' => YYYY-MM-DD)
     * @return array 
     */
    public function getStatusChangesOfTrans($merchantID,$uuid) {
		$data = $this->findByUuid($uuid['uuid']);
        $condition = array(
			'merchant_id' => $merchantID,
			'change_timestamp >' => $data['StatusChange']['change_timestamp']
		);
		
        $feilds = array(
            "uuid",
            "transaction_id",
            "change_timestamp",
            "origination_date",
            "effective_date",
            "settlement_date",
            "return_date",
            "return_code",
            "status",
            "reason");
        $data = $this->success($condition, $feilds);
        $result = $this->__formatData($data['payload']);

        return $result;
    }

    /**
     * Format payload array structure to 
     * â€œnew_last_indexâ€: â€œ910789f0de5611e38e1597ecceaf7483â€,
        â€œtransactions: [
                {
                   "transaction_id":"83523432",
                   "change_timestamp":"1231887603",
                   "origination_date":"2014-05-05",
                   "effective_date":"2014-05-06",
                   "settlement_date":"2014-05-07",
                   "return_date":"2014-05-08",
                   "return_code":"R01",
                   "status":"R",
                   "reason":"Insufficient funds.",
                },
          ]
     * @param array $data
     * @return array
     */
    private function __formatData($data) {
        $payload = array();
        $changedOutput = array();
        $newLastIndex = "";
        for ($i=0; $i < count($data); $i++) {
//            if($i !== 0) {
                $newLastIndex = $data[$i]['StatusChange']['uuid'];
                unset($data[$i]['StatusChange']['id']);
                unset($data[$i]['StatusChange']['uuid']);
                $data[$i]['StatusChange']['change_timestamp'] =
                    strtotime($data[$i]['StatusChange']['change_timestamp']);
                $changedOutput[$i] = $data[$i]['StatusChange'];
//            }
        }
        $payload['transactions'] = $changedOutput;
        $payload['new_last_index'] = $newLastIndex;
        return array('success' => true, 'payload' => $payload); 
    }
}