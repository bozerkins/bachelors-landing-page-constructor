<?php

namespace Mdl;

class Element extends \Core\Model
{
	// table
	protected $table = 'design__elements';
	
	/**
	 * get key for linking with elements
	 * 
	 * @return string
	 */
	public function linkKey()
	{
		return 'element_id';
	}

	/**
	 * Links element with object
	 * 
	 * @param integer $optionObjectId
	 * @param object $elementObject
	 * @param object $optionModel
	 * @return \Mdl\Element
	 */
	public function insertLink($optionObjectId, $elementObject, $optionModel)
	{
		$this->db->insert($optionModel->linkTable(), array(
			$this->linkKey() => $elementObject->id,
			$optionModel->linkKey() => $optionObjectId,
		));
		return $this;
	}
	
	/**
	 * Deletes element - object links
	 * 
	 * @param integer $optionObjectId
	 * @param object $elementObject
	 * @param object $optionModel
	 * @return \Mdl\Element
	 */
	public function deleteLink($optionObjectId, $elementObject, $optionModel)
	{
		$this->db->delete($optionModel->linkTable(), array(
			$this->linkKey() => $elementObject->id,
			$optionModel->linkKey() => $optionObjectId,
		));
		return $this;
	}
	
	/**
	 * Gets all links by element
	 * 
	 * @param object $elementObject
	 * @param object $optionModel
	 * @return array
	 */
	public function allLinks($elementObject, $optionModel)
	{
		$list = $this->db->readBySql("SELECT * FROM {$optionModel->linkTable()} WHERE {$this->linkKey()} = {$elementObject->id}");
		return $list ?: array();
	}
}