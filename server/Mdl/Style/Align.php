<?php

namespace Mdl\Style;

class Align extends General
{
	public $lines = array(
		'left',
		'right',
		'center',
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}