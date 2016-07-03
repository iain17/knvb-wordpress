<?php
// ==========================================================
// KNVB project
//
// Component: Ranking
// Sub-component:
// Purpose: Show the current rank of a team etc.
//
// Initial author: Iain Munro
// Started: 1 july 2016
// ==========================================================
use Rain\Tpl;

function knvb_ranking($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $team = $club->getTeam($parameters['team-id']);
    $ranks = $team->getRanking();
    $tpl->assign('logo', $parameters['logo'] == 'yes');
    $tpl->assign('club', $club);
    $tpl->assign('ranks', $ranks);
    return $tpl->draw('ranking/team_rank', true);
}
plugin_register_short_code('team-rank', 'Show the current rank of a team.', knvb_ranking, array(
    'team-id' => 162813,
    'logo' => 'yes'
));

?>