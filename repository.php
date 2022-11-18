<?php

function getTodos(?int $time = null): array
{
	$connection = getDbConnection();

	$from = date('Y-m-d 00:00:00', $time);
	$to = date('Y-m-d 23:59:59', $time);

	$result = mysqli_query($connection, "
		SELECT * FROM todos
		WHERE created_at BETWEEN '{$from}' AND '{$to}'
		ORDER BY created_at
		LIMIT 100
	");
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	$todos = [];

	while ($row = mysqli_fetch_assoc($result))
	{
		$todos[] = [
			'id' => $row['id'],
			'title' => $row['title'],
			'completed' => ($row['completed'] === 'Y'),
			'created_at' => strtotime($row['created_at']),
			'updated_at' => $row['updated_at'] ? strtotime($row['updated_at']) : null,
			'completed_at' => $row['completed_at'] ? strtotime($row['updated_at']) : null,
		];
	}

	return $todos;
}

function getTodosOrFail(?int $time = null): array
{
	$todos = getTodos($time);

	if (empty($todos))
	{
		echo 'Nothing to do here' . PHP_EOL;
		exit();
	}

	return $todos;
}

function addTodo(array $todo): bool
{
	$connection = getDbConnection();

	$id = mysqli_real_escape_string($connection, $todo['id']);
	$title = mysqli_real_escape_string($connection, $todo['title']);

	$sql = "INSERT INTO todos (id, title) VALUES ('{$id}', '{$title}');";

	$result = mysqli_query($connection, $sql);
	if (!$result)
	{
		throw new Exception(mysqli_error($connection));
	}

	return true;
}

