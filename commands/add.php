<?php

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

	$todos = getTodos();
	$todos[] = $todo;

	storeTodos($todos);
}