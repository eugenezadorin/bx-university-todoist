<?php

function view(string $path, array $variables = []): string
{
	if (!preg_match('/^[0-9A-Za-z\/_-]+$/', $path))
	{
		throw new Exception('Invalid template path');
	}

	$absolutePath = ROOT . "/views/$path.php";

	if (!file_exists($absolutePath))
	{
		throw new Exception('Template not found');
	}

	extract($variables);

	ob_start();

	require $absolutePath;

	return ob_get_clean();
}