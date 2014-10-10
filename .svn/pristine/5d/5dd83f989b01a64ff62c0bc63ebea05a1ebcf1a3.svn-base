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

App::uses('Controller', 'Controller');
App::uses('File', 'Utility');
App::uses('AppExceptionRenderer', 'Lib');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *    
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

	public $uses = array('RequestMicrotime', 'User');

	public $components = array(
		'Auth' => array(
				'authorize' => array('Controller'),
				'authenticate' => array('SingleKey')),
		'RequestHandler' => array('checkHttpCache' => false),
		'Microtime');

	/**
	 * Time taken to process before rendering view.
	 * 
	 * @var type int
	 */
	protected $elapsedMicrotimeBeforeRender;

	/**
	 * Data to be loaded in the view
	 * 
	 * @var Array
	 */
	protected $_viewData;

	public function isAuthorized($user) {}

	/**
	 * Default function executed before firt statement
	 * in the controller.
	 */
	public function beforeFilter() {
		parent::beforeFilter();

		$this->RequestHandler->ext = 'json';
		$this->Auth->loginRedirect = $this->here;
	}

	/**
	 * Default function called after the view is rendered.
	 * 
	 */
	public function afterFilter() {
		parent::afterFilter();
		$this->elapsedMicrotimeBeforeRender = $this->Microtime->microtimeDifference;

		$insertID = $this->RequestMicrotime->insertElapsedMicrotime(
						array("elapsed_microtime" => $this->elapsedMicrotimeBeforeRender));

		if (Configure::read('Cake.Syslogng')) {
			$this->__logRequestDataIntoFile($insertID);

			$jsonEncodedData = $this->__jsonEncodeData($sql);

			CakeLog::write('collection_log', $jsonEncodedData);
		}
	}

	/**
	 * Default function called before view is rendered.
	 */
	public function beforeRender() {
		if(get_class($this) == 'CakeErrorController') {
			$this->_viewData = $this->setHttpError($this->response->statusCode());
		}
		$this->set(array(
				__CLASS__ => $this->_viewData,
					'_serialize' => __CLASS__));
	}

	/**
	 * Log serialized data into file at /srv/requests/
	 * 
	 * @param string $insertID UUID
	 */
	private function __logRequestDataIntoFile($insertID) {
			$this->__logDir = '/srv/requests/';
			$file = new File($this->__logDir . $insertID);
			$file->write($this->__getSerializedRequestData());
			$file->close();
	}

	/**
	 * serialize() $_ENV, $_REQUEST and $_SERVER
	 * 
	 * @return string serialized() data.
	 */
		private function __getSerializedRequestData() {
		$serializedRequestData .=
						mysql_real_escape_string(serialize(array("_SERVER" => $_SERVER)));
		$serializedRequestData .=
						mysql_real_escape_string(serialize(array("_ENV" => $_ENV)));
		$serializedRequestData .=
						mysql_real_escape_string(serialize(array("_REQUEST" => $_REQUEST)));

		return $serializedRequestData;
	}

	/**
	 * json_encode $_REQUEST and $_SERVER
	 * 
	 * @return string json_encoded data
	 */
	private function __jsonEncodeData() {
		$jsonEncodedData .= json_encode(array("_REQUEST" => $_REQUEST));
		$jsonEncodedData .= json_encode(array("_SERVER" => $_SERVER));

		return $jsonEncodedData;
	}

	/**
	 * Generic function to load view
	 */
	protected function _setResponse($authfail = false) {

		if($authfail = true) {echo json_encode($this->_viewData);}

		$this->set(array(
				__CLASS__ => $this->_viewData,
					'_serialize' => __CLASS__));
	}

/**
 * Set error message
 * 
 * @param int $httpResponseCode 404, 401 etc
 * return array array('success' => 'false',
	*											'message'=> String)
 */
	public function setHttpError($httpResponseCode) {
		$errorMessage = "";
		if($httpResponseCode == 404) {
			$errorMessage = 'Requested URL Not Found';
			http_response_code(404);
		}

		if($httpResponseCode == 401){
			$errorMessage = 'Invalid Authentication';
			http_response_code(401);
		}

		return $this->RequestMicrotime->error($errorMessage);
	}

}