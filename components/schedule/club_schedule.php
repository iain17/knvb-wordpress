<?php
// ==========================================================
// KNVB project
//
// Component: Ranking
// Sub-component:
// Purpose: Show the current rank of a team.
//
// Initial author: Iain Munro
// Started: 1 july 2016
// ==========================================================
use Rain\Tpl;

function knvb_club_schedule($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $schedules = array();
    foreach($club->getTeams() as $team){
        $schedules[] = $team->getSchedule($parameters['weeknummer']);
    }
    $tpl->assign('schedules', $schedules);
    return $tpl->draw('schedule/club_schedule', true);
}
//[knvb-club-schedule weeknummer="C"]
add_shortcode("knvb-club-schedule", "knvb_club_schedule");

?>