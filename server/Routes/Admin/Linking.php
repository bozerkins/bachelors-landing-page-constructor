<?php

namespace Routes\Admin;

class Linking extends \Core\ControllerAdmin
{
	public function view($id)
	{
		$id = intval($id);
		
		$mdlElement = new \Mdl\Element();
		$mdlAttribute = new \Mdl\Attribute();
		$mdlStyle = new \Mdl\Style();
		$page = new \Lib\Page();
		
		$record = $mdlElement->one($id);
		if (!$record) {
			$page->addError('Invalid record selected for linking');
			\Helpers\Url::redirectBack();
			return;
		}
		$mapAttributeId = function($item){
			return $item->attribute_id;
		};
		$mapStyleId = function($item){
			return $item->style_id;
		};
		$listAttributes = $mdlElement->allLinks($record, $mdlAttribute) ?: array();
		$listAttributeIds = $listAttributes ? array_map($mapAttributeId, $listAttributes) : array();
		$listStyles = $mdlElement->allLinks($record, $mdlStyle) ?: array();
		$listStyleIds = $listStyles ? array_map($mapStyleId, $listStyles) : array();
		$page->header(array('title' => 'Linking', 'menuItem' => 'Linking'))->body('Admin/Linking/index', array(
			'element' => $record,
			'listAttributeIds' => $listAttributeIds,
			'listStyleIds' => $listStyleIds,
			'attributes' => $mdlAttribute->all() ?: array(),
			'styles' => $mdlStyle->all() ?: array(),
			'base_url_segment_add' => \Helpers\Url::getBaseUrl() . '/admin/linking/add/',
		))->footer()->render();
	}
	
	public function add($id)
	{
		$id = intval($id);
		
		$mdlElement = new \Mdl\Element();
		$page = new \Lib\Page();
		
		$record = $mdlElement->one($id);
		if (!$record) {
			$page->addError('Invalid record selected for linking');
			\Helpers\Url::redirectBack();
			return;
		}
		
		$this->updateOptions($record, new \Mdl\Attribute(), 'attributes');
		$this->updateOptions($record, new \Mdl\Style(), 'styles');
		
		\Helpers\Url::redirectBack();
	}
	
	protected function updateOptions($record, $model, $postKey)
	{
		$mdlElement = new \Mdl\Element();
		
		$optionList = array_key_exists($postKey, $_POST) && is_array($_POST[$postKey]) ? $_POST[$postKey] : array();
		$optionList && $optionList = array_filter(array_map('intval', $optionList));
		
		$optionsLinkList = $mdlElement->allLinks($record, $model);
		foreach($optionsLinkList as $optionLink) {
			if (!in_array($optionLink->{$model->linkKey()}, $optionList)) {
				$mdlElement->deleteLink($optionLink->{$model->linkKey()}, $record, $model);
			} else {
				$key = array_search($optionLink->{$model->linkKey()}, $optionList);
				unset($optionList[$key]);
			}
		}
		foreach($optionList as $optionId) {
			$mdlElement->insertLink($optionId, $record, $model);
		}
	}
}