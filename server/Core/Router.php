<?php

namespace Core;

class Router extends General
{
	const DEFAULT_REQUEST_METHOD = 'get';
	
	public function __construct(\Slim\Slim $app)
	{
		$this->app = $app;
	}
	
	/**
	 * @return \Slim\Slim
	 */
	public function listen()
	{
		$routes = $this->app->environment()->config->get('routes');
		foreach($routes as $path => $info) {
			$parsedInfo = $this->parseInfo($info);
			$this->app->{$parsedInfo['requestMethod']}($path, function() use ($parsedInfo){
				call_user_func_array (array(
					new $parsedInfo['className'], 
					$parsedInfo['methodName']
				), func_get_args());
			});
		}
		return $this->app;
	}
	
	protected function parseInfo(array $info) 
	{
		return array(
			'className' => '\\Routes\\' . str_replace('.', '\\', $info[0]),
			'methodName' => $info[1],
			'requestMethod' => array_key_exists(2, $info) ? $info[2] : self::DEFAULT_REQUEST_METHOD,
		);
	}
}