<?php

namespace Mdl\Style;

class Float extends General
{
	public $lines = array(
		'left',
		'right'
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}