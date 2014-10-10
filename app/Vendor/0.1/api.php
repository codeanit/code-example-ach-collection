<?php
App::import('Vendor', 'api/api');

class Api_0_1 extends Api {
	public $version = 0.1;

	function customersGet() {
			//Get posts, store them in an array and set them for the view?
			//Whatever code would go into the api_get() method in the posts controller, should go in here
			//With only one minor alteration, calls to $this-> should be replaced with $this->controller->

			$posts = $this->controller->Customers->find('all', array(
					'contain'=>false
			));
			$this->controller->set(compact('customers'));
	}
}