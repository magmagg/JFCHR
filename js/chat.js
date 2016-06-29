var state;
var mes;
var file;
var numOfUsers = 0;
var roomid;
var usernameid;

function Chat (filetxt)
{
	file = filetxt;
	this.init = chatInit;
  this.update = updateChat;
  this.send = sendChat;
	this.getState = getStateOfChat;
	this.trim = trimstr;
	this.insertDB = insertDB;
}

function chatInit()
{
	getStateOfChat();
}

function wait(){
	updateChat();
}

$.ajaxSetup({
    cache: false // for ie
});

//gets the state of the chat
function getStateOfChat(){
	 $.ajax({
		   type: "POST",
		   url: "http://matresthesis.duckdns.org/JFCHR/processchat.php",
		   data:
			 {
		   			'function': 'getState',
						'file': file
					},
		    dataType: "json",

		   success: function(data)
			 {
			   state = data.state-500;
			   updateChat();
		   },
		});
}

//Updates the chat
function updateChat()
{

     $.ajax({

        type: "GET",
        url: "http://matresthesis.duckdns.org/JFCHR/updatechat.php",
        data: {
            'state': state,
            'file' : file
            },
        dataType: "json",
        cache: false,
        success: function(data) {

            if (data.text != null) {
                for (var i = 0; i < data.text.length; i++)
								{
                $('#chat-area').append($("<p>"+ data.text[i] +"</p>"));
            }

            document.getElementById('chat-area').scrollTop = document.getElementById('chat-area').scrollHeight;

        }

        instanse = false;
        state = data.state;
        setTimeout('updateChat()', 1);

        },
    });
}

//send the message
function sendChat(message, nickname)
{

     $.ajax({
		   type: "POST",
		   url: "http://matresthesis.duckdns.org/JFCHR/processchat.php",
		   data: {
		   			'function': 'send',
					'message': message,
					'nickname': nickname,
					'file': file
					},
		   dataType: "json",
		   success: function(data)
			 {

		   },
		});

}

function insertDB(message, nickname,quitClaimID)
{
     $.ajax({
		   type: "POST",
		   url: "http://matresthesis.duckdns.org/JFCHR/Userquitclaim/insert_to_database",
		   data: {
					'message': message,
					'nickname': nickname,
					'quitclaimID':quitClaimID
					},
		   success: function(data)
			 {
				 console.log(message);
				 console.log(nickname);
				 console.log(quitClaimID);
		   },
		});

}


function trimstr(s, limit) {
    return s.substring(0, limit);
}
