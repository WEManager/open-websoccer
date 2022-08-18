<?php

namespace App\Classes\Events;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\WebSoccer;

/**
 * Base class of all events which can be used at plug-ins.
 */
abstract class AbstractEvent {
	
	/**
	 * @var WebSoccer application context.
	 */
	public $websoccer;
	
	/**
	 * @var DbConnection database connection.
	 */
	public $db;
	
	/**
	 * @var I18n messages context.
	 */
	public $i18n;
	
	/**
	 * Assigns values for application context, DB connection and messages context.
	 * 
	 * @param WebSoccer $websoccer application context.
	 * @param DbConnection $db database connection.
	 * @param I18n $i18n messages context.
	 */
	function __construct(WebSoccer $websoccer, DbConnection $db, I18n $i18n) {
		$this->websoccer = $websoccer;
		$this->db = $db;
		$this->i18n = $i18n;
	}
	
}
