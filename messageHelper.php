<?
$link = mysqli_connect("mysql", "root", "root", "message_list");

mysqli_query($link, "UPDATE messages SET message='". substr($_POST['message'], 1,-1)."' WHERE active='true' AND chat_token='".$_POST['chat_token']."'");

?>
