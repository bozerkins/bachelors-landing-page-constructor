<?php

namespace Mdl\Style;

class Color extends General
{
	public function validate($value)
	{
		return preg_match("/^[a-zA-Z\s\.]+$/", $value);
	}
}