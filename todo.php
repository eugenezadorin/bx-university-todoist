<?php

// php todo.php list
// php todo.php list 2022-10-12
// php todo.php list yesterday
// php todo.php add "Wake up"
// php todo.php add "Drink coffee"
// php todo.php done 1 2
// php todo.php undone 1 2
// php todo.php remove 2 (rm)
// php todo.php report

function main(array $arguments)
{
	array_shift($arguments);

	$command = array_shift($arguments);

	switch ($command)
	{
		case 'list':
			listCommand($arguments);
			break;
		case 'add':
			addCommand($arguments);
			break;
		case 'done':
			doneCommand($arguments);
			break;
		case 'undone':
			undoneCommand($arguments);
			break;
		case 'remove':
		case 'rm':
			removeCommand($arguments);
			break;

		default:
			echo 'Unknown command';
			exit(1);
	}

	exit(0);
}

function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	$todo = [
		'id' => uniqid(),
		'title' => $title,
		'completed' => false,
		'created_at' => time(),
		'updated_at' => null,
		'completed_at' => null,
	];

	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (file_exists($filePath))
	{
		$content = file_get_contents($filePath);
		$todos = unserialize($content, [
			'allowed_classes' => false,
		]);
		$todos[] = $todo;
		file_put_contents($filePath, serialize($todos));
	}
	else
	{
		$todos = [ $todo ];

		file_put_contents($filePath, serialize($todos));
	}
}

function removeCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (!file_exists($filePath))
	{
		echo 'Nothing to do here';
		return;
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	if (empty($todos))
	{
		echo 'Nothing to do here';
		return;
	}

	foreach ($arguments as $num)
	{
		$index = (int)$num - 1;

		if (!isset($todos[$index]))
		{
			continue;
		}

		unset($todos[$index]);
	}

	$todos = array_values($todos);

	file_put_contents($filePath, serialize($todos));
}

function undoneCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (!file_exists($filePath))
	{
		echo 'Nothing to do here';
		return;
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	if (empty($todos))
	{
		echo 'Nothing to do here';
		return;
	}

	foreach ($arguments as $num)
	{
		$index = (int)$num - 1;

		if (!isset($todos[$index]))
		{
			continue;
		}

		$todos[$index] = array_merge($todos[$index], [
			'completed' => false,
			'updated_at' => time(),
			'completed_at' => null,
		]);
	}

	file_put_contents($filePath, serialize($todos));
}
function doneCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (!file_exists($filePath))
	{
		echo 'Nothing to do here';
		return;
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	if (empty($todos))
	{
		echo 'Nothing to do here';
		return;
	}

	$now = time();

	foreach ($arguments as $num)
	{
		$index = (int)$num - 1;

		if (!isset($todos[$index]))
		{
			continue;
		}

		$todos[$index] = array_merge($todos[$index], [
			'completed' => true,
			'updated_at' => $now,
			'completed_at' => $now,
		]);
	}

	file_put_contents($filePath, serialize($todos));
}

function listCommand(array $arguments)
{
	$fileName = date('Y-m-d') . '.txt';
	$filePath = __DIR__ . '/data/' . $fileName;

	if (!file_exists($filePath))
	{
		echo 'Nothing to do here';
		return;
	}

	$content = file_get_contents($filePath);
	$todos = unserialize($content, [
		'allowed_classes' => false,
	]);

	if (empty($todos))
	{
		echo 'Nothing to do here';
		return;
	}

	foreach ($todos as $index => $todo)
	{
		echo sprintf(
			"%s. [%s] %s \n",
			($index + 1),
			$todo['completed'] ? 'x' : ' ',
			$todo['title']
		);
	}
}

main($argv);