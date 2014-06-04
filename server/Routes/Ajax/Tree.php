<?php

namespace Routes\Ajax;

class Tree extends \Core\ControllerAjax
{
	public function create()
	{
		$ajax = new \Lib\Ajax();
		
		$designElementId = array_key_exists('design_element_id', $_POST) ? intval($_POST['design_element_id']) : NULL;
		$parentElementId = array_key_exists('parent_element_id', $_POST) ? intval($_POST['parent_element_id']) : NULL;
		$mdlElement = new \Mdl\Tree\Element();
		$elementId = $mdlElement->insert(array(
			'design_element_id' => $designElementId,
			'parent_element_id' => $parentElementId,
			'page_id' => $this->pageId,
		));
		$ajax->response($elementId)->render();
	}
	
	public function createClone()
	{
		$ajax = new \Lib\Ajax();
		
		$elementId = array_key_exists('element_id', $_POST) ? intval($_POST['element_id']) : NULL;
		$parentElementId = array_key_exists('parent_element_id', $_POST) ? intval($_POST['parent_element_id']) : NULL;
		
		$mdlTreeElement = new \Mdl\Tree\Element();
		$record = $mdlTreeElement->one($elementId);
		$parentElementRecord = NULL;
		$parentElementId && ($parentElementRecord = $mdlTreeElement->one($parentElementId));
		if (!$record) {
			$ajax->render();
			return;
		}
		
		$mdlTreeAttribute = new \Mdl\Tree\Attribute();
		$mdlTreeStyle = new \Mdl\Tree\Style();
		
		// clear parent id for future replacement
		$record->parent_element_id = NULL;
		
		// build tree with id - keys
		$treeElementList = $mdlTreeElement->allTreeOrder($this->pageId, $record->id) ?: array();
		array_unshift($treeElementList, $record);
		$treeElementList = array_combine(array_map(array($mdlTreeElement, 'mapId'), $treeElementList), $treeElementList);
		
		foreach($treeElementList as &$treeElementInfo) {
			$attributeList = $mdlTreeAttribute->all(array(
				'element_id' => $treeElementInfo->id,
			)) ?: array();
			$styleList = $mdlTreeStyle->all(array(
				'element_id' => $treeElementInfo->id,
			)) ?: array();
			// identify tree parent
			$treeParentElementInfo = NULL;
			if ($treeElementInfo->parent_element_id) {
				 $treeParentElementInfo = $treeElementList[$treeElementInfo->parent_element_id] ?: NULL;
			}
			if (!$treeParentElementInfo && $parentElementRecord) {
				$treeParentElementInfo = $parentElementRecord;
			}
			// define clone data
			$cloneElementInfo = array(
				'design_element_id' => $treeElementInfo->design_element_id,
				'parent_element_id' => $treeParentElementInfo ? $treeParentElementInfo->id : 0,
				'page_id' => $this->pageId,
			);
			// create element
			$treeElementInfo->id = $mdlTreeElement->insert($cloneElementInfo);
			// bind styles
			foreach($attributeList as $attributeInfo) {
				$mdlTreeAttribute->insert(array(
					'element_id' => $treeElementInfo->id,
					'design_attribute_id' => $attributeInfo->design_attribute_id,
					'attribute_value' => $attributeInfo->attribute_value,
				));
			}
			foreach($styleList as $styleInfo) {
				$mdlTreeStyle->insert(array(
					'element_id' => $treeElementInfo->id,
					'design_style_id' => $styleInfo->design_style_id,
					'style_value' => $styleInfo->style_value,
				));
			}
			// initialize tree element for rendering
			$treeElementInfo = $mdlTreeElement->one($treeElementInfo->id);
			$treeElementInfo->attributeList = $mdlTreeAttribute->all(array(
				'element_id' => $treeElementInfo->id,
			)) ?: array();
			$treeElementInfo->styleList = $mdlTreeStyle->all(array(
				'element_id' => $treeElementInfo->id,
			)) ?: array();
		}
		
		$ajax->response($treeElementList)->render();
	}
	
	public function delete()
	{
		$elementId = array_key_exists('id', $_POST) ? intval($_POST['id']) : NULL;
		$mdlElement = new \Mdl\Tree\Element();
		$mdlElement->delete($elementId);
		$ajax = new \Lib\Ajax();
		$ajax->render();
	}
}