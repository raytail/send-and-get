<?

include("generateCode.php");

$link = mysqli_connect("mysql", "root", "root", "admin_users");
$res = mysqli_query($link, "SELECT user_token FROM users WHERE user_token='".$_POST['token']."'");
$token = mysqli_fetch_assoc($res)['user_token'];
echo($token);
if (isset($token)){
	if (isset($_COOKIE['help_token']) != 1){
		$hash = md5(generateCode(10));
 		setcookie("help_token", $hash, time()+60*60*24*30, "/", null, null, true); 
	}
	$link = mysqli_connect("mysql", "root", "root", "message_list");
	$res = mysqli_query($link, "SELECT message FROM messages WHERE chat_token='".$_COOKIE['help_token']."' AND active='true'");
	$message =   mysqli_fetch_assoc($res);
	if (isset($message['message'])){
		mysqli_query($link, "UPDATE messages SET message='".substr($message['message'],0,-1).$_POST['message']."' WHERE active='true' AND chat_token='".$_COOKIE['help_token']."'");
	}else{
		mysqli_query($link, 
			"INSERT INTO `messages` ( `time`,
    			`message`,
    			`active`,
    			`user_token`,
    			`chat_token`) 
    		VALUES (CURRENT_TIME(), '"."[".substr($_POST['message'], 1)."', 'true','".$token."', '".$_COOKIE['help_token']."')");
	}
}

?>