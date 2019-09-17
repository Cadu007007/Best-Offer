<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$msg='';

if (isset($_POST['submit']))
{
	$select_setting = mysqli_query($conn,"SELECT * FROM `setting`");
	if (mysqli_num_rows($select_setting) !=1) 
	{
		//insert
				$insert = mysqli_query($conn, "INSERT INTO `setting` (`s_category_a` ,`s_category_b` ,`s_category_c` ,`s_category_d` ,`s_category_e` ,`s_category_f` ,`s_category_g` ,`s_posts`,`s_posts_value`) VALUES ('$_POST[Category1]','$_POST[Category2]','$_POST[Category3]','$_POST[Category4]','$_POST[Category5]','$_POST[Category6]','$_POST[Category7]','$_POST[post]','$_POST[posts]')");
								if (isset($insert)) 
								{
									$msg= '<div class="alert alert-success" role="alert" style="text-align:center;">Update Success</div>';
												echo '<meta http-equiv="refresh" content="3; \'setting.php\' "/>';
								}
								else
								{
									$msg= '<div class="alert alert-danger" role="alert" style="text-align:center;">Something Wrong Happend</div>';
								}

	}
	else
	{
		//update
		$insert = mysqli_query($conn, "UPDATE `setting` SET  `s_category_a` = '$_POST[Category1]' , `s_category_b` = '$_POST[Category2]' , `s_category_c` = '$_POST[Category3]' , `s_category_d` = '$_POST[Category4]' , `s_category_e` ='$_POST[Category5]' ,`s_category_f` = '$_POST[Category6]' ,`s_category_g` = '$_POST[Category7]' ,`s_posts` = '$_POST[post]',`s_posts_value` = '$_POST[posts]' ");
								if (isset($insert)) 
								{
									$msg= '<div class="alert alert-success" role="alert" style="text-align:center;">Update Success</div>';
												echo '<meta http-equiv="refresh" content="3; \'setting.php\' "/>';
								}
								else
								{
									$msg= '<div class="alert alert-danger" role="alert" style="text-align:center;">Something Wrong Happend</div>';
								}
	}
}

$s_setting = mysqli_query($conn ," SELECT * FROM`setting`" );
$setting = mysqli_fetch_assoc($s_setting);

function category($x)
{
	global $conn;
	$category = mysqli_query($conn, "SELECT * FROM `category`");
	while ($cate = mysqli_fetch_assoc($category)) 
	{
		echo '<option value="'.$cate['c_name'].'" '.($x == $cate['c_name'] ? 'selected' : '').'>'.$cate['c_name'].'</option>';
	}
}
?>

        <article class="col-lg-9">
                    <div class="panel panel-info">
                      <div class="panel-heading"><b>Setting</b></div>
                      <div class="panel-body">
	                      	    <form class="form-horizontal" action="" method="post">
								    <div class="form-group">
								    <label for="Category1" class="col-sm-2 control-label">Category1</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category1" id="Category1">
								      	<?php category($setting['s_category_a']); ?>
								      </select>
								    </div>
								  </div>
	  							 <div class="form-group">
								    <label for="Category2" class="col-sm-2 control-label">Category2</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category2" id="Category2">
								      	<?php category($setting['s_category_b']); ?>
								      </select>
								    </div>
								  </div>
								    <div class="form-group">
								    <label for="Category3" class="col-sm-2 control-label">Category3</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category3" id="Category3">
								      	<?php category($setting['s_category_c']); ?>
								      </select>
								    </div>
								  </div>
  								 <div class="form-group">
								    <label for="Category4" class="col-sm-2 control-label">Category4</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category4" id="Category4">
								      	<?php category($setting['s_category_d']); ?>
								      </select>
								    </div>
								  </div>
								    <div class="form-group">
								    <label for="Category5" class="col-sm-2 control-label">Category5</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category5" id="Category5">
								      	<?php category($setting['s_category_e']); ?>
								      </select>
								    </div>
								  </div>
								   <div class="form-group">
								    <label for="Category6" class="col-sm-2 control-label">Category6</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category6" id="Category6">
								      	<?php category($setting['s_category_f']); ?>
								      </select>
								    </div>
								  </div>
								    <div class="form-group">
								    <label for="Category7" class="col-sm-2 control-label">Category7</label>
								    <div class="col-sm-10">
								      <select class="form-control" name="Category7" id="Category7">
								      	<?php category($setting['s_category_g']); ?>
								      </select>
								    </div>
								  </div>
								     <div class="form-group">
								    <label for="poste" class="col-sm-2 control-label">Posts</label>
								    <div class="col-sm-8">
								      <input type="text" name="post" class="form-control" id="post" value="<?php echo ($setting['s_posts'] == '' ? '' : $setting['s_posts']); ?> ">
								    </div>
								    <div class="col-sm-2">
								      <input type="number" name="posts" class="form-control" id="posts" min="16" max="40" value="<?php echo($setting['s_posts_value'] == ''?'16' : $setting['s_posts_value']); ?>">
								    </div>
								  </div>
								  <?php echo $msg; ?>
								  <div class="form-group">
								    <div class="col-sm-offset-2 col-sm-10">
								      <button type="submit" name="submit" class="btn btn-default">Submit</button>
								    </div>
								  </div>
								</form>
                      </div>
                    </div>
        </article>
<?php
include_once("inc/footer.php");
?>