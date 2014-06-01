<?php

namespace Mdl;

class Style extends \Core\Model
{
	protected $table = 'design__styles';
	protected $stylesLinkTable = 'design__elements_styles';
	protected $styleType = NULL;
	
	public function all(array $where = array(), $limit = NULL, $order = NULL, $group = NULL) {
		$list = parent::all($where, $limit, $order, $group) ?: array();
		foreach($list as &$item) {
			$item->type = json_decode($item->type);
		}
		return $list ?: NULL;
	}
	
	public function linkKey()
	{
		return 'style_id';
	}
	
	public function linkTable()
	{
		return $this->stylesLinkTable;
	}
	
	public function one($id) {
		$record = parent::one($id);
		$record && $record->type = json_decode($record->type);
		return $record;
	}
	
	public function insert(array $data) {
		array_key_exists('type', $data) && $data['type'] = json_encode($data['type']);
		return parent::insert($data);
	}
	
	public function update($id, array $data) {
		array_key_exists('type', $data) && $data['type'] = json_encode($data['type']);
		return parent::update($id, $data);
	}


	public function __construct() 
	{
		parent::__construct();
		$this->styleType = $this->app->environment()->config->get('styles.types') ?: array();
	}
	
	public function types()
	{
		return $this->styleType;
	}
	
	public function hasTypesMatch(array $typesToMatch)
	{
		foreach($typesToMatch as $typeToMatch) {
			if (!in_array($typeToMatch, $this->types())) {
				return FALSE;
			}
		}
		return TRUE;
	}
	
	public function getTypeObject($type)
	{
		$className = "\\Mdl\\Style\\" . $type;
		return new $className;
	}
}