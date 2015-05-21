<?php defined('BASEPATH') OR exit('No direct script access allowed');

function find_team_byteamid($teams, $team_id) {
	foreach ($teams as $t) 
	{
		if ($team_id == $t['id'])
			return $t;
	}
	return null;
}

function change_key($object, $key) {
	$oldKey = $key['old'];
	$newKey = $key['new'];
	for ($i = 0; $i < count($oldKey); $i++) 
	{
		$object[$newKey[$i]] = $object[$oldKey[$i]];
		unset($object[$oldKey[$i]]);
	}
	return $object;
}

function get_matchday_keys() {
	$result = [];
	$result['old'] = array('away_goal', 'away_point', 'home_goal', 'home_point', 'rating_point', 'voting_away_win', 'voting_home_win', 'voting_tie');
	$result['new'] = array('awayGoal', 'awayPoint', 'homeGoal', 'homePoint', 'ratingPoint', 'votingAwayWin', 'votingHomeWin', 'votingTie');
	return $result;
}

function get_week_keys() {
	$result = [];
	$result['old'] = array('start_day', 'week_number');
	$result['new'] = array('startDay', 'weekNumber');
	return $result;
}

function get_rank_keys() {
	$result = [];
	$result['old'] = array('games_lost', 'games_won', 'games_drawn', 'goals_against', 'goals_scored');
	$result['new'] = array('gamesLost', 'gamesWon', 'gamesDrawn', 'goalsAgainst', 'goalsScored');
	return $result;
}

function get_team_keys() {
	$result = [];
	$result['old'] = array('short_name', 'simple_name', 'video_id');
	$result['new'] = array('shortName', 'simpleName', 'videoId');
	return $result;
}