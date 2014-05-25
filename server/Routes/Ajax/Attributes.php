<?php

namespace Routes\Ajax;

class Attributes extends \Core\Controller
{
	public function read()
	{
		$ajax = new \Lib\Ajax();
		$mdlElement = new \Mdl\Element();
		
		$id = array_key_exists('id', $_POST) ? intval($_POST['id']) : NULL;
		$record = $mdlElement->one($id);
		
		if (!$record) {
			$ajax->response(array())->render();
			return;
		}
		
		$mdlAttribute = new \Mdl\Attribute;
		$links = $mdlElement->allLinks($record, $mdlAttribute) ?: array();
		$attributes = array();
		foreach($links as $attrLink) {
			$attributes[] = $mdlAttribute->one($attrLink->{$mdlAttribute->linkKey()});
		}
		$ajax->response($attributes)->render();
	}
}