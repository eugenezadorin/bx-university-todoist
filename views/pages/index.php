<?php
/**
 * @var array $todos
 * @var bool $isHistory
 * @var array $errors
 */
?>
<main>

	<?php if (!empty($errors)):?>
	<div class="alert danger">
		<?= implode('<br>', $errors); ?>
	</div>
	<?php endif; ?>

	<?php foreach ($todos as $todo):?>
		<?= view('components/todo', ['todo' => $todo, 'isHistory' => $isHistory ]); ?>
	<?php endforeach; ?>

	<?php if (!$isHistory): ?>
	<form action="/" method="post" class="add-todo">
		<input type="text" name="title" placeholder="What to do?">
		<button type="submit">Save</button>
	</form>
	<?php endif; ?>
</main>