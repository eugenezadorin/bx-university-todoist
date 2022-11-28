<?php

namespace Todoist\Repository;

abstract class Repository
{
	abstract public function getList(array $filter): array;

	abstract public function add($entity): bool;

	abstract public function update($entity): bool;

	public function getListOrFail(array $filter = []): array
	{
		$items = $this->getList($filter);

		if (empty($items)) {
			echo 'Nothing to do here' . PHP_EOL;
			exit();
		}

		return $items;
	}
}
