<?php

namespace App\Classes\Models;

use App\Classes\GoogleplusSdk;
use App\Classes\WebSoccer;

/**
 * Determines whether Google+ login-button shall disappear and provides log-in URL.
 */
class GoogleplusLoginModel implements IModel {
	private $_db;
	private $_i18n;
	private WebSoccer $_websoccer;
	
	public function __construct($db, $i18n, $websoccer) {
		$this->_db = $db;
		$this->_i18n = $i18n;
		$this->_websoccer = $websoccer;
	}
	
	public function renderView() {
		return $this->_websoccer->getConfig("googleplus_enable_login");
	}
	
	public function getTemplateParameters() {	
		return array("loginurl" => GoogleplusSdk::getInstance($this->_websoccer)->getLoginUrl());
	}
}
