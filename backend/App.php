<?php

class App
{
	public $language;
	public $params;
	public $config;
	public $request = null;
	public $user = null;
	public $clientScript = null;
	public $session;
	public function __construct() {
		global $language;
		
	
		$this->language = $language;
		if($this->request == null)
			$this->request = new Request();
		if($this->user == null)
		    $this->user = new UserData();
		if($this->clientScript == null)
			$this->clientScript = new ClientScript;
		
		$this->config = $this->getConfig();
		$this->session = $_SESSION;
		
		
	}
	public function getBaseUrl($is_true)
	{
		if($is_true)
			return $this->request->getRealPath();
		return $this->request->baseUrl;
	}
	
	private function getConfig()
	{
		$config = require_once(dirname(__FILE__)."/structure/config.php");
		if(isset($config["params"]))
			$this->params = $config["params"];
		return $config;
	}

}

?>