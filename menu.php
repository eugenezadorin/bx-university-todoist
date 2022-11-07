<?php

$time = isset($_GET['date']) ? strtotime($_GET['date']) : time();
if ($time === false)
{
	$time = time();
}

$secondsInDay = (60 * 60 * 24);
$dayBefore = $time - $secondsInDay;
$dayAfter = $time + $secondsInDay;

return [
	['url' => '/?date=' . date('Y-m-d', $dayBefore), 'text' => '-1 day'],
	['url' => '/?date=' . date('Y-m-d', $dayAfter), 'text' => '+1 day'],
	['url' => '/', 'text' => 'Today'],
	['url' => '/report.php', 'text' => 'Reporting'],
];
