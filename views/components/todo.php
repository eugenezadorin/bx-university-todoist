<?php
/**
 * @var array $todo
 * @var bool $isHistory
 */
?>
<article class="todo">
	<label>
		<input
			type="checkbox"
			<?= ($todo['completed']) ? 'checked' : ''; ?>
			<?= ($isHistory) ? 'disabled' : ''; ?>
		>
		<?= safe(truncate($todo['title'], option('TRUNCATE_TODO', 200))); ?>
	</label>
</article>