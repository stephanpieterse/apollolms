<?php

require('admin_config.php');

installTestFile();

function installTestFile(){
	// Where the file is going to be placed
	$target_path = "../test_templates/";
	/* Add the original filename to our target path.
	Result is "uploads/filename.extension" */
	$target_path = $target_path . basename( $_FILES['uploadedfile']['name']);

	$ext = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_EXTENSION);
	if(($ext == 'php')){
	
	if(file_exists($target_path)){
		unlink($target_path);
	}	

	if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	echo "The file ". basename( $_FILES['uploadedfile']['name']) . " has been uploaded";
	require($_FILES['uploadedfile']['name']);

	$className = pathinfo($_FILES['uploadedfile']['name'], PATHINFO_FILENAME);
	$testItem = new $className;

	if(isset($testItem->get_class_description())){
		$itemDesc = $testItem->get_class_description();
	}else{
		$itemDesc = "No description available for this question.";
	}

	$itemName = $testItem->get_class_nicename();

	$q = "INSERT INTO test_questions (name, description, class_file) VALUES('$itemName','$itemDesc','$className')";	
	$r = sql_execute($q);

	
	} else{
	echo "There was an error uploading the file, please try again!";
	}
	}else{
		"You cannot upload files of this type.";
	}

	


}

?>
