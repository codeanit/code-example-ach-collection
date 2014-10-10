<?php
App::uses('AdminController', 'Controller');
/**
 * ApiKeys Controller
 *
 * @property ApiKey $ApiKey
 * @property PaginatorComponent $Paginator
 */
class ApiKeysController extends AdminController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->ApiKey->recursive = 0;
		$this->set('apiKeys', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->ApiKey->exists($id)) {
			throw new NotFoundException(__('Invalid api key'));
		}
		$options = array('conditions' => array('ApiKey.' . $this->ApiKey->primaryKey => $id));
		$this->set('apiKey', $this->ApiKey->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->ApiKey->create();
			if ($this->ApiKey->save($this->request->data)) {
				$this->Session->setFlash(__('The api key has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The api key could not be saved. Please, try again.'));
			}
		}
		$merchants = $this->ApiKey->Merchant->find('list');
		$this->set(compact('merchants'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->ApiKey->exists($id)) {
			throw new NotFoundException(__('Invalid api key'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->ApiKey->save($this->request->data)) {
				$this->Session->setFlash(__('The api key has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The api key could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('ApiKey.' . $this->ApiKey->primaryKey => $id));
			$this->request->data = $this->ApiKey->find('first', $options);
		}
		$merchants = $this->ApiKey->Merchant->find('list');
		$this->set(compact('merchants'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->ApiKey->id = $id;
		if (!$this->ApiKey->exists()) {
			throw new NotFoundException(__('Invalid api key'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->ApiKey->delete()) {
			$this->Session->setFlash(__('The api key has been deleted.'));
		} else {
			$this->Session->setFlash(__('The api key could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}

}