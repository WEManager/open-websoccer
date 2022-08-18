<?php

namespace App\Classes\Events;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\SimulationMatch;
use App\Classes\WebSoccer;

/**
 * Event triggered when a match (no matter if regular, friendly or youth match) is completed. All other evend handlers
 * have been called before.
 * DO NOT FORGET TO CHECK WHETHER MATCH IS A YOUTH MATCH OR NOT!
 */
class MatchCompletedEvent extends AbstractEvent {
	
	/**
	 * @var SimulationMatch Data model of completed match.
	 */
	public $match;
	
	/**
	 * 
	 * @param WebSoccer $websoccer Application context.
	 * @param DbConnection $db DB connection.
	 * @param I18n $i18n Messages context.
	 * @param SimulationMatch $match Match data model.
	 */
	function __construct(WebSoccer $websoccer, DbConnection $db, I18n $i18n, SimulationMatch $match) {
		parent::__construct($websoccer, $db, $i18n);
		
		$this->match = $match;
	}
}
