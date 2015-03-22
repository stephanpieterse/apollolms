<?php

class ALMS_CourseHandler{
	public function getAllIds(){
		$r = sql_execute("SELECT id FROM courses");
		while ($d = sql_get($r)){
			$idArray[] = $d['id'];
		}
		
		return $idArray;
	}
	
}
