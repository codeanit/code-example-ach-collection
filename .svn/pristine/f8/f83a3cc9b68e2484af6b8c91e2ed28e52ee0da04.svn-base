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

App::uses('AdminController', 'Controller');
App::uses('User', 'Model');

class UsersController extends AdminController {

	public $helpers = array('Html', 'Form', 'Session');

	public $components = array(
		'Auth' => array(
				'authorize' => array('Controller'),
				'authenticate' => array('Basic')),
				'RequestHandler' => array('checkHttpCache' => false));

	public function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow();
	}

	public function index() {
			$this->User->recursive = 0;
			$this->set('users', $this->paginate());
	}

	public function view($id = null) {
			$this->User->id = $id;
			if (!$this->User->exists()) {
					throw new NotFoundException(__('Invalid user'));
			}
			$this->set('user', $this->User->read(null, $id));
	}

	public function add() {
		if ($this->request->is('post')) {
				$this->User->create();
				if ($this->User->save($this->request->data)) {
						$this->Session->setFlash(__('The user has been saved'));
						$this->redirect(array('action' => 'add'));
				}
				$this->Session->setFlash(
						__('The user could not be saved. Please, try again.')
				);
		}
	}

	public function edit($id = null) {
			$this->User->id = $id;
			if (!$this->User->exists()) {
					throw new NotFoundException(__('Invalid user'));
			}
			if ($this->request->is('post') || $this->request->is('put')) {
					if ($this->User->save($this->request->data)) {
							$this->Session->setFlash(__('The user has been saved'));
							return $this->redirect(array('action' => 'index'));
					}
					$this->Session->setFlash(
							__('The user could not be saved. Please, try again.')
					);
			} else {
					$this->request->data = $this->User->read(null, $id);
					unset($this->request->data['User']['password']);
			}
	}

	public function delete($id = null) {
			$this->request->onlyAllow('post');

			$this->User->id = $id;
			if (!$this->User->exists()) {
					throw new NotFoundException(__('Invalid user'));
			}
			if ($this->User->delete()) {
					$this->Session->setFlash(__('User deleted'));
					return $this->redirect(array('action' => 'index'));
			}
			$this->Session->setFlash(__('User was not deleted'));
			return $this->redirect(array('action' => 'index'));
	}

	public function logout() {
		$this->redirect($this->Auth->logout());
	}
}