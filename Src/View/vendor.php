<?php
// show vendors list
// loop through vendors parameter array given by controller
$vendors = $params['vendors'];
for ($i = 0; $i < count($vendors); $i++) {
	echo sprintf("[%s] %s", ($i + 1), $vendors[$i]['name']) . "\n";
}