<?php
require_once("Lib/autoload.php");

use \Controller\MainController;

$app = new MainController();
$app->run();