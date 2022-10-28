<?php

function reportCommand(array $arguments = [])
{
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

	echo implode(PHP_EOL, $report) . PHP_EOL;
}

function prepareReportData(): array
{
	$files = scandir(ROOT . '/data');

	$allTodos = [];

	foreach ($files as $file)
	{
		if (!preg_match('/^\d{4}-\d{2}-\d{2}\.txt$/', $file))
		{
			continue;
		}

		$content = file_get_contents(ROOT . "/data/$file");
		$todos = unserialize($content, ['allowed_classes' => false]);

		$todos = is_array($todos) ? $todos : [];

		[ $date ] = explode('.', $file);

		$allTodos[$date] = $todos;
	}

	return $allTodos;
}