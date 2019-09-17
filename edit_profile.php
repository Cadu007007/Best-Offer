<?php
include_once("include/header.php");
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
                                            $update_user = "UPDATE `users` SET `u_pass` = '$password' , `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='.$user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_pass` = '$password' ,  WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                             WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_pass` = '$password' , `u_avatar` = '$image_db'
                                             WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_pass` = '$password' ,  WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                             WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username',  WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                             WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_mail` = '$email', `u_pass` = '$password'  WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_mail` = '$email', `u_avatar` = '$image_db'
                                             WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_mail` = '$email' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_pass` = '$password' , `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_pass` = '$password' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_avatar` = '$image_db'  WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
                                            }
                        }
                    }
                }
        }
    }
}
$get_user = mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '$id'");
$user = mysqli_fetch_assoc($get_user);$id = intval($_GET['user']);
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
                                            $update_user = "UPDATE `users` SET `u_pass` = '$password' , `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_pass` = '$password' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_pass` = '$password' , `u_avatar` = '$image_db'
                                             WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_pass` = '$password' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_mail` = '$email', `u_pass` = '$password' , `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_mail` = '$email', `u_pass` = '$password' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_mail` = '$email', `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_mail` = '$email' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_pass` = '$password' , `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_pass` = '$password' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email', `u_avatar` = '$image_db' WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
                            $update_user = "UPDATE `users` SET `u_name` = '$username', `u_mail` = '$email',  WHERE `u_id` = '$id' ";
                                            $sql = mysqli_query($conn, $update_user);
                                            if (isset($sql))
                                             {
                                                $msg = '<div class="alert alert-success" role="alert">Update User Infos Success </div>';
                                                echo '<meta http-equiv="refresh" content="3; \'profile.php?user='. $user['u_id'].'\' "/>';
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
<style type="">
	
header {
    margin-top: 0;
    background: url("images/bg.jpg");
    min-height: 500px;
    background-size: cover;
    display: table;
    width: 100%;

}

header img
{
    position: relative;
}
header h1 {
    text-align: center;
    color: #fff;
    display: table-cell;
    vertical-align: middle;
    font-size: 3em;
    text-shadow: 2px 3px rgba(0,0,0,0.75);
}

.background-bar {
    
    -webkit-box-shadow: inset 0px 4px 12px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    inset 0px 4px 12px 0px rgba(50, 50, 50, 0.75);
    box-shadow:         inset 0px 4px 12px 0px rgba(50, 50, 50, 0.75);
}

.main-body {
        
    -webkit-box-shadow: 0px -4px 14px 0px rgba(50, 50, 50, 0.35);
    -moz-box-shadow:    0px -4px 14px 0px rgba(50, 50, 50, 0.35);
    box-shadow:         0px -4px 14px 0px rgba(50, 50, 50, 0.35);
    margin-bottom: 10px;
}

.content-holder {
    margin-top: -140px;
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    padding: 2px;
}

.content-description {
    border-top-left-radius: 12px;
    border-top-right-radius: 12px;
    background: #fff;
    height: 130px;
    padding: 10px;
    -webkit-box-shadow: 0px 0px 12px 4px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 12px 4px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 12px 4px rgba(50, 50, 50, 0.75);
}

.author-social {
    position: absolute;
    margin-top: -35px;
}
.author-social-left {
    left : 0;
    width: 40%;
    text-align: right;
}
.author-social-right {
    right : 0;
    width: 40%;
}
.author-social img {
    background: #e8e8e8;
    border-radius: 50%;
    border: 2px solid #e8e8e8;
}

.author-avatar {
    text-align:center;
    margin-top: -70px;
}
.author-avatar img {
    width: 100px;
    border: 4px solid #e8e8e8;
    -webkit-box-shadow: 0px 0px 12px 4px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    0px 0px 12px 4px rgba(50, 50, 50, 0.75);
    box-shadow:         0px 0px 12px 4px rgba(50, 50, 50, 0.75);
}
.author-name {
    text-align:center;
}
.blog-info {
    text-align: center;
}

.content-body {
    background: #fff;
    min-height: 700px;
    padding: 40px 5px;
    font-size: 1.2em;
    color: #303030;
}

@media(max-width:768px){
    header {
        min-height: 300px;
    }
    .author-avatar {
        margin-top: -50px;
    }
	.author-avatar img {
	    width: 75px;
	}
	.author-name h3 {
	    font-size: 1.2em;
	}
	.author-social {
	    margin-top: -25px;
	}
	.author-social img {
	    width: 32px;
	}
}
</style>
<article>
    
    <header>
        
        
        
    </header>
    
    <div class="background-bar">
        
    </div>
    
    <section class="container-fluid main-body">
        <section class="row">
            
            <div class="hidden-xs col-sm-1 col-md-2">
                
            </div>
            
            <div class="col-xs-12 col-sm-10 col-md-8">
            
                <div class="content-holder">
                    
                    <div class="content-description">
                        
                        
                        
                       
                        
                        <div class="author-avatar">
                            <img src="<?php echo $user['u_avatar']; ?>" class="img-circle" />
           
                        </div>
                    </div>
                    <div class="col-md-3">
                        <a href="profile.php?user=<?php echo $user['u_id']?> " style="text-decoration: none; color:black;  display:block;"> <strong style="font-size: 24px; padding: 40px;"><i class="fa fa-cog"></i>Profile</strong> </a>
                    </div>
                    
                        
                    

                    
                    <div class="content-body">

                            <blockquote >
                          </br>
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
              <label for="password" class="cols-sm-2 control-label"><span style="color: red">*</span>New Password</label>
              <div class="cols-sm-10">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-lock fa-lg" aria-hidden="true"></i></span>
                  <input type="password" class="form-control" name="u_pass" id="password"  placeholder="Password"/>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label for="cpassword" class="cols-sm-2 control-label"><span style="color: red">*</span>Confirm New Password</label>
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




           
            <?php echo '<strong style:"text-align:center;">'.$msg.'</strong>' ?>
            <div class="form-group ">
              <button type="submit" name="submit" class="btn btn-default btn-lg btn-block active ">
              Update Information</button>

            </div>
            
          </form>
                            </blockquote>
                       <div class="col-md-12">
               <div class="row">
               

                </div>
                </div>



                    
                    </div>
                    
                </div>
            
            </div>
            
            <div class="hidden-xs col-sm-1 col-md-2">
                
            </div>
            
        </section>
    </section>
    
</article>
                       
 
                     
<?php
include_once("include/footer.php");
?>