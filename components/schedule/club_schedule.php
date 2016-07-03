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

    foreach($club->getTeams() as $team){
        $teamMatches = $team->getSchedule($parameters['week-number']);
        foreach($teamMatches as $match) {
            array_push($matches, $match);
        }
    }

    //Sort by time
    function sortByTimeASC($a, $b ) {
        return $a->getTime() - $b->getTime();
    }
    function sortByTimeDESC($a, $b ) {
        return $b->getTime() - $a->getTime();
    }

    if($parameters['order-by'] == 'asc') {
        usort($matches, "sortByTimeASC");
    } elseif($parameters['order-by'] == 'desc') {
        usort($matches, "sortByTimeDESC");
    } else {
        die("knvb_club_result: INVALID ORDER-BY. EITHER asc OR desc");
    }

    $tpl->assign('matches', $matches);
    $tpl->assign('logo', $parameters['logo'] == 'yes');
    return $tpl->draw('schedule/club_schedule', true);
}
plugin_register_short_code('club-schedule', 'Show the schedule of the club.', knvb_club_schedule, array(
    "week-number" => "14",
    "logo" => "yes",
    "order-by" => "asc",
));

?>