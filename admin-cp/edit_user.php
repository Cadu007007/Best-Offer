<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$id = intval($_GET['user']);
$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '$id'");
$user = mysqli_fetch_assoc($get_user);
$msg = '';

if (isset($_POST['submit'])) {
	$username = $_POST['u_name'];
	$email = $_POST['u_mail'];
	if (empty($username)) {
		$msg = '<div class="alert alert-warning" role="alert">User Name Can\'t Be Empty</div>';
	}
	elseif (empty($email)) {
		$msg = '<div class="alert alert-warning" role="alert">Email Can\'t Be Empty</div>';
	}
	elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$msg = '<div class="alert alert-warning" role="alert">Enter Correct Email</div>';
	}
	else
	{
		$sql=mysqli_query($conn, "SELECT * FROM `users` WHERE `u_name` = '$username' OR `u_mail` = '$email'");
		if (mysqli_num_rows($sql) > 0 ) {
			if ($username == $user['u_name'] AND $email == $user['u_mail']) 
			{
				if ($_POST['u_pass'] != '' OR $_POST['cu_pass'] != '') 
				{
					if ($_POST['u_pass'] != $_POST['cu_pass']) 
					{
						$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Your Confirm Password</div>';
					}
					else
					{
						if (isset($_FILES['image'])) 
						{
							
						
						$password = md5($_POST['u_pass']);
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_pass` = '$password' , `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_pass` = '$password' , `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
					} /////////// end
				}
				else
				{
											if (isset($_FILES['image'])) 
						{
							
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
				}

			} ///end line 26 edit user by the same email and user name
			elseif($username != $user['u_name'] AND $email == $user['u_mail'])
			{
				$sql = mysqli_query($conn, "SELECT `u_name` FROM `users` WHERE `u_name` = '$username' ");
				if (mysqli_num_rows($sql) > 0) 
				{
					$msg = '<div class="alert alert-warning" role="alert">User Name Already Exists </div>';
				}
				else
				{


							if ($_POST['u_pass'] != '' OR $_POST['cu_pass'] != '') 
				{
					if ($_POST['u_pass'] != $_POST['cu_pass']) 
					{
						$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Your Confirm Password</div>';
					}
					else
					{
						if (isset($_FILES['image'])) 
						{
							
						
						$password = md5($_POST['u_pass']);
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_name` = '$username', `u_pass` = '$password' , `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_name` = '$username', `u_pass` = '$password' , `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
					} /////////// end
				}
				else
				{
											if (isset($_FILES['image'])) 
						{
							
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_name` = '$username', `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_name` = '$username', `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
				}





				}
			}
			elseif ($username == $user['u_name'] AND $email != $user['u_mail']) 
			{
				$sql = mysqli_query($conn, "SELECT `u_mail` FROM `users` WHERE `u_mail` = '$email' ");
				if (mysqli_num_rows($sql) > 0) 
				{
					$msg = '<div class="alert alert-warning" role="alert">Email Already Exists </div>';
				}
				else
				{


							if ($_POST['u_pass'] != '' OR $_POST['cu_pass'] != '') 
				{
					if ($_POST['u_pass'] != $_POST['cu_pass']) 
					{
						$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Your Confirm Password</div>';
					}
					else
					{
						if (isset($_FILES['image'])) 
						{
							
						
						$password = md5($_POST['u_pass']);
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_mail` = '$email', `u_pass` = '$password' , `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_mail` = '$email', `u_pass` = '$password' , `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
					} /////////// end
				}
				else
				{
											if (isset($_FILES['image'])) 
						{
							
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_mail` = '$email', `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_mail` = '$email', `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
				}





				}
			}
			else
			{
				$msg = '<div class="alert alert-warning" role="alert">Email OR User Name Is Already Reigisted</div>';
			}
		}
		else
		{
			// change name and email together and they not exicst in database
										if ($_POST['u_pass'] != '' OR $_POST['cu_pass'] != '') 
				{
					if ($_POST['u_pass'] != $_POST['cu_pass']) 
					{
						$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Your Confirm Password</div>';
					}
					else
					{
						if (isset($_FILES['image'])) 
						{
							
						
						$password = md5($_POST['u_pass']);
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_pass` = '$password' , `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_pass` = '$password' , `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
					} /////////// end
				}
				else
				{
											if (isset($_FILES['image'])) 
						{
							
						$image = $_FILES['image'] ;
						$image_name = $image['name'];
						$image_tmp = $image['tmp_name'];
						$image_size = $image['size'];
						$image_error = $image['error'];
						if ($image_name != '' ) 
						{
							$image_exe = explode('.', $image_name);
							$image_exe = strtolower(end($image_exe));


							$allowd = array ('gif' ,'png' , 'jpg' , 'jpeg');

							if (in_array($image_exe, $allowd)) 
							{
								if ($image_error == 0) 
								{
									if ($image_size <= 6000000) 
									{
										$new_name = uniqid('u_mail',false) . '.' . $image_exe;
										$image_dire = '../images/avatar/' .$new_name;
										$image_db = 'images/avatar/' . $new_name;
										if (move_uploaded_file($image_tmp, $image_dire)) 
										{
											$update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_avatar` = '$image_db' ,
											`isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
										}
										else
										{
											$msg = '<div class="alert alert-warning" role="alert">Something Happend According Transfer file</div>';
										}
									}
									else
									{
										$msg = '<div class="alert alert-warning" role="alert">Image Size Is Too Large Than 2MB</div>';
									}
									
								}
								else
									{
										$msg = '<div class="alert alert-warning" role="alert">Somthing Happend According Upload Photo</div>';
									}
							}
							else
							{
								$msg = '<div class="alert alert-warning" role="alert">Make Sure Your Password = Photo EXE Not Correct</div>';
							}
						}
						else
						{
							$update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `isadmain` = '$_POST[role]' WHERE `u_id` = '$id' ";
											$sql = mysqli_query($conn, $update_user);
											if (isset($sql))
											 {
												$msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
												echo '<meta http-equiv="refresh" content="3; \'arm.php\' "/>';
											}
						}
					}
				}
		}
	}
}
$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '$id'");
$user = mysqli_fetch_assoc($get_user);
?>

        <article class="col-lg-8">
                    <div class="panel panel-info">
                      <div class="panel-heading">Edit User Profile <?php echo $user['u_name']; ?> </div>
                      <div class="panel-body">
                               <div class="panel panel-default col-md-4">
  <div class="panel-body">
    <img src="../<?php echo $user['u_avatar']; ?>" width="100%">

      
  </div>
</div>

                        <form class="form-horizontal col-md-7" method="POST" action="" enctype="multipart/form-data" style="margin: 0 30px;">
            
              <div class="form-group">
              <label for="user" class="cols-sm-2 control-label"><span style="color: red">*</span>User Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="u_name" id="user"  placeholder="UserName" 
                  value="<?php echo $user['u_name']; ?>" />
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="mail" class="cols-sm-2 control-label"><span style="color: red">*</span>Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="u_mail" id="mail"  placeholder="Email"
                  value="<?php echo $user['u_mail']; ?>"/>
                </div>
              </div>
            </div>

          

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label"><span style="color: red">*</span>Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="u_pass" id="password"  placeholder="Password"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="cpassword" class="cols-sm-2 control-label"><span style="color: red">*</span>Confirm Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="cu_pass" id="cpassword"  placeholder="Confirm Password"/>
                </div>
              </div>
            </div>

                        <div class="form-group">
              <label for="u_avatar" class="cols-sm-2 control-label">Photo</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon btn-file"><i class="fa fa-camera fa-lg" aria-hidden="true"></i></span>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                     <span class="btn btn-default btn-file"><span>Choose Image Profile </span><input type="file" name="image" class="form-control" id="avatar" /></span>
    
                  </div>
                </div>
              </div>
            </div>

          <div class="form-group">
              <label  class="cols-sm-2 control-label" for="role">Role</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user-secret" aria-hidden="true"></i></span>
                  <select  type="text" class="form-control" name="role" id="role">
	      		<option value="user" <?php echo ($user['isadmain'] == 'user' ? 'selected' : '');?> >User</option>
	      		<option value="admin" <?php echo ($user['isadmain'] == 'admin' ? 'selected' : '');?> >Admin</option>
				  </select>
                </div>
              </div>
            </div>


           
            <?php echo '<strong style:"text-align:center;">'.$msg.'</strong>' ?>
            <div class="form-group ">
              <button type="submit" name="submit" class="btn btn-default btn-lg btn-block active ">
              Update Information</button>

            </div>
            
          </form>

 
                      </div>
                    </div>
        </article>
<?php
include_once("inc/footer.php");
?>