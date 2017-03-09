<?php

require_once 'vendor/autoload.php';

use jamiehollern\futbol\Team;
use jamiehollern\futbol\Match;
use jamiehollern\futbol\League;

$aberdeen = new Team(1, 'Aberdeen');
$celtic = new Team(2, 'Celtic');

$matches = [
  new Match($aberdeen, $celtic, 0, 0),
  new Match($celtic, $aberdeen, 2, 2),
  new Match($aberdeen, $celtic, 0, 4),
  new Match($celtic, $aberdeen, 3, 1),
];

$league = new League($matches);

