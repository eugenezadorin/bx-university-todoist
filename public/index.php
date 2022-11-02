<?php

require_once __DIR__ . '/../boot.php';

echo view('layout', [
	'title' => 'Todoist',
	'content' => view('pages/index', [
		'todos' => getTodos(),
	]),
]);
