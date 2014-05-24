<?php

namespace Lib\Page;

class Error extends \Core\General
{
	const SESSION_KEY = 'page_error_handling_key';
	const PREV = 'prev';
	const NOW = 'now';
	public function __construct() 
	{
		if (!array_key_exists(self::SESSION_KEY, $_SESSION)) {
			$_SESSION[self::SESSION_KEY] = array();
		}
		if (!array_key_exists(self::PREV, $_SESSION[self::SESSION_KEY])) {
			$_SESSION[self::SESSION_KEY][self::PREV] = array();
		}
		if (!array_key_exists(self::NOW, $_SESSION[self::SESSION_KEY])) {
			$_SESSION[self::SESSION_KEY][self::NOW] = array();
		}
		$_SESSION[self::SESSION_KEY][self::PREV] = $_SESSION[self::SESSION_KEY][self::NOW];
		$_SESSION[self::SESSION_KEY][self::NOW] = array();
	}
	
	
	public function add($key, $value)
	{
		if (!array_key_exists($key, $_SESSION[self::SESSION_KEY][self::NOW])) {
			$_SESSION[self::SESSION_KEY][self::NOW][$key] = array();
		}
		array_push($_SESSION[self::SESSION_KEY][self::NOW][$key], $value);
		return $this;
	}
	
	public function set($key, $value)
	{
		$_SESSION[self::SESSION_KEY][self::NOW][$key] = $value;
		return $this;
	}
	
	public function get($key)
	{
		$item = array_key_exists($key, $_SESSION[self::SESSION_KEY][self::NOW]) ? $_SESSION[self::SESSION_KEY][self::NOW][$key] : NULL;
		if (!$item) {
			$item = array_key_exists($key, $_SESSION[self::SESSION_KEY][self::PREV]) ? $_SESSION[self::SESSION_KEY][self::PREV][$key] : NULL;
		}
		return $item ?: NULL;
	}
}