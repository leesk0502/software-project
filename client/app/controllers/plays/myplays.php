<?php
$playTimes = new PlayTimes();
$res['list'] = $playTimes->getList($_SESSION['idx']);
?>
