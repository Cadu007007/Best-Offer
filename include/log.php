
<?php
include("config.php");
session_start();

if(isset($_POST['login']))
{
	
	$user = stripcslashes(mysqli_real_escape_string($conn,$_POST['u_name']));
	$pass =md5($_POST['u_pass']);
	if (empty($user))
	{
		echo '<div class="alert alert-danger" role="alert">Pleas Enter Your User Name</div>';
	}
	elseif (empty($_POST['u_pass']))
	{
		echo '<div class="alert alert-danger" role="alert">Pleas Enter Your User Name</div>';
	}
	else
	{
		$sql = mysqli_query($conn,"SELECT * FROM `users` WHERE (`u_name` ='$user'OR `u_mail` = '$user') AND `u_pass` ='$pass'" );
		if (mysqli_num_rows($sql) != 1)
		{
			echo '<div class="alert alert-danger" role="alert">User OR Password Not Correct</div>';
		}
		else
		{
			$user = mysqli_fetch_assoc($sql);
			$_SESSION['u_id'] = $user['u_id'];
			$_SESSION['u_name'] = $user['u_name'];
			$_SESSION['u_avatar'] = $user['u_avatar'];
			$_SESSION['date'] = $user['reg_date'];
			$_SESSION['isadmain'] = $user['isadmain'];
			
			echo '<div class="alert alert-success" role="alert">Login Success</div>';
			echo '<meta http-equiv="refresh" content="3; \'index.php\' "/>';
		}
	}
}


?>