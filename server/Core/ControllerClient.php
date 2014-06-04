<?php

namespace Core;

class ControllerClient extends Controller
{
	public function __construct() 
	{
		\Lib\Auth::fastInit();
	}
}