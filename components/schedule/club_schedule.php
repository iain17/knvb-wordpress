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

function knvb_club_schedule($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $matches = array();

    if(!is_numeric($parameters['week-number']) && $parameters['week-number'] != 'A') {
        die("knvb_club_schedule: INVALID week number. Either a number or A");
    }

    foreach($club->getTeams() as $team){
        $teamMatches = $team->getSchedule($parameters['week-number']);
        foreach($teamMatches as $match) {
            array_push($matches, $match);
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

    $tpl->assign('matches', $matches);
    $tpl->assign('logo', $parameters['logo'] == 'yes');
    return $tpl->draw('schedule/club_schedule', true);
}
plugin_register_short_code('club-schedule', 'Show the schedule of the club.', knvb_club_schedule, array(
    "week-number" => "A",
    "logo" => "yes",
    "order-by" => "asc",
    "limit" => 0,
));

?>