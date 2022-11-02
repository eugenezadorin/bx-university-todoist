<?php
/**
 * @var string $title
 * @var string $content
 */
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<link rel="stylesheet" href="/style.css">
	<title><?= $title; ?></title>
</head>
<body>
<section class="content">
	<header>
		<span class="icon">📝</span>
		<h1><?= $title; ?></h1>
	</header>

	<?= $content ?>

	<footer>
		&copy; <?= date('Y'); ?> Todoist by Bitrix University
	</footer>

</section>
</body>
</html>