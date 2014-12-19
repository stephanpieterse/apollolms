<?php
/**
 * Basic module class. All modules for the ApolloLMS should extend this base class.
 * 
 * Created by Stephan Pieterse
 */
abstract class module_item{

	private $myID = 0;
	private $moduleVars = array('MVER'=>'1','MTYPE'=>'group','MNAME'=>'Abstract Module','MDESC'=>'Abstract Module Class');	
	public $plugin_support = array();
	public $css_needs = array();
	
function get_module_description(){
		return $this->moduleVars['MDESC'];
}
	
function get_module_name(){
			return $this->moduleVars['MNAME'];
		}
	
function get_module_type(){
			return $this->moduleVars['MTYPE'];
		}

function get_module_version(){
		return $this->moduleVars['MVER'];
		}
		
function set_module_id($id){
		$this->myID = $id;
		}

function installModuleVars(){
		$varArray['name'] = $this->get_module_name();
		$varArray['description'] = $this->get_module_description();
		$varArray['version'] = $this->get_module_version();
		
	return $varArray;
	}

function default_action($location){
		echo "action received";
	}

function m_plugin_hander($type,$data){
	return array();
	}	

}
?>