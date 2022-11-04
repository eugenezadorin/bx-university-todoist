<?php

function createTodo(string $title): array
{
	return [
		'id' => uniqid(),
		'title' => $title,
		'completed' => false,
		'created_at' => time(),
		'updated_at' => null,
		'completed_at' => null,
	];
}

function mapTodos(array $todos, array $positions, Closure $callback): array
{
	foreach ($positions as $position)
	{
		$index = (int)$position - 1;

		if (!isset($todos[$index]))
		{
			continue;
		}

		$result = $callback($todos[$index]);
		if (is_array($result))
		{
			$todos[$index] = $result;
		}
		else
		{
			unset($todos[$index]);
		}
	}

	return array_values($todos);
}