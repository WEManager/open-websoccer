<?php

namespace App\Classes\Events;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\SimulationPlayer;
use App\Classes\WebSoccer;

/**
 * This event is triggered when a youth player played at a youth match. Plug-Ins can also override
 * the computed strength change of a youth player.
 */
class YouthPlayerPlayedEvent extends AbstractEvent {
	
	/**
	 * @var SimulationPlayer Data model of youth player including statistics and grade for the current match.
	 */
	public $player;
	
	/**
	 * @var reference Reference to integer which indicates the strength change after the match.
	 */
	public $strengthChange;
	
	/**
	 * 
	 * @param WebSoccer $websoccer Application context.
	 * @param DbConnection $db DB connection.
	 * @param I18n $i18n Messages context.
	 * @param SimulationPlayer $player player data model.
	 * @param int $strengthChange change in strength after match.
	 */
	function __construct(WebSoccer $websoccer, DbConnection $db, I18n $i18n, SimulationPlayer $player, &$strengthChange) {
		parent::__construct($websoccer, $db, $i18n);
		
		$this->player = $player;
		$this->strengthChange =& $strengthChange;
	}
}

