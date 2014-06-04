<?php

namespace Mdl\Style;

class YesNo extends General
{
	public $lines = array(
		'yes',
		'no',
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}