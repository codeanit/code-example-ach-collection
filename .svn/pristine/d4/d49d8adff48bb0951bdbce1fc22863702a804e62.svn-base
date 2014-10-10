<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

App::uses('Component', 'Controller');
class SslComponent extends Component {

/**
 * Determine if SSL is used.
 * 
 * @return bool True if SSL, false if not used.
 */
	function is_ssl() {
		if ( isset($_SERVER['HTTPS']) ) {
			if ( 'on' == strtolower($_SERVER['HTTPS']) )
							return true;
			if ( '1' == $_SERVER['HTTPS'] )
							return true;
		} elseif ( isset($_SERVER['SERVER_PORT']) && 
						( '443' == $_SERVER['SERVER_PORT'] ) ) {
			return true;
		}
		return false;
	}

}