<?php

namespace Routes\Ajax\Tree;

class Attributes extends \Core\Controller
{
	public function update()
	{
		$data = array();
		$data['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$data['design_attribute_id'] = array_key_exists('design_attribute_id', $_POST) ? intval($_POST['design_attribute_id']) : NULL;
		$data['attribute_value'] = array_key_exists('attribute_value', $_POST) ? $_POST['attribute_value'] : NULL;
		
		$mdlAttribute = new \Mdl\Tree\Attribute();
		$mdlAttribute->insert($data);
	}
}