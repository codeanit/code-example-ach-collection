<?php
App::uses('AppController', 'Controller');
/**
 * StatusChanges Controller
 *
 * @property StatusChange $StatusChange
 * @property PaginatorComponent $Paginator
 */
class StatusChangesController extends AppController {

    public $uses = array('StatusChange', 'Merchant');

    /**
     *
     * @var int Merchant ID. 
     */
    protected $_merchantID;

    public function constructClasses() {
        parent::constructClasses();
    }

    public function beforeFilter() {
        parent::beforeFilter();
        $this->RequestHandler->ext = 'json';
    }

    /**
     * Cakephp default BASIC authentication mechanism, which is called
     * automatically.
     * 
     * @param type $user array('username'=> '', 'role'=>'')
     * @return boolean
     * @throws MethodNotAllowedException
     * @throws NotFoundException
     */
    public function isAuthorized($user) {
		$this->_merchantID = $user[0]['Merchant']['id'];

		$merchantData = $this->Merchant->find('first', array('conditions' => 
				array('Merchant.id ' => $this->_merchantID)));

		if (!empty($merchantData) && $merchantData['Merchant']['active'] == 'yes' 
						//&& $merchantData['ApiKey']['active'] == 'yes'
						) {
			return true;
		} elseif (!empty($merchantData) && 
						$merchantData['Merchant']['active'] == 'no') {
			$this->_viewData = $this->Merchant->error('Merchant Not Active!!!');
			$this->_setResponse(true);
		} elseif (!empty($merchantData) && 
						$merchantData['ApiKey']['active'] == 'no') {
			$this->_viewData = $this->Merchant->error('Merchant Not Active!!!');
			$this->_setResponse(true);
		} else {
			$this->_viewData = $this->Merchant->error('Merchant Not Found!!!');
			$this->_setResponse(true);
		}
	}

    /**
     * Returns all customers
     * 
     * TODO: the find all should be filtered by merchant who is
     * accessing it.
     */
    public function api_index() {
		if($this->request->is('get')) {
        $this->_viewData = $this->StatusChange->getStatusChangesOfTrans(
                    $this->_merchantID, $this->request->query);
        } else {
            $this->_viewData = $this->StatusChange->error(
                'This resource only allows GET requests.');
        }
        
    }
}