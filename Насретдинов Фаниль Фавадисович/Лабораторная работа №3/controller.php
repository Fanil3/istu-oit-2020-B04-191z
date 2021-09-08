<?php
	function ConnectToDB()
	{
		return mysqli_connect('localhost','mysql','mysql','site');
	}
?>