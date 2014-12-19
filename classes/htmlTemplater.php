<?php
class html_Templater{
	protected $template;
	protected $variables = array();
	
	public function __construct($template){
		$this->template = file_get_contents($template);
	}	

	public function __get($key){
		return $this->variables[$key];
	}
	
	public function __set($key, $val){
		$this->variables[$key] = $val;
	}
	
	private function removeItemTemplates(){
		$domdoc = new DOMDocument;
		$domdoc->loadHTML($this->template);
		
		$xpath = new DOMXPath($domdoc);
		$nodes = $xpath->query("//@id='*_template'");
		
		foreach($nodes as $node){
			$node->parentNode->removeChild($node);
		}
		
		return true;
		
	}

	public function insertNewItem ($item){
		$domdoc = new DOMDocument;
		$domdoc->loadHTML($this->template);
		
		$templateElem = $domdoc->getElementById($item['name'] . '_template');
		$copyElem = $templateElem->cloneNode(true);
		
		foreach($item['attributes'] as $key=>$val){
			$copyElem->setAttribute($key,$val);
		}
		
		$domdoc->appendChild($domdoc->importNode($copyElem));
		return true;
	}

	public function getTemplateFor($ids){
		
		$domdoc = new DOMDocument;
		$domdoc->loadHTML($this->template);
		
		if(is_array($ids)){
			foreach($ids as $k=>$v){
				$gettedElems[$k] = $domdoc->getElementById($v);
			}
			return $gettedElems;
		}
		
		if(is_string($ids)){
			$elem = $domdoc->getElementById($ids);
			return $elem;
		}
	}

	public function __toString(){
		//extract($this->variables);		
		if(file_exists($this->template)){
		chdir(dirname($this->template));
		}
		$htmlSet = file_get_contents($this->template);
		
		$domdoc = new DOMDocument;
		$domdoc->loadHTML($this->template);
		
		foreach($this->variables as $key=>$val){
			$curElem = $domdoc->getElementById($key);
			$curElem->innerHTML = $val;
			
			//$htmlSet = str_replace('' . $key . '', $val, $htmlSet);
		}

		ob_start();
		//include basename($this->template);
		echo $domdoc->saveHTML();
		return ob_get_clean();
	}
}
?>