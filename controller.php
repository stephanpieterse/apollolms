<?php
/**
 * This is the action controller that is used across the site.
 * It scans the url, decides if it should display a form or perform a function
 * The settings need to be set in the file that is calling this, hopefully
 * 
 * @author Stephan Pieterse
 * @package ApolloLMS
 * 
 * */
class Controller {
	
	protected $variables = array();
	public $headerBuilt = false;
	
	public function __get($key){
		if(isset($this->variables[$key])){
		return $this->variables[$key];
	}else{
		return '';
	}
	}
	
	public function __set($key, $val){
		$this->variables[$key] = $val;
	}
	
	function build_navigation(){
		$view = new Template(TEMPLATE_PATH . 'views/site_navbar.php');
		if(isset($this->variables['secNav'])){
			$view->VAR_SEC_MENU = $this->variables['secNav'];
		}
		echo $view;
	}
	
	function build_site_start(){
		chdir(dirname(__FILE__));
		require_once("config.php");
		require_once("func_misc.php");
		
		$view = new Template(TEMPLATE_PATH . 'views/site_start.php');	
		echo $view;
	}
	
	function build_body_start(){
		$view = new Template(TEMPLATE_PATH . 'views/site_body.php');
		echo $view;
		}	
	
	
	function build_header(){
		$view = new Template(TEMPLATE_PATH . 'views/site_header.php');	
		$view->_SITE_TITLE = ($this->_SITE_TITLE != '') ? SITE_NAME . ' - ' . $this->_SITE_TITLE : SITE_NAME;
		echo $view;
		
		$this->headerBuilt = true;
		
		$this->build_body_start();
		logAction($_GET);
	}
	
	function print_debug_info(){
		echo session_id();
		br();
		//echo error_get_last();
		br();
		foreach($_SESSION as $key=>$val){
				echo $key .' = ' .var_dump($val);
				br();
			
		}
		br();br();
		
		if(!isset($_COOKIE) && $_COOKIE != null){
			echo 'Cookies seem to be disabled...';
		}else{
			echo 'Cookies are good to go...';
			var_dump($_COOKIE);
		}
		
		foreach($_COOKIE as $key=>$val){
			echo $key .' = ' .$val;
			br();
		}
		
		br();br();
		foreach($_FILES as $key=>$val){
			echo $key .' = ' .$val;
			br();
		}
		foreach($_SERVER as $key=>$val){
			if(is_array($val)){
			foreach($val as $k=>$v){
				echo $k . '=' . $v;
			}
			}else{
			echo $key .' = ' .$val;
			}
			br();
		}
		br();br();
		
		foreach($_POST as $key=>$val){
			echo $key .' = ' .$val;
			$_SESSION['post_'.$key] = $val;
			br();
		}
		br();
	//	system('dmesg | tail');
				
				echo'<script type="text/javascript">
				{
					var cookieEnabled = (navigator.cookieEnabled) ? true : false;
					if (typeof navigator.cookieEnabled == "undefined" && !cookieEnabled)
					{ 
						document.cookie="testcookie";
						cookieEnabled = (document.cookie.indexOf("testcookie") != -1) ? true : false;
					}
					document.write("status:" + cookieEnabled);
				}				</script><noscript>JS is disabled</noscript>';
	}
	
	
	function build_footer(){
		$view = new Template(TEMPLATE_PATH . 'views/site_footer.php');	
		echo $view;
		if( defined("DEBUG_MODE") && (DEBUG_MODE === 'on')){
			$this->print_debug_info();
		}
	}
	
	function executeControl($GETDAT, $POSTDAT){
		//$f = $GETDAT['f'];
		$f = (isset($GETDAT['f']) ? $GETDAT['f'] : null);
		//$q = $GETDAT['q'];
		$q = (isset($GETDAT['q']) ? $GETDAT['q'] : null);
		//$pq = $GETDAT['pq'];
		$pq = (isset($GETDAT['pq']) ? $GETDAT['pq'] : null);
		$gq = (isset($GETDAT['gq']) ? $GETDAT['gq'] : null);
		$fq = (isset($GETDAT['fq']) ? $GETDAT['fq'] : null);
		$s = (isset($GETDAT['s']) ? $GETDAT['s'] : null);
		$mq = (isset($GETDAT['mq']) ? $GETDAT['mq'] : null);
		$msg = (isset($GETDAT['msg']) ? $GETDAT['msg'] : null);
		$searchFor = (isset($POSTDAT['search']) ? $POSTDAT['search'] : null);
		
		$this->build_site_start();
		$formPre = $this->formPre;
		$funcPre = $this->funcPre;
		
		if(!isset($_SESSION['userID']) && $this->protectedPages){
			if(!$this->headerBuilt){$this->build_header();}
			$this->build_navigation();
			defaultHome();
			$this->build_footer();
			exit;
		}
		
		if(isset($searchFor)){
			$queryToExec = $funcPre . 'search';
			if(function_exists($queryToExec)){
				$searchResult = call_user_func($queryToExec, $POSTDAT);
				echo $searchResult;
			}
		}
		
		// BETA FOR HANDLING FILES VIA CONTROLLER
		if(isset($fq)){
			$queryToExec = $funcPre . $fq;
			if(function_exists($queryToExec)){
				$POSTDAT = (isset($POSTDAT) ? $POSTDAT : array());
				$POSTDAT = array_merge($POSTDAT,$_FILES);
				$stat = call_user_func($queryToExec, $POSTDAT);
				if($stat !== false){
					page_redirect('index.php?msg=' . $stat);//goToLastPage('success');
				}else{
					page_redirect('index.php?msg=failure');
				}
			}else{
				//goHome('failure_nofunc');
				page_redirect('index.php');
			}
		}
		
		// BETA CONFIRMATION CONTROLLER
		if(isset($GETDAT['confirm']) && ($GETDAT['confirm'] != 1)){
			include(TEMPLATE_PATH . "form_confirm_action.php");
			exit;
		}
		
		if(!isset($s) && !isset($mq) && !isset($pq) && !isset($q) && !isset($f) && !isset($searchFor)){
			//$this->build_header();
			$f = 'home';
		}
		
		if(isset($s)){
			if(!$this->headerBuilt){$this->build_header();}
			markLastPage($GETDAT);
			$formToShow = '' . TEMPLATE_PATH . $formPre . 'search' .'.php';
				
			$this->build_navigation();
		
			chdir(dirname(__FILE__));
			
			if(file_exists($formToShow)){
				include($formToShow);
				echo $s;
			}else{
				goHome('404');
			}
			
		}
		
		if((isset($mq)) && (isset($GETDAT['mi']))){
			if(!$this->headerBuilt){$this->build_header();}
			$this->build_navigation();
			markLastPage($GETDAT);
			module_getCSS($GETDAT['mi']);
			module_runFunction($GETDAT['mi'],$mq,$GETDAT);
		}
		
		if(isset($gq)){
			// get calls from something like dispatch_table_actions
			// execute as same
			$this->build_header();
			include_once('dispatch_table_actions.php');
			if(isset($dispatch_gq[$gq])){
				call_user_func($dispatch_gq[$gq]);
			}else{
				echo 'gq function not found';
			}
		}
		
		if(isset($f)){
			if(!$this->headerBuilt){$this->build_header();}
			markLastPage(pathinfo($_SERVER['SCRIPT_FILENAME'],PATHINFO_BASENAME) . '?' .  $_SERVER['QUERY_STRING']);
			$formToShow = '' . TEMPLATE_PATH . $formPre . $f .'.php';
			
			if(strpos($f,'admin') !== false){
				$this->secNav = 'admin_' . $this->secNav;
			}else{
				$this->secNav = 'user_' . $this->secNav;
			}
				
			if(!$this->slimPage){$this->build_navigation();}
		
			chdir(dirname(__FILE__));
			
			if(file_exists($formToShow)){
				include($formToShow);
			}else{
				goHome('404');
			}
		}
		
		if(isset($q)){
			$queryToExec = $funcPre . $q;
			if(function_exists($queryToExec)){
				if(sizeof($GETDAT) >= 2){
					$stat = call_user_func($queryToExec, $GETDAT);
				}else{
					$stat = call_user_func($queryToExec);
				}
				if($stat !== false){
					if($stat == 'goBack'){
					goToLastPage();
					}else{
					//page_redirect('index.php?msg=' . $stat);
					goToLastPage($stat);
					}
				}else{
					//page_redirect('index.php?msg=failure');
					goToLastPage('failure');
				}
			}
		}
	
		if(isset($pq)){
			$queryToExec = $funcPre . $pq;
			if(function_exists($queryToExec)){
				$stat = call_user_func($queryToExec, $POSTDAT);
				if($stat !== false){
					if($stat == 'goBack'){
					goToLastPage();
					}else{
					//page_redirect('index.php?msg=' . $stat);//goToLastPage('success');
					goToLastPage($stat);
					}
				}else{
					//page_redirect('index.php?msg=failure');
					goToLastPage('failure');
				}
			}else{
				//goHome('failure_nofunc');
				page_redirect('index.php');
			}
		}

		 if(!$this->slimPage){$this->build_footer();}
	}
}

