<?php

namespace Todoist\Core;

class DependencyInjection
{
	private array $components = [];
	
	public function __construct(string $configurationPath)
	{
		$this->configure($configurationPath);
	}
	
	private function configure(string $configurationPath)
	{
		if (!file_exists($configurationPath))
		{
			return;
		}
		
		$configuration = simplexml_load_file($configurationPath);
		
		foreach ($configuration as $service)
		{
			$arguments = [];
			$serviceName = (string)$service['name'];
			$className = (string)$service->class['name'];
			$isSingleton = (bool)$service->class['isSingleton'];
			
			foreach ($service->class as $class)
			{
				foreach ($class->arg as $arg)
				{
					$serviceArgument = (string)$arg['service'];
					if ($serviceArgument)
					{
						$arguments[] = [
							'service' => $serviceArgument,
						];
					}
				}
			}
			
			$this->components[$serviceName] = function () use ($className, $arguments, $isSingleton) {
				$loadedArguments = [];
				foreach ($arguments as $argument) {
					if ($argument['service']) {
						$loadedArguments[] = $this->getComponent($argument['service']);
					}
				}
				
				if ($isSingleton)
				{
					return $className::getInstance();
				}
				
				$reflection = new \ReflectionClass($className);
				return $reflection->newInstanceArgs($loadedArguments);
			};
		}
		
	}
	
	public function getComponent(string $serviceName)
	{
		if ($this->components[$serviceName])
		{
			return $this->components[$serviceName]();
		}
	}
}
