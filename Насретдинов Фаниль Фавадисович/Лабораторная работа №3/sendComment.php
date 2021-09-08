<?php
	require_once 'controller.php';

	session_start();
	if($_POST['captcha'] == $_SESSION['digit']) //провека капчи
	{
		$name = $_POST["name"];
		$pageId = $_POST["pageId"];
		$text = $_POST["text"];
		$date = date('Y-m-d');
		
		$link = ConnectToDB();
		mysqli_query($link, "INSERT INTO `comments` (`author`, `date`, `text`, `pageId`) VALUES ('".$name."', '".$date."', '".$text."', '".$pageId."')");
		header("Location: ".$_SERVER["HTTP_REFERER"]);
}
?>