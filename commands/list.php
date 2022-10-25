<?php

function listCommand(array $arguments)
{
	$todos = getTodosOrFail();

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