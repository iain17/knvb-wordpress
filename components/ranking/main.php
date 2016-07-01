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

function knvb_ranking($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $team = $club->getTeam($parameters['id']);
    $ranks = $team->getRanking();
    $tpl->assign('showlogo', $parameters['showlogo']);
    $tpl->assign('club', $club);
    $tpl->assign('ranks', $ranks);
    return $tpl->draw('ranking/template', $return_string = true);
}
add_shortcode("knvb-ranking", "knvb_ranking");

?>