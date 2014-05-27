<?php

namespace Routes\Ajax;

class Tree extends \Core\Controller
{
	public function create()
	{
		$ajax = new \Lib\Ajax();
		
		$designElementId = array_key_exists('design_element_id', $_POST) ? intval($_POST['design_element_id']) : NULL;
		$mdlElement = new \Mdl\Tree\Element();
		$elementId = $mdlElement->insert(array(
			'design_element_id' => $designElementId,
		));
		$ajax->response($elementId)->render();
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