<?php

/**
 * Class to handle the functions of events and such.
 * 
 * 
 * @author Stephan
 * @package ApolloLMS
 * 
 * */

class events_item{
	
	private $eventInfo = array();
	private $eventID = 0;
	
	function load($id){
		$q = "SELECT * FROM events WHERE id='$id' LIMIT 1";
		$d = sql_execute($q);
		$r = sql_get($d);
		
		$this->eventInfo = $r;
		$this->eventID = $id;
		
		return true;
	}
	
	function delete_event(){
		
		removeItem('events', $this->eventID, "Removal of an event");
		
	//	$q = "DELETE FROM events WHERE id='" . $this->eventID . "' LIMIT 1";
	//	$d = sql_execute($q);
		
		return true;		
	}
	
	function update_event($id, $name, $description, $permissions, $html, $code, $timeslots, $autojoin){
		$q = "UPDATE events SET name='$name', description='$description', permissions='$permissions', html_content='$html', code='$code', timeslots='$timeslots', autojoin='$autojoin' WHERE id='$id'";
		$d = sql_execute($q);
		
		return true;
	}
	
	function new_event($name, $description, $permissions, $html, $code, $timeslots, $autojoin){
		$q = "INSERT INTO events (name,description,permissions,html_content,code,timeslots,autojoin) VALUES('$name','$description','$permissions','$html','$code','$timeslots','$autojoin')";
		$d = sql_execute($q);
		
		$q = "SELECT * FROM events WHERE name='$name' AND code='$code' AND description='$description' LIMIT 1";
		$d = sql_execute($q);
		$r = sql_get($d);
		
		$this->eventInfo = $r;
		$this->eventID = $id;
		
		return true;
	}
	
	function get_event_info(){
		return $eventInfo;
	}
	
}

?>
