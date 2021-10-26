<?
$link = mysqli_connect("mysql", "root", "root", "message_list");
$res = mysqli_query($link, "SELECT * FROM messages WHERE active='true' AND user_token='".$_POST['user_token']."'");
while ($message = mysqli_fetch_assoc($res)){
	echo ($message["message"]."/".$message["chat_token"]."|");
}
?>
