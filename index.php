<?php

require_once 'vendor/autoload.php';

use jamiehollern\futbol\Model\Team;
use jamiehollern\futbol\Model\Match;
use jamiehollern\futbol\Model\ProcessedLeagueTable;

$aberdeen = new Team(1, 'Aberdeen');
$celtic = new Team(2, 'Celtic');

$matches = [
  new Match($aberdeen, $celtic, 0, 0),
  new Match($celtic, $aberdeen, 2, 2),
  new Match($aberdeen, $celtic, 0, 4),
  new Match($celtic, $aberdeen, 3, 1),
];

$league = new ProcessedLeagueTable($matches);

foreach ($league->getTableRows() as $row) {
    print $row . "<br>\n";
}

