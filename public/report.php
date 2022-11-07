<?php

require_once __DIR__ . '/../boot.php';

$allTodos = prepareReportData();

$totalDays = count($allTodos);

$totalTasksCount = array_reduce($allTodos, function ($prev, $todos) {
	return $prev + count($todos);
}, 0);

$totalCompletedTasksCount = array_reduce($allTodos, function ($prev, $todos) {
	$completed = array_filter($todos, fn($todo) => $todo['completed']);
	return $prev + count($completed);
}, 0);

$dailyTaskCounts = array_map(function($todos) {
	return count($todos);
}, $allTodos);

$maxTasksCount = max($dailyTaskCounts);
$minTasksCount = min($dailyTaskCounts);

$averageTasksCount = 0;
$averageCompletedTasksCount = 0;

if ($totalDays > 0)
{
	$averageTasksCount = floor($totalTasksCount / $totalDays);
	$averageCompletedTasksCount = floor($totalCompletedTasksCount / $totalDays);
}

$report = [
	"Total days: $totalDays",
	"Total tasks: $totalTasksCount",
	"Total completed tasks: $totalCompletedTasksCount",
	"Min tasks in a day: $minTasksCount",
	"Max tasks in a day: $maxTasksCount",
	"Average tasks per day: $averageTasksCount",
	"Average completed tasks per day: $averageCompletedTasksCount",
];

echo view('layout', [
	'title' => 'Todoist :: Report',
	'bottomMenu' => require_once ROOT . '/menu.php',
	'content' => view('pages/report', [
		'report' => $report,
	]),
]);
