<?php

include_once("../include/config.php");

if (isset($_SESSION['u_id']))
	{
		
		$sql = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '$_SESSION[u_id]' AND `isadmain` = 'admin' ");
		if(mysqli_num_rows($sql) != 1 )
			{
				header("Location ../index.php");			
			}
	}
	else
		{
			header("Location: ../index.php");
		}

?>