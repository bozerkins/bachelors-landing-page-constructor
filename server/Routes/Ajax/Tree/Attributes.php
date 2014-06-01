<?php

namespace Routes\Ajax\Tree;

class Attributes extends \Core\Controller
{
	public function update()
	{
		$where = array();
		$where['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$where['design_attribute_id'] = array_key_exists('design_attribute_id', $_POST) ? intval($_POST['design_attribute_id']) : NULL;
		$data = array();
		$data['attribute_value'] = array_key_exists('attribute_value', $_POST) ? $_POST['attribute_value'] : NULL;
		
		$mdlAttribute = new \Mdl\Tree\Attribute();
		$record = $mdlAttribute->all($where, 1);
		$record ? $mdlAttribute->updateMany($where, $data) : $mdlAttribute->insert(array_merge($where, $data));
	}
	
	public function delete()
	{
		$where = array();
		$where['element_id'] = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$where['design_attribute_id'] = array_key_exists('design_attribute_id', $_POST) ? intval($_POST['design_attribute_id']) : NULL;
		$mdlAttribute = new \Mdl\Tree\Attribute();
		$mdlAttribute->deleteMany($where);
		$ajax = new \Lib\Ajax();
		$ajax->render();
	}
	
	public function validateCollection() 
	{
		$ajax = new \Lib\Ajax();
		
		$attributeList = array_key_exists('attributeList', $_POST) && is_array($_POST['attributeList']) ? $_POST['attributeList'] : NULL;
		
		if (!$attributeList) {
			$ajax->render();
			return;
		}
		
		$invalidAttributeIds = array();
		$mdlAttribute = new \Mdl\Attribute();
		foreach($attributeList as $attribute) {
			if (!in_array($attribute['type'], $mdlAttribute->types())) {
				continue;
			}
			if (!$attribute['attribute_value']) {
				continue;
			}
			$attributeTypeObject = $mdlAttribute->getTypeObject($attribute['type']);
			if (!$attributeTypeObject->validate($attribute['attribute_value'])) {
				$invalidAttributeIds[] = $attribute['design_attribute_id'];
			}
		}
		$ajax->response($invalidAttributeIds)->render();
	}
}