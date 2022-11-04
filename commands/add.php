<?php

function addCommand(array $arguments)
{
	$title = array_shift($arguments);

	$todo = createTodo($title);

	addTodo($todo);
}