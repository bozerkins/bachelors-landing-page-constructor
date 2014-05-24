<?php

namespace Routes\Admin\Linking;

class Attributes extends \Core\Controller
{
	public function view($id) 
	{
		$id = intval($id);
		
		$mdlElement = new \Mdl\Element();
		$mdlAttribute = new \Mdl\Attribute();
		$page = new \Lib\Page();
		
		$record = $mdlElement->one($id);
		if (!$record) {
			$page->addError('Invalid record selected for linking');
			\Helpers\Url::redirectBack();
			return;
		}
		
		$list = $mdlElement->allLinks($record, $mdlAttribute) ?: array();
		
		$page->header(array('title' => 'Attributes - Elements', 'menuItem' => 'Attributes - Elements'))->body('Admin/Linking/Attributes/index', array(
			'list' => $list ?: array(),
			'attributes' => $mdlAttribute->all() ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/linking/attributes/add/',
			'base_url_segment_change' => \Helpers\Url::getBaseUrl() . '/admin/linking/attributes/change/',
		))->footer()->render();
	}
}