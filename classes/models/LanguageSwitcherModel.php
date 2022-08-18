<?php

namespace App\Classes\Models;

/**
 * @author Ingo Hofmann
 */
class LanguageSwitcherModel implements IModel {
	private $_db;
	private $_i18n;
	private $_websoccer;
	
	public function __construct($db, $i18n, $websoccer) {
		$this->_db = $db;
		$this->_i18n = $i18n;
		$this->_websoccer = $websoccer;
	}
	
	public function renderView() {
		return (count($this->_i18n->getSupportedLanguages()) > 1);
	}
	
	public function getTemplateParameters() {
		return array();
	}	
}

?>