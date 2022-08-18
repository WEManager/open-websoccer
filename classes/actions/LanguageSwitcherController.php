<?php

namespace App\Classes\Actions;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\WebSoccer;

class LanguageSwitcherController implements IActionController {
	private $_i18n;
	private $_websoccer;
	private $_db;
	
	public function __construct(I18n $i18n, WebSoccer $websoccer, DbConnection $db) {
		$this->_i18n = $i18n;
		$this->_websoccer = $websoccer;
		$this->_db = $db;
	}
	
	public function executeAction($parameters) {
		$lang = strtolower($parameters["lang"]);
		
		$this->_i18n->setCurrentLanguage($lang);
		
		// update user profile
		$user = $this->_websoccer->getUser();
		if ($user->id != null) {
			$fromTable = $this->_websoccer->getConfig("db_prefix") ."_user";
			$columns = array("lang" => $lang);
			$whereCondition = "id = %d";
			$this->_db->queryUpdate($columns, $fromTable, $whereCondition, $user->id);
		}
		
		// re-include messages in order to update UI immediately
		global $msg;
		$msg = array();
		include(sprintf(CONFIGCACHE_MESSAGES, $lang));
		include(sprintf(CONFIGCACHE_ENTITYMESSAGES, $lang));
			
		return null;
	}	
}
