<?php

namespace Routes\Ajax;

class Init extends \Core\Controller
{
	public function read()
	{
		$ajax = new \Lib\Ajax();
		
		$response = array();
		
		$mdlGroup = new \Mdl\Group();
		$response['groupList'] = $mdlGroup->all() ?: array();
		
		$mdlElement = new \Mdl\Element();
		$response['elementList'] = $mdlElement->all() ?: array();
		
		$mdlAttribute = new \Mdl\Attribute();
		$response['attributeList'] = $mdlAttribute->all() ?: array();
			
		$mdlStyle = new \Mdl\Style();
		$response['styleList'] = $mdlStyle->all() ?: array();
		
		$mdlStyleGroup = new \Mdl\StyleGroup();
		$response['styleGroupList'] = $mdlStyleGroup->all() ?: array();
		
		foreach($response['elementList'] as &$element) {
			$element->attributeLinkList = $mdlElement->allLinks($element, $mdlAttribute) ?: array();
			foreach($element->attributeLinkList as &$item) {
				$item = $item->{$mdlAttribute->linkKey()};
			}
			$element->styleLinkList = $mdlElement->allLinks($element, $mdlStyle) ?: array();
			foreach($element->styleLinkList as &$item) {
				$item = $item->{$mdlStyle->linkKey()};
			}
		}
		
		$response['actionList'] = $this->app->environment()->config->get('controls');
		
		$mdlTreeElementMdl = new \Mdl\Tree\Element();
		$mdlTreeAttributeMdl = new \Mdl\Tree\Attribute();
		$mdlTreeStyleMdl = new \Mdl\Tree\Style();
		$treeElements = $mdlTreeElementMdl->allTreeOrder() ?: array();
		foreach($treeElements as &$treeElement) {
			$treeElement->attributeList = $mdlTreeAttributeMdl->all(array(
				'element_id' => $treeElement->id,
			)) ?: array();
			$treeElement->styleList = $mdlTreeStyleMdl->all(array(
				'element_id' => $treeElement->id,
			)) ?: array();
		}
		$response['treeList'] = $treeElements;
		
		$ajax->response($response)->render();
	}
}