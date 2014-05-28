<?php

namespace Mdl;

class Attribute extends \Core\Model
{
	protected $table = 'design__attributes';
	protected $attributesLinkTable = 'design__elements_attributes';
	protected $attributeTypes = NULL;
	
	public function __construct() 
	{
		parent::__construct();
		$this->attributeTypes = $this->app->environment()->config->get('attributes.types') ?: array();
	}
	
	public function linkKey()
	{
		return 'attribute_id';
	}
	
	public function linkTable()
	{
		return $this->attributesLinkTable;
	}
	
	public function types()
	{
		return $this->attributeTypes;
	}
	
	public function getTypeObject($type)
	{
		$className = "\\Mdl\\Attribute\\" . $type;
		return new $className;
	}
}