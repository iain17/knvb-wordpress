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
//as
function knvb_ranking($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $team = $club->getTeam($parameters['team-id']);
    $competitions = explode(',', $parameters['competitions']);
    $results = array();
    foreach($competitions as $competition) {
        if(isset($results[$competition])) {
            continue;
        }
        $results[$competition] = array(
            'compType' => $competition,
            'results' => $team->getRanking($competition)
        );
    }

    $tpl->assign('logo', $parameters['logo'] == 'yes');
    $tpl->assign('club', $club);
    $tpl->assign('results', $results);
    $tpl->assign('self', $team->getId());
    return $tpl->draw('ranking/team_rank', true);
}
plugin_register_short_code('team-rank', 'Show the current rank of a team.', knvb_ranking, array(
    'team-id' => 162813,
    'logo' => 'yes',
    "competitions" => "R,B,N,V",
));

?>