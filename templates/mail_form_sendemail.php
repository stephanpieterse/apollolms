<form class="centerfloat" name="msgForm" method="post" action="mail.php?pq=
<?php 
if(isset($_GET['type']) && $_GET['type'] == 'allgroupmembers'){ echo 'allgroupmembers&gid=' . $_GET['gid'];} 
if(isset($_GET['type']) && $_GET['type'] == 'informCourseUsers'){ 
	echo 'informCourseUsers';
	echo '<input type="hidden" name="cid" value="' . $_GET['cid'] . '"';
	} 
?>">
<input type="text" name="subject" /><br/>
<textarea type="text" name="msgbox" id="msgbox" cols="125" rows="7">Please enter your message here</textarea><br/>
<input type="submit" name="submit" value="Send Message" >
</form>
<script>
    window.onload = function() {
        CKEDITOR.replace( 'msgbox' );
		CKEDITOR.config();
    };
</script>
