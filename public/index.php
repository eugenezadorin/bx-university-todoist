<?php

require_once __DIR__ . '/../boot.php';

$time = null;
$isHistory = false;
$title = option('APP_NAME', 'Todoist');
$errors = [];

function getTodoRepository(): Repository
{
	$useRedis = option('USE_REDIS', false);

	if ($useRedis)
	{
		return new RedisTodoRepository();
	}
	else
	{
		return new TodoRepository();
	}
}

$repository = getTodoRepository();

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
	$title = trim($_POST['title']);

	if (strlen($title) > 0)
	{
		$todo = new Todo($title);
		$repository->add($todo);
		redirect('/?saved=true');
	}
	else
	{
		$errors[] = 'Task cannot be empty';
	}
}

if (isset($_GET['date']))
{
	$time = strtotime($_GET['date']);
	if ($time === false)
	{
		$time = time();
	}

	$today = date('Y-m-d');
	if ($today !== date('Y-m-d', $time))
	{
		$isHistory = true;
		$title = sprintf('Todoist :: %s', date('j M', $time));
	}
}

echo view('layout', [
	'title' => $title,
	'bottomMenu' => require_once ROOT . '/menu.php',
	'content' => view('pages/index', [
		'todos' => $repository->getList(['time' => $time]),
		'isHistory' => $isHistory,
		'errors' => $errors,
	]),
]);
