<?php

namespace Todoist\Core;

class ServiceLocator
{
	private array $components = [];
	private static ?ServiceLocator $instance = null;
	
	private function __construct()
	{
		$this->init(['db']);
	}
	
	public function registerComponent(string $componentName, string $component, bool $isSingleton = false)
	{
		if ($this->components[$componentName])
		{
			return;
		}
		
		$this->components[$componentName] = function () use ($component, $isSingleton)
		{
			return $isSingleton ? $component::getInstance() : new $component;
		};
		
	}
	
	public function getComponent(string $componentName)
	{
		return $this->components[$componentName]();
	}
	
	private function init(array $components)
	{
		foreach ($components as $component)
		{
			switch ($component)
			{
				case 'db':
					$this->registerComponent(
						$component,
						\Todoist\Service\DbConnection::class,
						true
					);
					break;
			}
		}
	}
	
	public static function getInstance(): ServiceLocator
	{
		if (static::$instance)
		{
			return static::$instance;
		}
		
		static::$instance = new self();
		
		return static::$instance;
	}
}