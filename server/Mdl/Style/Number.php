<?php

namespace Mdl\Style;

class Number extends General
{
	public function validate($value)
	{
		return preg_match("/^[0-9]+$/", $value);
	}
}