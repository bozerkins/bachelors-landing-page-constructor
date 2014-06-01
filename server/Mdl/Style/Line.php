<?php

namespace Mdl\Style;

class Line extends General
{
	public $lines = array(
		'solid',
		'dashed'
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}