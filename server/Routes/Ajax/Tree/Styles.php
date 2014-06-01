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
	
	public function validateCollection() 
	{
		$ajax = new \Lib\Ajax();
		
		$stylesList = array_key_exists('stylesList', $_POST) && is_array($_POST['stylesList']) ? $_POST['stylesList'] : NULL;
		
		if (!$stylesList) {
			$ajax->render();
			return;
		}
		
		$invalidStyleIds = array();
		$mdlStyle = new \Mdl\Style();
		foreach($stylesList as $style) {
			if (!$mdlStyle->hasTypesMatch($style['type'])) {
				continue;
			}
			$typeObjects = array();
			foreach($style['type'] as $typeName) {
				$typeObjects[] = $mdlStyle->getTypeObject($typeName);
			}
			if ($style['style_value']) {
				$result = FALSE;
				foreach($typeObjects as $typeObject) {
					$result = $result || $typeObject->validate($style['style_value']);
				}
			} else {
				$result = TRUE;
			}
			if (!$result) {
				$invalidStyleIds[] = $style['design_style_id'];
			}
		}
		$ajax->response($invalidStyleIds)->render();
	}
}