<?php

class RedisTodoRepository extends Repository
{
	public function getList(array $filter): array
	{
		return [
			new Todo('Test 1'),
			new Todo('Test 2'),
		];
	}

	public function add($entity): bool
	{
		return true;
	}

	public function update($entity): bool
	{
		return true;
	}

	public function getFromCache(): array
	{
		return [];
	}
}