<?php

namespace App\Classes\Models;

define("NUMBER_OF_TOP_NEWS", 5);

/**
 * @author Ingo Hofmann
 */
class TopNewsListModel implements IModel {
	private $_db;
	private $_i18n;
	private $_websoccer;
	
	public function __construct($db, $i18n, $websoccer) {
		$this->_db = $db;
		$this->_i18n = $i18n;
		$this->_websoccer = $websoccer;
	}
	
	public function renderView() {
		return TRUE;
	}
	
	public function getTemplateParameters() {
		$fromTable = $this->_websoccer->getConfig("db_prefix") . "_news";
		
		// select
		$columns = "id, titel, datum";
		$whereCondition = "status = 1 ORDER BY datum DESC";
		$result = $this->_db->querySelect($columns, $fromTable, $whereCondition, array(), NUMBER_OF_TOP_NEWS);
		
		$articles = array();
		while ($article = $result->fetch_array()) {
			$articles[] = array("id" => $article["id"],
								"title" => $article["titel"],
								"date" => $this->_websoccer->getFormattedDate($article["datum"]));
		}
		$result->free();
		
		return array("topnews" => $articles);
	}
	
	
}

?>