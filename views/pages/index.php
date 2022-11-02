<?php
/**
 * @var array $todos
 */
?>
<main>

	<?php foreach ($todos as $todo):?>
		<?= view('components/todo', ['todo' => $todo]); ?>
	<?php endforeach; ?>

	<form action="/" method="post" class="add-todo">
		<input type="text" placeholder="What to do?">
		<button type="submit">Save</button>
	</form>
</main>