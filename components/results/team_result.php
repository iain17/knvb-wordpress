<?php
// ==========================================================
// KNVB project
//
// Component: Ranking
// Sub-component:
// Purpose: Show the results of the club.
//
// Initial author: Iain Munro
// Started: 2 july 2016
// ==========================================================
use Rain\Tpl;
use KNVB\Dataservice\Exception\MissingAttributeException;

function knvb_team_result($parameters) {
    $tpl = new Tpl;
    $club = getClub();
    $team = $club->getTeam($parameters['team-id']);
    $results = $team->getResults($parameters['week-number']);

    //limit
    $parameters['limit'] = intval($parameters['limit']);
    if($parameters['limit'] != '0') {
        $results = array_slice($results, 0, $parameters['limit']);
    }

    if($parameters['order-by'] == 'asc') {
        usort($results, "sortByTimeASC");
    } elseif($parameters['order-by'] == 'desc') {
        usort($results, "sortByTimeDESC");
    } else {
        die("knvb_club_result: INVALID ORDER-BY. EITHER asc OR desc");
    }

    //Split between out and home matches
    if($parameters['show-home'] == "yes" || $parameters['show-out'] == "yes") {
        $home = array();
        $out = array();

        foreach ($results as $result) {
            try {
                if ($club->getTeam($result->ThuisTeamID)) {
                    $home[] = $result;
                }
            } catch (MissingAttributeException $exception) {
                $out[] = $result;
            }
        }

        if ($parameters['show-home'] == "yes") {
            $tpl->assign('home', $home);
        }

        if ($parameters['show-out'] == "yes") {
            $tpl->assign('out', $out);
        }
    }

    //Mixed out and home
    $tpl->assign('results', $results);
    $tpl->assign('logo', $parameters['logo'] == 'yes');
    if($parameters['extended'] == "yes") {
        return $tpl->draw('results/result_extended', true);
    } else {
        return $tpl->draw('results/result', true);
    }
}
plugin_register_short_code('team-result', 'Show the result of a team.', knvb_team_result, array(
    "week-number" => "A",
    "logo" => "no",
    "show-home" => "no",
    "show-out" => "no",
    "extended" => "yes",
    "order-by" => "desc",
    "limit" => 0,
    'team-id' => 162813
));

?>