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
	
	public function insertNew($data){
		$sesUID = $_SESSION['userID'];
		$courseName = makeSafe($data['courseName']);
		$courseDesc = sql_escape_string($data['courseDescription']);
		$htmlContent = sql_escape_string($data['courseIntroContent']);
		$publishedStatus = makeSafe($data['publishedStatus']);
		if(isset($_POST['autojoin'])){
			$autojoin = 1;
		}else{
			$autojoin = 0;
		}
		
		$pubStat = 0;
		if($publishedStatus == "Yes"){
			$pubStat = 1;
			$publishedDate = date("Y-m-d-H-i-s");
		}
		
		$courseCode = makeSafe( $data['courseCode'] );
		$dateCreated = date("Y-m-d-H-i-s");
		$publishedBy = $sesUID;
		$partime = makeSafe($data['partime']);
		$partime = preg_replace( "/[^0-9]/", "", $partime );
		
		$price = makeSafe($data['price']);
		$price = strip_alpha_chars($price);
		
		$ntags = makeSafe($data['tags']);
		$tags = strip_extra_whitespace($ntags);
		
		$availForDays = strip_alpha_chars(makeSafe($data['open_for_d']));
		$availForMonths = strip_alpha_chars(makeSafe($data['open_for_m']));
		$availForYears = strip_alpha_chars(makeSafe($data['open_for_y']));
		$availFor = $availForDays . '-' . $availForMonths .'-' . $availForYears;
		
		$avBetweenSinceDay = strip_alpha_chars(makeSafe($data['open_since_d']));
		$avBetweenSinceMonth = strip_alpha_chars(makeSafe($data['open_since_m']));
		$avBetweenSinceYear = strip_alpha_chars(makeSafe($data['open_since_y']));
		$avBetweenSince = $avBetweenSinceDay .'-' . $avBetweenSinceMonth .'-'. $avBetweenSinceYear;
		
		$avBetweenTillDay = strip_alpha_chars(makeSafe($data['open_till_d']));
		$avBetweenTillMonth = strip_alpha_chars(makeSafe($data['open_till_m']));
		$avBetweenTillYear = strip_alpha_chars(makeSafe($data['open_till_y']));
		$avBetweenTill = $avBetweenTillDay .'-'. $avBetweenTillMonth .'-' . $avBetweenTillYear;
		
		$avBetweenDates = $avBetweenSince . '%' . $avBetweenTill;
		
		$modified = "<modified><created uid=\"" . $sesUID ."\" time=\"" . $dateCreated . "\"></created></modified>";
		
		$query="INSERT INTO courses(name, description, html_content, created_date, published_date, published_user, published_status, code, par_hours, permissions, articles, modified_date, autojoin, price, tags, avail_for, avail_during, owner_member) VALUES('$courseName','$courseDesc', '$htmlContent', '$dateCreated', '$publishedDate', '$publishedBy', '$pubStat', '$courseCode', '$partime', '<access></access>', '<articles></articles>', '$modified', '$autojoin', '$price', '$tags', '$availFor', '$avBetweenDates', '$sesUID')";
		$result = sql_execute($query);

		$q = "SELECT * FROM courses WHERE published_date='$publishedDate' AND name='$courseName'";
		$r = sql_get(sql_execute($q));
		
		return array("id"=>$r['ID'],"published"=>$pubStat);
	}
	
}
