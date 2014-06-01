<?php

namespace Mdl\Style;

class Line extends General
{
	public $lines = array(
		'left',
		'right',
		'middle',
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}