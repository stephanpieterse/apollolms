<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */

/**
 * Loads a specific feature supplied by a plugin
 * 
 * @param string $plugPart the name of the specific plugin of a module
 * @param array $dataarr array that is passed to the plugin
 * 
 * @return null / array depeding on the result
*/
function modules_plugin_feature($plugPart, $dataarr){
	$q = "SELECT id,codetorun FROM modules WHERE plugins LIKE '%" . $plugPart . "%'";
	$r = sql_execute($q);
	
	if(sql_numrows($r) == 0){
		return false;
	}
	
	$retData = array();
		//chdir(dirname(__FILE__));
	while($d = sql_get($r)){
		$func = 'm_plugin_handler';
		$moduleFile =  MODULE_PATH  . $d['codetorun'];
		$classname = get_file_class($moduleFile);
		include_once($moduleFile);
		$moduleObj = new $classname();
		$moduleObj->set_module_id($d['id']);
		if(method_exists($moduleObj,$func)){
			$newdata = $moduleObj->$func($plugPart,$dataarr);
			//if(is_array($newdata)){
			$retData = array_merge($retData,$newdata);
			//}
			
		}else{
			//echo "Module has no support for this plugin type.";
		}
	}
	if(is_array($retData)){
		return $retData;
	}else{
		return null;
	}
}

function module_getCSS(){
	
}

/**
 * @param
 * id - module id
 * func - function name
 * data - additional needed data
 * 
 */
function module_runFunction($id,$func,$data){
	$q = "SELECT id,codetorun FROM modules WHERE id='" . $id . "' LIMIT 1";
	$r = sql_execute($q);
	$d = sql_get($r);
	
			$moduleFile =  dirname(__FILE__) . '/' . MODULE_PATH  . $d['codetorun'];
			$classname = get_file_class($moduleFile);
			include_once($moduleFile);
			$moduleObj = new $classname();
			$moduleObj->set_module_id($d['id']);
			if(method_exists($moduleObj,$func)){
				$installVars = $moduleObj->$func($data);
			}else{
				echo "Class does not contain required methods.";
	}
}

/*
	Scan a file for the first class definition. Only one class per file is used.
*/
function get_file_class($filename){
	$php_file = file_get_contents($filename);
	$tokens = token_get_all($php_file);
	$class_token = false;
	foreach ($tokens as $token) {
	if (is_array($token)) {
		if ($token[0] == T_CLASS) {
		$class_token = true;
		} else if ($class_token && $token[0] == T_STRING) {
		//echo "Found class: $token[1]\n";
		return $token[1];
		$class_token = false;
		}
	}       
	}
}

/*
	Loads a file from the path specified, and checks if the class has a basic function returning the data we need to add it into the db.
*/
function installModule($moduleFile){
	$target_path =  dirname(__FILE__) . '/' . MODULE_PATH;
	$ext = pathinfo($moduleFile['uploadedfile']['name'], PATHINFO_EXTENSION);

	if(($ext != 'php') && ($ext != 'zip')){
		return false;
	}
	// insert scan for malicious code function
	$target_path = $target_path . basename( $moduleFile['uploadedfile']['name']);

	if(file_exists($target_path)){
		unlink($target_path);
	}

	if(move_uploaded_file($moduleFile['uploadedfile']['tmp_name'], $target_path)) {

	if($ext == 'zip'){
		unzip($target_path,false, false, true);
	}
	
	$moduleFile = $target_path;
	
	$classname = get_file_class($moduleFile);
	include_once($moduleFile);
	$moduleObj = new $classname();
	if(method_exists($moduleObj,'installModuleVars')){
		$installVars = $moduleObj->installModuleVars();
		$pluginsAll = implode(',', $moduleObj->plugin_support);
		$q = "SELECT * FROM modules WHERE settingname='" . $classname ."'";
		$r = sql_execute($q);
		if(sql_numrows($r) == 1){
		$d = sql_get($r);
			if($d['version'] < $installVars['version']){
		$q = "UPDATE modules SET name='".$installVars['name']."', plugins='" . $pluginsAll . "', description='".$installVars['description']."', codetorun='".basename($moduleFile)."' WHERE id='".$d['ID'] . "'";
		$r = sql_execute($q);
		}
		}else{
		$q = "INSERT INTO modules (settingname,name,codetorun,description,plugins) VALUES('$classname','".$installVars['name']."','".basename($moduleFile)."','".$installVars['description']."','" . $pluginsAll . "')";
		$r = sql_execute($q);
		}
	}else{
		echo "Class does not contain installation variables; Did not install.";
	}
	}
}

// This function may or may not be redundant now.
/*
function loadContextModules($context, $cid){
	
	$q = "SELECT id,codetorun FROM modules WHERE context='$context' AND active='$1' AND contextid='$cid' ORDER BY priority ASC";
	$r = sql_execute($q);
	
	if(sql_numrows($r) > 1){
			while($row = sql_get($r)){
					include($row['codetorun']);
					$moduleFile = MODULE_PATH . $row['codetorun'];
					$classname = get_file_class($moduleFile);
					$moduleObj = new $classname();
					$moduleObj->set_module_id($row['id']);
					if(method_exists($moduleObj,'installModuleVars')){
						$installVars = $moduleObj->installModuleVars();
					}else{
						echo "Class does not contain installation variables; Did not install.";
					}
					}
					
				}
	}
	
*/	

/**
	Scans the DB for any custom modules to be loaded on the specified page.
	* @param string $pageName name of the page to look for
*/
function loadPageModules($pageName){
		$query = "SELECT id,codetorun FROM modules WHERE ONPAGE LIKE'%" . $pageName . "%' AND active='1'	ORDER BY priority ASC";
		$r = sql_execute($query);
		
		chdir(dirname(__FILE__));
		
		if(sql_numrows($r) >= 1){
			while($row = sql_get($r)){
				include_once(MODULE_PATH . $row['codetorun']);
					$moduleFile =  MODULE_PATH . $row['codetorun'];
					$classname = get_file_class($moduleFile);
					$moduleObj = new $classname();
					$moduleObj->set_module_id($row['id']);
					if(method_exists($moduleObj,'default_action')){
						$installVars = $moduleObj->default_action($pageName);
					}else{
						echo "Class does not contain default methods.";
					}
			}
		}
}


/**
*	Set the module active/inactive
*/
function setModuleStatus($mid, $stat){
	$q = "UPDATE modules SET active='$stat' WHERE id='$mid'";
	$r = sql_execute($q);
}

/**
 * Updates the settings of a module
 * @param int $id id of module
 * @param array $data posted data
 * */
function modules_func_updateSettings($data){
	$mid = $data['mid'];
	
	foreach($data as $key=>$value){
		$datamodloc = explode('-',$key);
		if($datamodloc[0] == "mod_loc"){
			$locations[] = $datamodloc[1];
		}
	}
	
	if(isset($locations)){
		set_module_locations($mid,$locations);
	}
	set_module_permissions($mid,$data);
	
	return true;
}

/**
 * @param int $id id of module
 * @param array $locs
 * */
function set_module_locations($id,$locs){
	
	$pagedata = implode(',',$locs);
	$q = "UPDATE modules SET onpage='".$pagedata."' WHERE id='$id'";
	$r = sql_execute($q);
}

/**
* Sets who / what is allowed to run this module. Same as courses etc.
* 
* @param int $id id of the module
* @param array $access post data from a permissions settings form
*/
function set_module_permissions($id, $access){
if(!check_user_permission('module_move')){
		return false;
	}
	$newDoc = common_set_permissions($access);
	
	$query = "UPDATE modules SET permissions='$newDoc' WHERE id='$id'";
	$result = sql_execute($query);
}

/**
Strips away all data but that allocated or named as used by modules
*/
function modules_backend_plugin_stripData($dirtyData){

	$cleanarr['mid'] = 0;
	$cleanarr['mcol'] = 0;
	$cleanarr['mname'] = 'editme';
	$cleanarr['mdata'] = array(''=>'');
	return true;
}

?>
