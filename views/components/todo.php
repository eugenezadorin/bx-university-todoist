<?php
/**
 * @var Todo $todo
 * @var bool $isHistory
 */
?>
<article class="todo">
	<label>
		<input
			type="checkbox"
			<?= ($todo->isCompleted()) ? 'checked' : ''; ?>
			<?= ($isHistory) ? 'disabled' : ''; ?>
		>
		<?= safe(truncate($todo->getTitle(), option('TRUNCATE_TODO', 200))); ?>

		<time
			datetime="<?= $todo->getCreatedAt()->format(DateTime::ATOM) ?>">
			<?= $todo->getCreatedAt()->format('H:i') ?>
		</time>
	</label>
</article>