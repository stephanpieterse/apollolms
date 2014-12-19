<?php
$dispatch_secnav = array(
// User Section
"u_msgs"=>function(){
	if(check_user_permission("messages_create")){
	echo '<li><a href="index.php?action=composeMsg&sn=u_msgs">Compose New Message</a></li>';
	echo '<li><a href="index.php?action=msg_view_sent&sn=u_msgs">View Sent</a></li>';
	}
	echo '<li><a href="index.php?action=viewInbox&sn=u_msgs">Inbox</a></li>';
},

"u_grp"=>function(){
$link = '<li><a href="index.php?action=joinNewGroup">Join a group</a></li>';
echo $link;
},
// Admin Section

"a_tstmng"=>function(){
if(check_user_permission("tests_add")){
	$link = '<li><a href="index.php?action=newTest">Add New Test</a></li>';
	echo $link;
	}
},

"a_artmng"=>function(){
if(check_user_permission("content_add")){
	$link = '<li><a href="index.php?action=new_article">New Article</a></li>';
	echo $link;
}
},
);
?>