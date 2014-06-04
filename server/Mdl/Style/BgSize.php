<?php

namespace Mdl\Style;

class BgSize extends General
{
	public $lines = array(
		'cover',
		'contain',
		'initial',
	);
	
	public function validate($value)
	{
		return in_array($value, $this->lines);
	}
}