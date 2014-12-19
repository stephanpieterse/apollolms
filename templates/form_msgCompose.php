<script>
    window.onload = function() {
        CKEDITOR.replace( 'messageBody' );
    };
</script>

<form class="boxArea" method="POST" action="index.php?action=sendMsg">
<b>Subject:<br/></b>
<input name="subject" type="text"/><br/>
<b>Message:<br/></b>
<textarea name="messageBody" type="text"></textarea><br/>
<b>Send To:</b>
<?php
buildPermissionsForm()
?>
<br/>
<input type="submit" value="Send" />
</form>

