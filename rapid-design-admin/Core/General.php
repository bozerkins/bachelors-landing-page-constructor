<?php

namespace Core;

class General
{
	protected static $app = NULL;
	
	public function __get($name) 
	{
		if ($name === 'app') {
			return self::$app;
		}
		return NULL;
	}
	
	public function __set($name, $value) {
		if ($name === 'app') {
			self::$app = $value;
		}
		$this->{$name} = $value;
	}
}