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
	
	protected function checkVal($value)
	{
		if (is_int($value)) {
			$value = intval($value);
		}
		if (is_string($value)) {
			$value = $this->connection->quote($value);
		}
		if (is_null($value)) {
			$value = 'NULL';
		}
		return $value;
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
			$value = $this->checkVal($value);
			$whereStatementArr[] = "`{$key}` {$condition} {$value}";
		}
		return implode(' ' . $type . ' ', $whereStatementArr);
	}
	
	public function implodeInsertArray(array $data)
	{
		$keys = array_keys($data);
		$vals = array_values($data);
		$keysSql = '(`' . implode('`,`', $keys) . '`)';
		$valsSqlArr = array();
		foreach($vals as $value) {
			$value = $this->checkVal($value);
			$valsSqlArr[] = $value;
		}
		$valsSql = '(' . implode(',', $valsSqlArr) . ')';
		$sql = $keysSql . ' VALUES ' . $valsSql;
		return $sql;
	}
	
	public function insert($table, array $data)
	{
		$sql = "INSERT INTO `{$table}` " . $this->implodeInsertArray($data);
		$this->connection->query($sql);
		return $this;
	}
	
	public function implodeUpdateArr(array $data) 
	{
		$sqlArr = array();
		foreach($data as $key => $value) {
			$value = $this->checkVal($value);
			$sqlArr[] = "`{$key}` = {$value}";
		}
		return implode(',', $sqlArr);
	}
	
	public function update($table, array $whereArr = array(), array $data = array())
	{
		$whereSql = $this->implodeWhereArr($whereArr);
		$setSql = $this->implodeUpdateArr($data);
		$sql = "UPDATE `{$table}` SET {$setSql} WHERE {$whereSql}";
		$this->connection->query($sql);
		return $this;
	}
}