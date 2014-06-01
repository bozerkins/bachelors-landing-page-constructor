<?php

namespace Mdl\Style;

class Auto extends General
{
	public function validate($value)
	{
		return $value === 'auto';
	}
}