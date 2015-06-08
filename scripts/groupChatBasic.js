var instanse = false;
var state;
var mes;
var file;

function Chat () {
    this.update = updateChat;
    this.send = sendChat;
	this.getState = getStateOfChat;
}

//gets the state of the chat
function getStateOfChat( chatID ){
	if(!instanse){
		 instanse = true;
		 $.ajax({
			   type: "POST",
			   url: "chat_loader.php",
			   data: {  
			   			'function': 'getState',
						'file': file,
                              'gid': chatID
						},
			   dataType: "json",
			
			   success: function(data){
				   state = data.state;
				   instanse = false;
			   },
			});
	}	 
}

//Updates the chat
function updateChat( chatID ){
	 if(!instanse){
		 instanse = true;
	     $.ajax({
			   type: "POST",
			   url: "chat_loader.php",
			   data: {  
			   			'function': 'update',
						'state': state,
						'file': file,
                              'gid': chatID
						},
			   dataType: "json",
			   success: function(data){
				   if(data.text){
						for (var i = 0; i < data.text.length; i++) {
                            $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
                             document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight; 
                        }								  
				   }

				   instanse = false;
				   state = data.state;
			   },
			});
	 }
	 else {
		 setTimeout(updateChat, 1500);
	 }
}

//send the message
function sendChat(message, nickname, chatcolour, chatID)
{       
    updateChat( chatID );
     $.ajax({
		   type: "POST",
		   url: "chat_loader.php",
		   data: {  
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file,
                         'gid': chatID,
                         'chatcolour': chatcolour
				 },
		   dataType: "json",
		   success: function(data){
			   updateChat( chatID );
		   },
		});
}
