<?php

function events_func_removeEvent($data){
	$id = $data['eid'];
	$event = new events_item;
	
	$event->load($id);
	$stat = $event->delete_event();
	
	return $stat;
}

function events_func_updateEvent($data){
	
	$id = makeSafe($data['eid']);
	$name = makeSafe($data['eventName']);
	$description = makeSafe($data['eventDescription']);
	$code = makeSafe($data['eventCode']);
	$html = makeSafe($data['eventHTML']);
	$autojoin = 0;
	$timeslots = "";
	$permissions = common_set_permissions($data);
	
	$event = new events_item;
	$stat = $event->update_event($id,$name, $description, $permissions, $html, $code, $timeslots, $autojoin);
	
	return $stat;
	
}

function events_func_addEvent($data){
	
	$name = makeSafe($data['eventName']);
	$description = makeSafe($data['eventDescription']);
	$code = makeSafe($data['eventCode']);
	$html = makeSafe($data['eventHTML']);
	$autojoin = 0;
	$timeslots = "";
	$permissions = common_set_permissions($data);
	
	$event = new events_item;
	$stat = $event->new_event($name, $description, $permissions, $html, $code, $timeslots, $autojoin);
	
	return $stat;
}
