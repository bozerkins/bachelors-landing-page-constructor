<?php

namespace Core;

class Model extends General
{
	// database connection link
	protected $db = NULL;
	// table name
	protected $table = NULL;
	// table primary key
	protected $primaryKey = 'id';
	
	// initliaze database object link 
	// from the environment
	public function __construct() {
		$this->db = $this->app->environment()->database;
	}
	
	/**
	 * Returns all records from model's table by parameters
	 * 
	 * @param array $where
	 * @param integer|string $limit
	 * @param string $order
	 * @param string $group
	 * @return array
	 */
	public function all(array $where = array(), $limit = NULL, $order = NULL, $group = NULL)
	{
		$whereSql = $where ? ' WHERE ' . $this->db->implodeWhereArr($where) : '';
		$limitSql = $limit ? ' LIMIT ' . $limit : '';
		$orderSql = $order ? ' ORDER BY ' . $order : '';
		$groupSql = $group ? ' GROUP BY ' . $group : '';
		$sql = "SELECT * FROM `{$this->table}`{$whereSql}{$orderSql}{$groupSql}{$limitSql}";
		return $this->db->readBySql($sql);
	}
	/**
	 * Returns one record by id
	 * 
	 * @param integer $id
	 * @return array
	 */
	public function one($id)
	{
		$id = intval($id);
		return $this->db->readOneBySql("SELECT * FROM {$this->table} WHERE {$this->primaryKey} = {$id} LIMIT 1");
	}
	
	/**
	 * Creates single record by givven data
	 * 
	 * @param array $data
	 * @return integer
	 */
	public function insert(array $data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->lastInsertId();
	}
	
	/**
	 * Updates record by id
	 * 
	 * @param integer $id
	 * @param array $data
	 * @return \Core\Model
	 */
	public function update($id, array $data)
	{
		$this->updateMany(array(
			'id' => $id,
		), $data);
		
		return $this;
	}
	
	/**
	 * Updates record by conditions array
	 * 
	 * @param array $where
	 * @param array $data
	 * @return \Core\Model
	 */
	public function updateMany(array $where, array $data)
	{
		$this->db->update($this->table, $where, $data);
		
		return $this;
	}
	
	/**
	 * Deletes record by id
	 * 
	 * @param integer $id
	 * @return \Core\Model
	 */
	public function delete($id)
	{
		$this->db->delete($this->table, array(
			$this->primaryKey => $id,
		));
		
		return $this;
	}
	
	/**
	 * Deletes records by condition array
	 * 
	 * @param array $where
	 * @return \Core\Model
	 */
	public function deleteMany(array $where)
	{
		$this->db->delete($this->table, $where);
		
		return $this;
	}
}