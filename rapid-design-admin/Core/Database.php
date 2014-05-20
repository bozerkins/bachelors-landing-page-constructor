<?php

namespace Core;

class Database
{
	protected $connection = NULL;
	
	public function __construct($config)
	{
		$host = $config->get('database.host');
		$dbname = $config->get('database.name');
		$user = $config->get('database.user');
		$pass = $config->get('database.pass');
		$this->connection = new \PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
		$this->connection->setAttribute( \PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION );
		$this->connection->setAttribute( \PDO::ATTR_DEFAULT_FETCH_MODE, \PDO::FETCH_OBJ );
	}
	
	public function readBySql($sql)
	{
		$STH = $this->connection->query($sql);
		$result = array();
		while($row = $STH->fetch()) {
			$row && $result[] = $row;
		}
		return $result ?: null;
	}
	
	public function readOneBySql($sql)
	{
		$STH = $this->connection->query($sql);
		$row = $STH->fetch();
		return $row ?: NULL;
	}
	
	public function implodeWhereArr(array $whereArr, $condition = '=', $type = 'AND')
	{
		$whereStatementArr = array();
		foreach($whereArr as $key => $value) {
			if (is_int($value)) {
				$value = intval($value);
			}
			if (is_string($value)) {
				$value = $this->connection->quote($value);
			}
			$whereStatementArr[] = "`{$key}` {$condition} {$value}";
		}
		return implode(' ' . $type . ' ', $whereStatementArr);
	}
}