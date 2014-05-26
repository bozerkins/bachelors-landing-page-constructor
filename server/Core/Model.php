<?php

namespace Core;

class Model extends General
{
	protected $db = NULL;
	protected $table = NULL;
	protected $primaryKey = 'id';
	
	public function __construct() {
		$this->db = $this->app->environment()->database;
	}
	
	public function all(array $where = array(), $limit = NULL, $order = NULL, $group = NULL)
	{
		$whereSql = $where ? ' WHERE ' . $this->db->implodeWhereArr($where) : '';
		$limitSql = $limit ? ' LIMIT ' . $limit : '';
		$orderSql = $order ? ' ORDER BY ' . $order : '';
		$groupSql = $group ? ' GROUP BY ' . $group : '';
		$sql = "SELECT * FROM `{$this->table}`{$whereSql}{$orderSql}{$groupSql}{$limitSql}";
		return $this->db->readBySql($sql);
	}
	
	public function one($id)
	{
		$id = intval($id);
		return $this->db->readOneBySql("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = {$id} LIMIT 1");
	}
	
	public function insert(array $data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->lastInsertId();
	}
	
	public function update($id, array $data)
	{
		$this->updateMany(array(
			'id' => $id,
		), $data);
	}
	
	public function updateMany(array $where, array $data)
	{
		$this->db->update($this->table, $where, $data);
	}
	
	public function delete($id)
	{
		// to be filled
	}
}