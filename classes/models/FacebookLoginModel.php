<?php

namespace App\Classes\Models;

use App\Classes\FacebookSdk;
use App\Classes\WebSoccer;

/**
 * Determines whether Facebook login-button shall disappear and provides log-in URL.
 */
class FacebookLoginModel implements IModel {
	private $_db;
	private $_i18n;
	private WebSoccer $_websoccer;
	
	public function __construct($db, $i18n, $websoccer) {
		$this->_db = $db;
		$this->_i18n = $i18n;
		$this->_websoccer = $websoccer;
	}
	
	public function renderView() {
		return $this->_websoccer->getConfig("facebook_enable_login");
	}
	
	public function getTemplateParameters() {	
		return array("loginurl" => FacebookSdk::getInstance($this->_websoccer)->getLoginUrl());
	}
}
