<?php
require_once("Lib/autoload.php");

use App\Util\StateManager;

$app = new StateManager();
$app->switchState($argv);