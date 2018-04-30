<?php

class ClientScript extends CClientScript
{
	private $cssFiles = array();
	private $jsFiles = array();
	public function registerCssFile($link)
	{
		$this->cssFiles[] = $link;
	}
	public function registerScriptFile($file , $pos=null)
	{
		if( $pos == null)
			$pos =  "top";
		$this->jsFiles[$pos][] = $file;
	}
	
	public function getCssFiles()
	{
		return $this->cssFiles;
	}
	public function getJsFiles()
	{
		return $this->jsFiles;
	}
}
?>