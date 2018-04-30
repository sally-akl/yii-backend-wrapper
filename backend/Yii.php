<?php

class Yii
{
	private static $app;
	private static $instance;
	
	public static function app()
	{
		if(!self::$instance instanceof Yii)
		{
			
			self::$instance = new Yii();
			Yii::$app = new App();
			
		}
		return Yii::$app;
	}
	
	
	
	public static function t($file_name , $key)
	{
		global $language;
		$translate_path = dirname(__FILE__)."/structure/messages/".$language."/".$file_name.".php";
		$translate_arr = array();
		$translate_arr = include($translate_path);
		if(isset($translate_arr[$key]))
			return $translate_arr[$key];
		
		return $key;
	}

	public static function createWebApplication()
	{
		if($_SESSION['tokenVal'] == "")
		{
			$login = new LoginController();
			$login->Login();
		}
		else
		{
			
			$master_controller = new MasterController();
            $master_controller->loadScriptFiles();
			if(isset($_GET) && !isset($_GET["r"]))
			 self::mainView();
		 
			$master_controller->index();
			
		}
		
		
	}
	
	private static function mainView()
	{
		$view = new view();
		$view->render();
	}
	

	
	
}

?>