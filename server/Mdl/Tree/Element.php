<?php

namespace Mdl\Tree;

class Element extends \Core\Model
{
	protected $table = 'manipulation__elements';
	
	public function allTreeOrder($parentElementId = NULL, $result = array())
	{
		$where = $parentElementId ? array(
			'parent_element_id' => $parentElementId,
		) : array();
		$records = $this->all($where) ?: array();
		foreach($records as $record){
			$result[] = $record;
		}
		foreach($records as $record){
			$result = $this->allTreeOrder($record->id, $result);
		}
		return $result;
	}
}