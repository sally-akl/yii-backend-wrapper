<?php
class view
{
	private $view_path;
	private $main_layout = "layouts/main.php";
	private $vars = array();
	private $scripts = array();
	public function __construct($template_name = null) {
		$this->view_path = dirname(__FILE__) .'/structure/views/';
		if($template_name != null)
			$this->main_layout = $template_name; 
	}
	
	public function renderPartial($file_path , $vars=null)
	{
		$file_full_path = $this->view_path.$file_path.".php";
		if (strpos($file_path, 'site') === false)
			$file_full_path = $this->view_path."site/".$file_path.".php";
		
		require($file_full_path);
	}
	
	private function renderFile($file_path , $vars=null)
	{
		$file_full_path = $this->view_path.$file_path.".php";
		extract($this->vars);
        ob_start();
		ob_implicit_flush(false);
        require($file_full_path);
        return ob_get_clean();
	}

	public function render($file=null)
	{
		global  $content;
		$config = Yii::app()->config;
		$this->pageTitle = $config["name"];
		$this->scripts["css"] = Yii::app()->clientScript->getCssFiles();
		$this->scripts["js"] = Yii::app()->clientScript->getJsFiles();
		if($file == null)
		{
			$content = $this->renderFile("site/main");
		    require($this->view_path.$this->main_layout);
		}
		else
		{
			require($this->view_path.$file);
		}
	}
	private function renderCss()
	{
		$liks = "";
		foreach($this->scripts["css"] as $css)
		{
			$liks .='<link rel="stylesheet" type="text/css" href="'.$css.'" />';
		}
		return $liks;
	}
	
	private function renderJs($pos)
	{
		$links = "";
		foreach($this->scripts["js"][$pos] as $js)
		{
			$links .='<script type="text/javascript" src="'.$js.'"></script>';
		}
		echo $links;
	}
	
	public function __set($key, $value) {
        $this->vars[$key] = $value;
        return $this;
    }
    
    public function __get($key) {
        return $this->vars[$key];
    }
}

?>