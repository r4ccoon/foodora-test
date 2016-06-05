<?php
if (isset($params['vendor']) && isset($params['vendor'][0]) && $params['schedules']) :
	$v = $params['vendor'][0];
	$schedules = $params['schedules'];
	?>
	Shop: <?= $v['name'] ?>

<?php
	foreach ($schedules as $day => $dates) : ?>
		<?= $day . ":"; ?>

<?php
		foreach ($dates as $date) :?>
<?php 		if($date['all_day'] != 1):?>
			Start: <?=$date['start_hour']?>
			Stop: <?=$date['stop_hour']?>
			<?php else:?>
			Open All Day
<?php 		endif;?><?= "\n"; ?>
<?php 	endforeach;
	endforeach;
endif; ?>