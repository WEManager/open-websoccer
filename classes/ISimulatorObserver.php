<?php

namespace App\Classes;

/**
 * Simulator observers allow actions on match processing triggered by the simulator.
 * 
 * @see Simulator
 * @author Ingo Hofmann
 */
interface ISimulatorObserver {
	/**
	 * A valid substitution has been executed.
	 * 
	 * @param SimulationMatch $match simulated match.
	 * @param SimulationSubstitution $substitution
	 */
	public function onSubstitution(SimulationMatch $match, SimulationSubstitution $substitution);
	
	/**
	 * The match has ended.
	 * 
	 * @param SimulationMatch $match simulated match.
	 */
	public function onMatchCompleted(SimulationMatch $match);
	
	/**
	 * The match is about to start.
	 * 
	 * @param SimulationMatch $match simulated match.
	 */
	public function onBeforeMatchStarts(SimulationMatch $match);	
}
