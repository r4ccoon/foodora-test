<?php
require_once("Lib/autoload.php");

use \Util\StateManager;

$app = new StateManager();
$app->switchState($argv); 