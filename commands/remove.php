<?php

function removeCommand(array $arguments)
{
	$todos = getTodosOrFail();

	$todos = mapTodos($todos, $arguments, fn($todo) => null);

	storeTodos($todos);
}