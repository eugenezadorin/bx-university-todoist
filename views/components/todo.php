<?php
/**
 * @var array $todo
 */
?>
<article class="todo">
	<label>
		<input type="checkbox" <?= ($todo['completed']) ? 'checked' : ''; ?>>
		<?= $todo['title']; ?>
	</label>
</article>