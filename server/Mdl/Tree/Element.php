<?php

namespace Mdl\Tree;

class Element extends \Core\Model
{
	protected $table = 'manipulation__elements';
	
	public function allTreeOrder($pageId, $parentElementId = NULL, $result = array())
	{
		$where = $parentElementId ? array(
			'parent_element_id' => $parentElementId,
			'page_id' => $pageId,
		) : array(
			'parent_element_id' => 0,
			'page_id' => $pageId,
		);
		$records = $this->all($where) ?: array();
		foreach($records as $record){
			$result[] = $record;
		}
		foreach($records as $record){
			$result = $this->allTreeOrder($pageId, $record->id, $result);
		}
		return $result;
	}
	
	public function mapId($item)
	{
		return $item->id;
	}
}