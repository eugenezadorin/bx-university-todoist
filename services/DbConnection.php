<?php

namespace Todoist\Service;

class DbConnection
{
	private static $instance;
	
	/**
	 * @var false|\mysqli
	 */
	private $connection;
	
	private function __construct()
	{
		$this->createConnection(
			option('DB_HOST'),
			option('DB_USER'),
			option('DB_PASSWORD'),
			option('DB_NAME')
		);
	}
	
	public static function getInstance()
	{
		if (static::$instance)
		{
			return static::$instance;
		}
		
		static::$instance = new self();
		
		return static::$instance;
	}
	
	private function createConnection( $dbHost, $dbUser, $dbPassword, $dbName)
	{
		$this->connection = mysqli_init();
		
		$connected = mysqli_real_connect($this->connection, $dbHost, $dbUser, $dbPassword, $dbName);
		if (!$connected)
		{
			$error = mysqli_connect_errno() . ': ' . mysqli_connect_error();
			throw new \Exception($error);
		}
		
		$encodingResult = mysqli_set_charset($this->connection, 'utf8');
		if (!$encodingResult)
		{
			throw new \Exception(mysqli_error($this->connection));
		}
	}
	
	public function getConnection()
	{
		return $this->connection;
	}
}
