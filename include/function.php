<?php


function register()
{
	if(isset($_SESSION['u_id']))
	{
		echo '<div class="alert alert-danger" role="alert"> Sorry '.$_SESSION['u_name'].' You Already Registed</div>';
	}

else
{
	echo 
	'
		<form class="form-horizontal" method="post" action="include/regis.php" id="register">
            
              <div class="form-group">
              <label for="user" class="cols-sm-2 control-label"><span style="color: red">*</span>User Name</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="u_name" id="user"  placeholder="UserName"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="mail" class="cols-sm-2 control-label"><span style="color: red">*</span>Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-envelope fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="u_mail" id="mail"  placeholder="Email"/>
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
              <label for="avatar" class="cols-sm-2 control-label">Photo</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon btn-file"><i class="fa fa-camera fa-lg" aria-hidden="true"></i></span>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                     <span class="btn btn-default btn-file"><span>Choose Image Profile </span><input type="file" name="image" class="form-control" id="avatar" /></span>
    
                  </div>
                </div>
              </div>
            </div>


            <div class="text-center">
              <div id="result">
                
              </div>
            </div>

            <div class="form-group ">
              <button type="submit" name="submit" class="btn btn-default btn-lg btn-block active ">Register</button>

            </div>
            <div style="margin-top: 10px; text-align: center;">
                    <a href="login.php">Login</a>
                 </div>
          </form>
	';
}

}

function login_area()
{
if(isset($_SESSION['u_id']))
  {
    echo '<div class="page-header">
  <center> <img src="'.$_SESSION['u_avatar'].'" width="100" hight="100" class="img-circle" > </BR> </center>
</div>'
;
echo '<div class="alert alert-danger" role="alert"> Sorry '.$_SESSION['u_name'].' You Already Loged in</div>';
  }

else
{
	echo 
	'
	<form class="form-horizontal" method="post" action="include/log.php" id="login">
            
              <div class="form-group">
              <label for="name" class="cols-sm-2 control-label">User Name Or Email</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-user fa" aria-hidden="true"></i></span>
                  <input type="text" class="form-control" name="u_name" id="user"  placeholder="UserName Or Email"/>
                </div>
              </div>
            </div>

        

          

            <div class="form-group">
              <label for="password" class="cols-sm-2 control-label">Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="u_pass" id="password"  placeholder="Password"/>
                </div>
              </div>
            </div>

                            <div id="remember" class="checkbox">
                    <label>
                        <input type="checkbox" name="rememberme"value="remember-me"> Remember me
                    </label>
                </div>

                  <div class="text-center">
              <div id="log_result"">
                
              </div>
            </div>

            <div class="form-group ">
              <button type="submit" name="login" class="btn btn-primary btn-lg btn-block login-button">Login</button>
            </div>

          </form>
                 <a href="#" class="forgot-password">
                Forgot the password
                </a>
                <div style="margin-top: 10px; text-align: center;">
                    <a href="register.php">Register</a>
                 </div>
	';
}
}

function logg()
{
  if(!isset($_SESSION['u_id']))
  {
    echo ' 
					<li>
                        <a href="register.php"  class="hidden-xs">
                            <i class="pe-7s-add-user"></i>
                            <p>Register</p>
                        </a>
                    </li>
                    
                    <li>
                        <a href="login.php"  class="hidden-xs">
                            <i class="pe-7s-user"></i>
                            <p>login</p>
                        </a>
                    </li>
    ';

  }
  else
  {
    global $conn;
$user_inf= mysqli_query($conn, " SELECT * FROM `users` WHERE `u_id`= '$_SESSION[u_id]' " );

          $u = mysqli_fetch_assoc($user_inf);

    if($_SESSION['isadmain'] == 'admin')
        {
          
         echo 					'
                                        <li class="dropdown">
                          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="'.$u['u_avatar'].'" style="width:35px; height:35px;" class="img-circle" >
                        <p>'.$u['u_name'].'</p>
                    </a>
                          <ul class="dropdown-menu">
                          <li><a href="admin-cp/index.php"><b><i class="fa fa-cog" aria-hidden="true"></i> Admin Panel</b></a></li>
                          <li><a href="profile.php?user='.$u['u_id'].'"><b><i class="fa fa-user" aria-hidden="true"></i> Profile</b></a></li>

                            <li><a href="edit_profile.php?user='.$u['u_id'].'"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit Profile</b></a></li>
                            <li><a href="add_post.php"><b><i class="fa fa-plus" aria-hidden="true"></i> Add Post</b></a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php?id=<?php '.$u['u_id'].';?>"><b><i class="fa fa-power-off" aria-hidden="true"></i> Logout</b></a></li>
                          </ul>
                    </li>
                    </ul>';
        }
        else
        {
              echo'
          <li>

            <li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="'.$u['u_avatar'].'" style="width:35px; height:35px;" class="img-circle" >
                        <p>'.$u['u_name'].'</p>
                    </a>
                  <ul class="dropdown-menu">
                    
                          <li><a href="profile.php?user='.$u['u_id'].'"><b><i class="fa fa-user" aria-hidden="true"></i> Profile</b></a></li>

                            <li><a href="edit_profile.php?user='.$u['u_id'].'"><b><i class="fa fa-edit" aria-hidden="true"></i> Edit Profile</b></a></li>
                            <li><a href="add_post.php"><b><i class="fa fa-plus" aria-hidden="true"></i> Add Post</b></a></li>
                            <li class="divider"></li>
                            <li><a href="logout.php?id=<?php '.$u['u_id'].';?>"><b><i class="fa fa-power-off" aria-hidden="true"></i> Logout</b></a></li>
                  </ul>
            </li>';
        }
        

  }

}
                   


?>