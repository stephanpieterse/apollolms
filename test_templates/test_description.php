<?php
class test_description extends test_item{
	
function form_insertQuestions(){
	echo '<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>';
	echo 'Text to display: <br/> <textarea type="text" name="description"></textarea>';
	echo '<br />';
	echo "<script>
    window.onload = function() {
        CKEDITOR.replace( 'groupDescription' );
		CKEDITOR.config();
    };
</script>
";
}

function markData($xmlData){
	return $xmlData;
}

function printQuestion($questionData){
	echo $questionData['description'];
}
}
?>