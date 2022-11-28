<?php

class UserRepository extends Repository
{
	/**
	 * @param array $filter
	 * @return User[]
	 */
	public function getList(array $filter = []): array
	{
		// select * from users
		return [];
	}

	public function add($user): bool
	{
		// insert into users
		return true;
	}

	public function update($user): bool
	{
		// update users set values (...)
		return true;
	}
}