<?

include("generateCode.php");

$link = mysqli_connect("mysql", "root", "root", "admin_users");
$res = mysqli_query($link, "SELECT user_token FROM users WHERE user_token='".$_POST['token']."'");
$token = mysqli_fetch_assoc($res)['user_token'];

if (isset($token)){
	if (isset($_COOKIE['help_token']) != 1){
		$hash = md5(generateCode(10));
 		setcookie("help_token", $hash, time()+60*60*24*30, "/", null, null, true); 
	}else{
		$link = mysqli_connect("mysql", "root", "root", "message_list");
		$res = mysqli_query($link, "SELECT message FROM messages WHERE active='true' AND chat_token='".$_COOKIE['help_token']."'");
		$message = mysqli_fetch_assoc($res)['message'];
		if (isset($message)){
			echo $message;
		}else{
			echo "close";
		}
	}
}else{
	echo "user not found 404";
}


?>
