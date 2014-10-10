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

App::uses('Component', 'Controller');

/**
 * Mark microtime
 */
class MicrotimeComponent extends Component {

	private $__timeStart;

	private $__timeStop;

	public $microtimeDifference;

	public function __construct(ComponentCollection $collection, $settings = array()) {
		parent::__construct($collection, $settings);
	}

	/**
	 * Default action performed at first when the function is called.
	 * 
	 * @param Controller $controller
	 */
	public function startup(Controller $controller) {
		parent::startup($controller);
		$this->__start();
	}

	/**
	 * Default function called before the view is rendered
	 * 
	 * @param Controller $controller
	 */
	public function beforeRender(Controller $controller) {
		parent::beforeRender($controller);
		$this->__stop();
	}

	/**
	 * Mark the starting point.
	 */
	private function __start() {
		$this->__timeStart = microtime(true);
	}

	/**
	 * Get the time difference between start()
	 */
	private function __stop() {
		$this->__timeStop = microtime(true);
		$this->microtimeDifference = $this->__timeStop - $this->__timeStart;
	}

}