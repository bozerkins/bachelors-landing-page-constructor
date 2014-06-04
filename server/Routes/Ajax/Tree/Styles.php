<?php

namespace Routes\Ajax\Tree;

class Styles extends \Core\ControllerAjax
{
	/**
	 * Updates style value
	 */
	public function update()
	{
		// get conditions array
		$where = array();
		$where['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$where['design_style_id'] = array_key_exists('design_style_id', $_POST) ? intval($_POST['design_style_id']) : NULL;
		// get new value array
		$data = array();
		$data['style_value'] = array_key_exists('style_value', $_POST) ? $_POST['style_value'] : NULL;
		
		// check for record
		$mdlStyle = new \Mdl\Tree\Style();
		$record = $mdlStyle->all($where, 1);
		// update if record exists, insert if not
		$record ? $mdlStyle->updateMany($where, $data) : $mdlStyle->insert(array_merge($where, $data));
		// render response
		$ajax = new \Lib\Ajax();
		$ajax->render();
	}
	
	/**
	 * Delete single record
	 */
	public function delete()
	{
		// get conditions array
		$where = array();
		$where['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$where['design_style_id'] = array_key_exists('design_style_id', $_POST) ? intval($_POST['design_style_id']) : NULL;
		// delete by condition
		$mdlStyle = new \Mdl\Tree\Style();
		$mdlStyle->deleteMany($where);
		// render response
		$ajax = new \Lib\Ajax();
		$ajax->render();
	}
	
	/**
	 * Validate style collection values
	 */
	public function validateCollection() 
	{
		// create response object
		$ajax = new \Lib\Ajax();
		
		// get style list
		$stylesList = array_key_exists('stylesList', $_POST) && is_array($_POST['stylesList']) ? $_POST['stylesList'] : NULL;
		
		// return nothing if no style list passed
		if (!$stylesList) {
			$ajax->render();
			return;
		}
		
		$invalidStyleIds = array();
		$mdlStyle = new \Mdl\Style();
		foreach($stylesList as $style) {
			// check if style type matches
			if (!$mdlStyle->hasTypesMatch($style['type'])) {
				continue;
			}
			// initialize type object
			$typeObjects = array();
			foreach($style['type'] as $typeName) {
				$typeObjects[] = $mdlStyle->getTypeObject($typeName);
			}
			
			if ($style['style_value']) {
				// collection validation result from type objects
				$result = FALSE;
				foreach($typeObjects as $typeObject) {
					$result = $result || $typeObject->validate($style['style_value']);
				}
			} else {
				// skip validation if value does not exist
				$result = TRUE;
			}
			// add validation results to response
			if (!$result) {
				$invalidStyleIds[] = $style['design_style_id'];
			}
		}
		// render response
		$ajax->response($invalidStyleIds)->render();
	}
}