<?php defined('BASEPATH') OR exit('No direct script access allowed');

function change_key($object, $key) {
	$oldKey = $key["old"];
	$newKey = $key["new"];
	for ($i = 0; $i < count($oldKey); $i++) {
		$object[$newKey[$i]] = $object[$oldKey[$i]];
		unset($object[$oldKey[$i]]);
	}
	return $object;
}

function get_rank_keys() {
	$result = [];
	$result["old"] = array("games_lost", "games_won", "games_drawn", "goals_against", "goals_scored");
	$result["new"] = array("gamesLost", "gamesWon", "gamesDrawn", "goalsAgainst", "goalsScored");
	return $result;
}

function get_team_keys() {
	$result = [];
	$result["old"] = array("short_name", "simple_name", "video_id");
	$result["new"] = array("shortName", "simpleName", "videoId");

	return $result;
}