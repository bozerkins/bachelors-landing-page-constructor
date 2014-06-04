<?php

namespace Mdl\Style;

class FloatNumber extends General
{
	public function validate($value)
	{
		return preg_match("/^[0-9]+[\.|\,]{1}[0-9]+$/", $value);
	}
}