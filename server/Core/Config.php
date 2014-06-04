<?php

namespace Core;

class Config
{
	protected $storage = array();
	
	public function __construct()
	{
		$this->applyConfig('General');
		$this->applyConfig('Database');
		$this->applyConfig('Routes');
		$this->applyConfig('Attributes');
		$this->applyConfig('Styles');
		$this->applyConfig('Controls');
		$this->applyConfig('Auth');
	}
	
	protected function applyConfig($name)
	{
		$name = '\\' . __NAMESPACE__ . '\\Config\\' . $name;
		$obj = new $name;
		$nameArr = explode('\\', $name);
		$this->storage[strtolower(end($nameArr))] = $obj->getStorage();
		return $this;
	}
	
	protected function parseKey($key)
	{
		$arr = explode('.', $key);
		return array(
			'storage' => $arr[0],
			'itemKey' => array_key_exists(1, $arr) ? $arr[1] : NULL,
		);
	}
	
	public function get($key)
	{
		$info = $this->parseKey($key);
		$storage = $this->storage[$info['storage']];
		if ($info['itemKey']) {
			return $storage[$info['itemKey']];
		}
		return $storage;
	}
	
	public function set($value, $key)
	{
		$info = $this->parseKey($key);
		$this->storage[$info['storage']][$info['itemKey']] = $value;
		return $this;
	}
}