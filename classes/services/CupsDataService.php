<?php

namespace App\Classes\Services;

use App\Classes\DbConnection;
use App\Classes\WebSoccer;

/**
 * Data service for cup data
 */
class CupsDataService {
	
	/**
	 * Provides teams assigned to specified cup group in their standings order.
	 * 
	 * @param WebSoccer $websoccer application context.
	 * @param DbConnection $db DB connection.
	 * @param int $roundId Cup round ID.
	 * @param string $groupName Cup round group name.
	 * @return array Array of teams with standings related statistics.
	 */
	public static function getTeamsOfCupGroupInRankingOrder(WebSoccer $websoccer, DbConnection $db, $roundId, $groupName) {
		$fromTable = $websoccer->getConfig("db_prefix") . "_cup_round_group AS G";
		$fromTable .= " INNER JOIN " . $websoccer->getConfig("db_prefix") . "_verein AS T ON T.id = G.team_id";
		$fromTable .= " LEFT JOIN " . $websoccer->getConfig("db_prefix") . "_user AS U ON U.id = T.user_id";
		
		// where
		$whereCondition = "G.cup_round_id = %d AND G.name = '%s'";
		
		// order (do not use "Direktvergleich", but compare total score so far)
		$whereCondition .= "ORDER BY G.tab_points DESC, (G.tab_goals - G.tab_goalsreceived) DESC, G.tab_wins DESC, T.st_punkte DESC";
		
		$parameters = array($roundId, $groupName);
	
		// select
		$columns["T.id"] = "id";
		$columns["T.name"] = "name";
		$columns["T.user_id"] = "user_id";
		$columns["U.nick"] = "user_name";
		$columns["G.tab_points"] = "score";
		$columns["G.tab_goals"] = "goals";
		$columns["G.tab_goalsreceived"] = "goals_received";
		$columns["G.tab_wins"] = "wins";
		$columns["G.tab_draws"] = "draws";
		$columns["G.tab_losses"] = "defeats";
	
		$result = $db->querySelect($columns, $fromTable, $whereCondition, $parameters);
		$teams = array();
		while($team = $result->fetch_array()) {
			$teams[] = $team;
		}
		$result->free();
		
		return $teams;
	}	
}
