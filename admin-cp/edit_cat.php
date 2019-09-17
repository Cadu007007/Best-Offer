<?php
ob_start();
include_once("inc/header.php");
include_once("inc/aside.php");
$msg ='';

if(isset($_GET['cate']))
{
	$sql = mysqli_query($conn,"SELECT * FROM `category` WHERE `c_id` = '$_GET[cate]'");
	$cate =mysqli_fetch_assoc($sql);
}
if(isset($_POST['add_category']))
{
	if(empty($_POST['category']))
	{
		$msg = '<div class="alert alert-danger" role="alert" style="text-align:center;">Pleas Enter New Category Name</div>';
	}
	else
	{
		$sql = mysqli_query($conn," UPDATE `category` SET `c_name` = '$_POST[category]' WHERE `c_id` = '$_GET[cate]' ");
	if(isset($sql))
	{
		header("Location: arc.php");
	}
	}
}
?>

      <article class="col-lg-9">
      <div class="row">

      	<div class="col-md-4">
      		
 					 <div class="panel panel-info">
                      <div class="panel-heading"><i class="fa fa-edit "></i> Edit Category :: <?php echo $cate['c_name']; ?> </div>
                      <div class="panel-body">
                        
							<form class="form-horizontal" method="POST" action="">
							  <div class="form-group">
							    <label for="category" class="col-sm-3 control-label" style="text-align: left;"> Category Name</label>
							    <div class="col-sm-8">
							      <input type="text" name="category" class="form-control" value="<?php echo $cate['c_name']; ?>" id="category" placeholder="Enter New Category Name">
							    </div>
							  </div>
							 
							  
							  <hr>
							  <div class="form-group">
							  <?php      echo $msg;             ?>
							  
							    <div class="col-sm-offset-3 col-sm-9">
							    
							      <input   type="submit" class="btn btn-primary" name="add_category" value="Edit Category">
							    </div>
							  </div>
							</form>

                      </div>
                    </div>

      	</div>
      </div>
                  
        </article>





<?php
include_once("inc/footer.php");
?>