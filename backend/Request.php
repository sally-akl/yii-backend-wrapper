<?php

class Request
{
    public $baseUrl;
	private $realbase;
	public $csrfToken;
	public function __construct() {
		$this->setRequestsUrls();
		$this->generateToken();
	}
	
	private function setRequestsUrls()
	{
		$this->realbase="";
		$this->baseUrl ="";
		$url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
		$url_parse = parse_url($url);
		$this->realbase = "http://".$url_parse["host"];
		$this->baseUrl = $url_parse["path"];
		
	
		if (strpos($this->baseUrl, 'index.php') !== false)
		{
			$substr_path = substr($this->baseUrl, 0, strpos($this->baseUrl,'index.php')); 
			if(strpos($substr_path, $url_parse["host"]) === false)
			   $this->baseUrl  = $substr_path;
		}
		
		if($this->baseUrl == "/")
		   $this->baseUrl = $url;
		
		
		
	}
	
	private function generateToken()
	{
		$this->csrfToken = "";
	}
	
	public function getRealPath()
	{
		return $this->realbase;
	}
	public function getFullPath()
	{
	    if (strpos($this->baseUrl, $this->realbase) !== false)
		   return  $this->realbase;
		   
		return $this->realbase.$this->baseUrl;
	}
	
	
	public function getBaseUrl($is_true)
	{
		return $this->baseUrl;
	}
	public function getUrl()
	{
		return "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
	}
	
}

?>