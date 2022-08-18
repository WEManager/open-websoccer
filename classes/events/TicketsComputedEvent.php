<?php

namespace App\Classes\Events;

use App\Classes\DbConnection;
use App\Classes\I18n;
use App\Classes\SimulationMatch;
use App\Classes\WebSoccer;

/**
 * This event is triggered when a the ticket sold rate is computed during a match simulation, just before the 
 * the revenue is saved in DB.
 */
class TicketsComputedEvent extends AbstractEvent {
	
	/**
	 * @var SimulationMatch Match data model.
	 */
	public $match;
	
	/**
	 * @var int ID of stadium.
	 */
	public $stadiumId;
	
	/**
	 * @var reference reference to float number indicating to which extend the tickets for stands are sold out.
	 */
	public $rateStands;
	
	/**
	 * @var reference reference to float number indicating to which extend the tickets for seats are sold out.
	 */
	public $rateSeats;
	
	/**
	 * @var reference reference to float number indicating to which extend the tickets for stands (grandstand) are sold out.
	 */
	public $rateStandsGrand;
	
	/**
	 * @var reference reference to float number indicating to which extend the tickets for seats (grandstand) are sold out.
	 */
	public $rateSeatsGrand;
	
	/**
	 * @var reference reference to float number indicating to which extend the tickets for VIP lounged are sold out.
	 */
	public $rateVip;
	
	/**
	 * 
	 * @param WebSoccer $websoccer Application context.
	 * @param DbConnection $db DB connection.
	 * @param I18n $i18n Messages context.
	 * @param SimulationMatch $match Match data model.
	 * @param int $stadiumId ID of stadium.
	 * @param float $rateStands sales rate.
	 * @param float $rateSeats sales rate.
	 * @param float $rateStandsGrand sales rate.
	 * @param float $rateSeatsGrand sales rate.
	 * @param float $rateVip sales rate.
	 */
	function __construct(
		WebSoccer $websoccer,
		DbConnection $db,
		I18n $i18n,
		SimulationMatch $match,
		$stadiumId,
		&$rateStands,
		&$rateSeats,
		&$rateStandsGrand,
		&$rateSeatsGrand,
		&$rateVip
	) {
		parent::__construct($websoccer, $db, $i18n);
		
		$this->match = $match;
		$this->stadiumId = $stadiumId;
		
		$this->rateStands =& $rateStands;
		$this->rateSeats =& $rateSeats;
		$this->rateStandsGrand =& $rateStandsGrand;
		$this->rateSeatsGrand =& $rateSeatsGrand;
		$this->rateVip =& $rateVip;
	}
}
