<?
$link = mysqli_connect("mysql", "root", "root", "message_list");

mysqli_query($link, "UPDATE messages SET active='".$_POST['active']."' WHERE chat_token='".$_POST['chat_token']."'");

?>