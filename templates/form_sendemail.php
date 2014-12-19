<form class="centerfloat" name="msgForm" method="post" action="index.php?mail=
<?php 
if(isset($_GET['aq']) && $_GET['aq'] == 'mail_allgroupmembers'){ echo 'allgroupmembers&gid=' . $_GET['gid'];} 
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