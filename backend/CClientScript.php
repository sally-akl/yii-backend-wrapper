<?php

abstract class CClientScript
{
	const  POS_END = "bottom";
	const  POS_HEAD = "top";
	public abstract function registerCssFile($link);
	public abstract function registerScriptFile($file , $pos=null);

}

?>