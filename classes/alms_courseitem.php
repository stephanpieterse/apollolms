<?php

class ALMS_CourseItem{
	private $courseID;
	private $courseName;
	private $coursePermissions;
	
	public function load($id){
		$q = sql_execute("SELECT * FROM courses WHERE id='$id' LIMIT 1");
		$d = sql_get($q);
		if(sql_numrows($q) == 1){
			$this->courseID = $id;
			$this->courseName = $d['NAME'];
		}else{
			return false;
		}
	}
	
	
}
