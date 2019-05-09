<?php

require_once "vendor/autoload.php";

$tibia = new \MMunoz\Tibia();
$player = $tibia->getPlayer("Manolaco");
$tibia->lookForTeamHunt($player, true);

