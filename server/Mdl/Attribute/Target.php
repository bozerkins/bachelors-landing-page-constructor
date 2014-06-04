<?php

namespace Mdl\Attribute;

class Target extends General
{
	public $lines = array(
		'blank',
		'self',
		'parent',
		'top',
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}