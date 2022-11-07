<?php
/**
 * @var array $items
 */

$currentPage = $_SERVER['REQUEST_URI'];
?>
<nav>
	<?php foreach ($items as $item): ?>
		<a href="<?= $item['url']; ?>" class="<?= ($item['url'] === $currentPage) ? 'is-active' : '';?>"><?= $item['text']; ?></a>
	<?php endforeach; ?>
</nav>