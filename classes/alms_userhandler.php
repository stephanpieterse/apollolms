<?php

class ALMS_UserHandler{
	public function getAllIds(){
		$r = sql_execute("SELECT id FROM members");
		while ($d = sql_get($r)){
			$idArray[] = $d['id'];
		}
		
		return $idArray;
	}
	
}
