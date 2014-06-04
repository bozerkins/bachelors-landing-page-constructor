<?php

namespace Mdl\Style;

class FontFamily extends General
{
	public function validate($value)
	{
		return preg_match("/^[a-zA-Z\s\.\-\,0-9]+$/", $value);
	}
}