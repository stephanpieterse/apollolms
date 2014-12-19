<div id="page-wrap"> 
	    <h2>Group Chat</h2>
	    <div id="name-area"></div> 
	    <div id="chat-wrap">
	    <div id="chat-area">
</div>
</div> 
<form id="send-message-area"> 
	   Message: </br> 
	    <textarea id="sendie" maxlength='100'></textarea>
</form> 
</div>

<script type="text/javascript" src="<?php echo SCRIPTS_PATH; ?>groupChatBasic.js"></script>
<script type="text/javascript"> 
var name = "<?php echo $_SESSION['username'];  ?>";
var seed = Math.random();
var namecolour = "#" + Math.floor((Math.abs(Math.sin(seed) * 16777215)) % 16777215).toString(16);
// $("#name-area").html("You are: " + name + "");
 
 var chat = new Chat();
 $(function() { chat.getState(<?php echo '"' . $_GET['gid'] . '"';?>); 
   
 $("#sendie").keydown(function(event) { 
 var key = event.which;
 //all keys including return. 
 if (key >= 33) { 
  var maxLength = $(this).attr("maxlength"); 
  var length = this.value.length; 
   
 if (length >= maxLength) {
  event.preventDefault();
  } 
  }
  }); 
      
  $('#sendie').keyup(function(e) {
  if (e.keyCode == 13) {
  var text = $(this).val();
  var maxLength = $(this).attr("maxlength");
  var length = text.length; 
        
  if (length <= maxLength + 1) {
  chat.send(text, name, namecolour, <?php echo '"' . $_GET['gid'] . '"'; ?>);
  $(this).val(""); } 
  else {
    $(this).val(text.substring(0, maxLength));
  } 
  }
});
});

setInterval('chat.update(<?php echo '"' . $_GET['gid'] . '"'; ?>)', 1500);
</script>