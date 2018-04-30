<?php

class UserData
{
	private $states = array();
	public function __construct() {
		$this->states["ClientId"] = 2;
		
		
	}
	
	public function getState($key)
	{
		if(isset($this->states[$key]))
			return $this->states[$key];
		
		return "";
	}
	
	
}

?>