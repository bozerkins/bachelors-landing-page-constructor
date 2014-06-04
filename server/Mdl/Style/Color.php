<?php

namespace Mdl\Style;

class Color extends General
{
	public function validate($value)
	{
		return preg_match("/^[a-zA-Z\#0-9]+$/", $value) || preg_match("/^rgb\([0-9]{1,3}, [0-9]{1,3}, [0-9]{1,3}\)$/", $value);
	}
}