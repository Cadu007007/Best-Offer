<?php
include_once('config.php');
session_start();
if (isset($_POST['submit'])) 
{
	$user = $_POST['u_name'];
	$email =$_POST['u_mail'];
	$date = date("Y-m-d");
	if(empty($user))
	{
		echo '<div class="alert alert-warning" role="alert">Pleas Enter Your User Name</div>';
	}
	elseif(empty($email))
	{
		echo '<div class="alert alert-warning" role="alert">Pleas Enter Your Email</div>';
	}
	elseif(!filter_var($email,FILTER_VALIDATE_EMAIL))
	{
		echo '<div class="alert alert-warning" role="alert">Pleas Enter Correct Email</div>';
	}
	elseif(empty($_POST['u_pass']))
	{
		echo '<div class="alert alert-warning" role="alert">Pleas Enter Password</div>';
		
	}
	elseif(empty($_POST['cu_pass']))
	{
		echo '<div class="alert alert-warning" role="alert">Pleas Enter Confirm Password</div>';
		
	}
	elseif ($_POST['u_pass'] != $_POST['cu_pass'])
	{
		echo '<div class="alert alert-warning" role="alert">Password Did Not Match</div>';
		
	}

	else
	{ 
		global $conn;
			$sql_uname = mysqli_query($conn,"SELECT `u_name` FROM `users` WHERE `u_name` = '$user'");
			$sql_email = mysqli_query($conn,"SELECT `u_mail` FROM `users` WHERE `u_mail` = '$email' ");
			if(mysqli_num_rows($sql_uname)> 0)
			{
				echo '<div class="alert alert-danger" role="alert">User Name Already Exsist</div>';
				
			}


			
			elseif(mysqli_num_rows($sql_email)> 0)
			{
				echo '<div class="alert alert-danger" role="alert">Email Already Exsist</div>';
			}
			else
				{
					if(isset($_FILES ['image'] ))
			{
				$image=$_FILES['image'];
				$image_name = $image['name'];
				$image_tmp = $image['tmp_name'];
				$image_size = $image['size'];
				$image_error = $image['error'];

				$image_exe = explode('.',$image_name);
				$image_exe = strtolower(end($image_exe));

				$allowd =array('png','gif','jpg','jepg');
				if (in_array($image_exe, $allowd)) 
				{
					if($image_error === 0)
					{
						if($image_size <= 16000000)
						{
							$new_name = uniqid('u_mail',false) .'.' .$image_exe;
							$image_dir = '../images/avatar/' . $new_name ;
							$image_db = 'images/avatar/'.$new_name;
							if (move_uploaded_file($image_tmp, $image_dir)) {
								$pss = md5($_POST['u_pass']);
								$insert = "INSERT INTO `users` (`u_name`,`u_mail`,`u_pass`,`u_avatar`,`reg_date`,`isadmain`) 
														VALUES ('$user','$email','$pss','$image_db','$date','user')";
										$insert_sql=mysqli_query($conn,$insert);
										if(isset($insert_sql))
											{
													if(isset($insert_sql))
											{
												$user_info = mysqli_query($conn,"SELECT * FROM `users` WHERE `u_name`='$user'");
												$user = mysqli_fetch_assoc($user_info);
												$_SESSION['u_id'] = $user['u_id'];
												$_SESSION['u_name'] = $user['u_name'];
												$_SESSION['u_avatar'] = $user['u_avatar'];
												$_SESSION['date'] = $user['reg_date'];
												$_SESSION['isadmain'] = $user['isadmain'];
												
												echo '<div class="alert alert-success" role="alert">Regist Success</div>';
												echo '<meta http-equiv="refresh" content="3; \'index.php\' "/>';
											}
											}


								
							}
							else
							{
								echo '<div class="alert alert-warning" role="alert">Something Happend During Uplead The Photo</div>';
							}
						}
						else
						{
							echo '<div class="alert alert-warning" role="alert">Sorry Maximum Size For Avatar Can\'t Be Over Than 2MB</div>';
						}
					}
					else
					{
						echo '<div class="alert alert-warning" role="alert">Something Happend During Uplead The Photo</div>';
					}
				}
				else
				{
					echo '<div class="alert alert-warning" role="alert">Pleas Choose Right Extension </div>';
				}


			}
			else
			{
				$pss = md5($_POST['u_pass']);
								$insert = "INSERT INTO `users` (`u_name`,`u_mail`,`u_pass`,`u_avatar`,`reg_date`,`isadmain`) 
														VALUES ('$user','$email','$pss','images/500x400.png','$date','user')";
										$insert_sql=mysqli_query($conn,$insert);
										if(isset($insert_sql))
											{
												$user_info = mysqli_query($conn,"SELECT * FROM `users` WHERE `u_name`='$user'");
												$user = mysqli_fetch_assoc($user_info);
												$_SESSION['u_id'] = $user['u_id'];
												$_SESSION['u_name'] = $user['u_name'];
												$_SESSION['u_avatar'] = $user['u_avatar'];
												$_SESSION['date'] = $user['reg_date'];
												$_SESSION['isadmain'] = $user['isadmain'];
												
												echo '<div class="alert alert-success" role="alert">Regist Success</div>';
												echo '<meta http-equiv="refresh" content="3; \'index.php\' "/>';
											}
			}
				}

	}	
}

?>