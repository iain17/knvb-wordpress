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
        $teamMatches = $team->getSchedule($parameters['weeknummer']);
        foreach($teamMatches as $match) {
            array_push($matches, $match);
        }
    }

    //Sort by time
    function sortByTime($a, $b ) {
        return $a->getTime() - $b->getTime();
    }
    usort($matches, "sortByTime");

    $tpl->assign('matches', $matches);
    return $tpl->draw('schedule/club_schedule', true);
}
plugin_register_short_code('club-schedule', 'Show the schedule of the club.', knvb_club_schedule, array('weeknummer' => "C"));

?>