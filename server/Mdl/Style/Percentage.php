<?php

namespace Mdl\Style;

class Percentage extends General
{
	public function validate($value)
	{
		return preg_match("/^[0-9]+\%$/", $value);
	}
}