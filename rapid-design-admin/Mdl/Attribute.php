<?php

namespace Mdl;

class Attribute extends \Core\Model
{
	protected $table = 'design__attributes';
	protected $attributeTypes = NULL;
	
	public function __construct() 
	{
		parent::__construct();
		$this->attributeTypes = $this->app->environment()->config->get('attributes.types') ?: array();
	}
	
	public function types()
	{
		return $this->attributeTypes;
	}
}