<?php

namespace Routes\Ajax\Tree;

class Styles extends \Core\Controller
{
	public function update()
	{
		$data = array();
		$data['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$data['design_style_id'] = array_key_exists('design_style_id', $_POST) ? intval($_POST['design_style_id']) : NULL;
		$data['style_value'] = array_key_exists('style_value', $_POST) ? $_POST['style_value'] : NULL;
		
		$mdlStyle = new \Mdl\Tree\Style();
		$mdlStyle->insert($data);
	}
}