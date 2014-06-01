<?php

namespace Mdl\Style;

class None extends General
{
	public function validate($value)
	{
		return $value === 'none';
	}
}