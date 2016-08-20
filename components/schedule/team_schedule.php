<?php
// ==========================================================
// KNVB project
//
// Component: Ranking
// Sub-component:
// Purpose: Show the schedule of the club.
//
// Initial author: Iain Munro
// Started: 1 july 2016
// ==========================================================
use Rain\Tpl;

function knvb_team_schedule($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $matches = array();

    $team = $club->getTeam($parameters['team-id']);

    if(!is_numeric($parameters['week-number']) && $parameters['week-number'] != 'A') {
        die("knvb_club_schedule: INVALID week number. Either a number or A");
    }

    $competitions = explode(',', $parameters['competitions']);
    foreach($competitions as $competition) {
        $newMatches = $team->getSchedule($parameters['week-number'], $competition);
        foreach($newMatches as $match) {
            if($parameters['hideExpired'] == 'yes') {
                if ($match->getTime() < time()) {
                    continue;
                }
                $matches[] = $match;
            }
        }
    }

    if($parameters['order-by'] == 'asc') {
        usort($matches, "sortByTimeASC");
    } elseif($parameters['order-by'] == 'desc') {
        usort($matches, "sortByTimeDESC");
    } else {
        die("knvb_club_schedule: INVALID ORDER-BY. EITHER asc OR desc");
    }

    //limit
    $parameters['limit'] = intval($parameters['limit']);
    if($parameters['limit'] != '0') {
        $matches = array_slice($matches, 0, $parameters['limit']);
    }

    $tpl->assign('extended', $parameters['extended'] == 'yes');
    $tpl->assign('matches', $matches);
    $tpl->assign('logo', $parameters['logo'] == 'yes');
    return $tpl->draw('schedule/club_schedule', true);
}
plugin_register_short_code('team-schedule', 'Show the schedule of a team.', "knvb_team_schedule", array(
    "competitions" => "R,B,N,V",
    "week-number" => "A",
    "logo" => "no",
    "order-by" => "asc",
    "limit" => 10,
    "hideExpired" => "yes",
    "extended" => "yes",
    "team-id" => 162813
));

?>