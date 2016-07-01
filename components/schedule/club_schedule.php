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
    $schedules = array();

    foreach($club->getTeams() as $team){
        $schedules[] = $team->getSchedule($parameters['weeknummer']);
    }

    die('test');
    $tpl->assign('schedules', $schedules);
    return $tpl->draw('schedule/club_schedule', true);
}
plugin_register_short_code('club-schedule', 'Show the schedule of the club.', knvb_club_schedule, array('weeknummer' => "C"));

?>