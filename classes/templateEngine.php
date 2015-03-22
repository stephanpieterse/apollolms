<?php
class Template{
	protected $template;
	protected $variables = array();
	
	public function __construct($template){
		$this->template = $template;
	}	

	public function __get($key){
		return $this->variables[$key];
	}
	
	public function __set($key, $val){
		$this->variables[$key] = $val;
	}

	public function __toString(){
		extract($this->variables);		
		if(file_exists($this->template)){
		chdir(dirname($this->template));
		}
		//ob_start("ob_gzhandler");
		ob_start();
		include basename($this->template);
		return ob_get_clean();
		//return ob_end_flush();
	}
}
