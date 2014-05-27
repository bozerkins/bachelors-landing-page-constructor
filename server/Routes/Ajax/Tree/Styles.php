<?php

namespace Routes\Ajax\Tree;

class Styles extends \Core\Controller
{
	public function update()
	{
		$where = array();
		$where['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$where['design_style_id'] = array_key_exists('design_style_id', $_POST) ? intval($_POST['design_style_id']) : NULL;
		$data = array();
		$data['style_value'] = array_key_exists('style_value', $_POST) ? $_POST['style_value'] : NULL;
		
		$mdlStyle = new \Mdl\Tree\Style();
		$record = $mdlStyle->all($where, 1);
		$record ? $mdlStyle->updateMany($where, $data) : $mdlStyle->insert(array_merge($where, $data));
	}
	
	public function delete()
	{
		$where = array();
		$where['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$where['design_style_id'] = array_key_exists('design_style_id', $_POST) ? intval($_POST['design_style_id']) : NULL;
		$mdlStyle = new \Mdl\Tree\Style();
		$mdlStyle->deleteMany($where);
		$ajax = new \Lib\Ajax();
		$ajax->render();
	}
}