<?php

namespace Mdl\Style;

class Visibility extends General
{
	public $lines = array(
		'visible',
		'hidden'
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}