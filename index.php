<?php

use App\HeroGame;

require_once "vendor/autoload.php";


$game = new HeroGame(new App\Logger\GameLogger());
$game->startGame();