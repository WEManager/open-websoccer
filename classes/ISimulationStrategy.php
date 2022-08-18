
<?php

namespace App\Classes;

define('MAX_STRENGTH', 100);
define('PLAYER_POSITION_GOALY', 'Torwart');
define('PLAYER_POSITION_DEFENCE', 'Abwehr');
define('PLAYER_POSITION_MIDFIELD', 'Mittelfeld');
define('PLAYER_POSITION_STRIKER', 'Sturm');

/**
 * The simulation strategy determines the results of an action, and also specified what the next action is.
 * 
 * @author Ingo Hofmann
 */
interface ISimulationStrategy {
	
	/**
	 * Initializes simulation strategy, independently from specific matches.
	 * 
	 * @param WebSoccer $websoccer application context.
	 */
	function __construct(WebSoccer $websoccer);

	/**
	 * Simulates the kick-off which should be the first action of the match.
	 * 
	 * @param SimulationMatch $match match to simulate.
	 */
	public function kickoff(SimulationMatch $match);
	
	/**
	 * Computes next action to execute.
	 * 
	 * @param SimulationMatch $match match for that the next action shall be computed.
	 * @return string Simulation strategy method name of next action to execute.
	 */
	public function nextAction(SimulationMatch $match);
	
	/**
	 * Simulates the passing of the ball by the player with ball.
	 * 
	 * @param SimulationMatch $match match to simulate.
	 */
	public function passBall(SimulationMatch $match);
	
	/**
	 * Simulates a tackle between the player with ball and another player from the opponent team which needs to be picked by the implementation.
	 * 
	 * @param SimulationMatch $match match to simulate.
	 */
	public function tackle(SimulationMatch $match);
	
	/**
	 * Simulates a shoot towards the goal (= an attempt).
	 * 
	 * @param SimulationMatch $match match to simulate.
	 */
	public function shoot(SimulationMatch $match);
	
	/**
	 * Simulates penalty shooting after the regular matches ended without any winner.
	 * 
	 * @param SimulationMatch $match match to simulate.
	 */
	public function penaltyShooting(SimulationMatch $match);
}
