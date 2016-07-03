<?php

//Sort by time
function sortByTimeASC($a, $b ) {
    return $a->getTime() - $b->getTime();
}
function sortByTimeDESC($a, $b ) {
    return $b->getTime() - $a->getTime();
}
?>