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

require_once __DIR__ . '/boot.php';

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

		case 'report':
			reportCommand($arguments);
			break;

		default:
			echo 'Unknown command';
			exit(1);
	}

	exit(0);
}

main($argv);