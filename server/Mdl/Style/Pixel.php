<?php

namespace Mdl\Style;

class Pixel extends General
{
	public function validate($value)
	{
		return preg_match("/^[0-9]+px$/", $value);
	}
}