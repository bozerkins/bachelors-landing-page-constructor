<?php

namespace Mdl;

class Element extends \Core\Model
{
	protected $table = 'design__elements';
	
	public function linkKey()
	{
		return 'element_id';
	}
	
	public function insertLink($optionObjectId, $elementObject, $optionModel)
	{
		$this->db->insert($optionModel->linkTable(), array(
			$this->linkKey() => $elementObject->id,
			$optionModel->linkKey() => $optionObjectId,
		));
	}
	
	public function deleteLink($optionObjectId, $elementObject, $optionModel)
	{
		$this->db->delete($optionModel->linkTable(), array(
			$this->linkKey() => $elementObject->id,
			$optionModel->linkKey() => $optionObjectId,
		));
	}
	
	public function allLinks($elementObject, $optionModel)
	{
		$list = $this->db->readBySql("SELECT * FROM {$optionModel->linkTable()} WHERE {$this->linkKey()} = {$elementObject->id}");
		return $list ?: array();
	}
}