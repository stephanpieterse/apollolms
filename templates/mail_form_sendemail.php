<?php
/*
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
?>
<form class="centerfloat" name="msgForm" method="post" action="mail.php?pq=
<?php
if(isset($_GET['type']) && $_GET['type'] == 'allgroupmembers'){ 
	echo 'informGroupUsers'  . '">';
	echo '<input type="hidden" name="gid" value="' . $_GET['gid'] . '"';
	} 
if(isset($_GET['type']) && $_GET['type'] == 'informCourseUsers'){ 
	echo 'informCourseUsers'  . '">';
	echo '<input type="hidden" name="cid" value="' . $_GET['cid'] . '"';
	} 
if(isset($_GET['type']) && $_GET['type'] == 'allmembers'){ 
	echo 'informAllUsers' . '">';
	} 
?>
<label for="subj">Subject
<input type="text" name="subject" /></label>
<textarea type="text" name="msgbox" id="msgbox" cols="250" rows="15">Please enter your message here</textarea><br/>
<input type="submit" name="submit" value="Send Message" >
</form>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'msgbox' );
		CKEDITOR.config();
    };
</script>
