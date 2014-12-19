<?php
/**
 * @author Stephan Pieterse
 * @package ApolloLMS
 * */
?>

<form class="centerfloat" name="msgForm" method="post" action="index.php?mail=
<?php 
if(isset($_GET['to']) && $_GET['to'] === 'allgroupmembers'){ echo 'allgroupmembers&gid=' . $_GET['gid'];} 
if(isset($_GET['to']) && $_GET['to'] === 'allmembers'){ echo 'allmembers';}
if(isset($_GET['to']) && $_GET['to'] === 'course'){ echo 'course&cid=' . $_GET['cid'];}
?>">
<label for="subj">Subject
<input type="text" name="subject" /></label>
<label for="msgbox">Message</label>
<textarea type="text" name="msgbox" id="msgbox" cols="250" rows="15">Please enter your message here</textarea>
<input type="submit" name="submit" value="Send Message" >
</form>
<script type="text/javascript" src="scripts/ckeditor/ckeditor.js"></script>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'msgbox' );
		CKEDITOR.config();
    };
</script>
