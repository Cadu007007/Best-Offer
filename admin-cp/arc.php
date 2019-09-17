<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$msg = '';
$msg2 = '';

if (isset($_POST['add_category'])) 
{
	if (empty($_POST['category'])) 
	{
		$msg = '<div class="alert alert-warning" role="alert">Pleas Enter Category</div>';
	}
	else
		{
			$insert = mysqli_query($conn,"INSERT INTO `category` (`c_name`) VALUES ('$_POST[category]')");
			if(isset($insert))
			{
					$msg = '<div class="alert alert-success" role="alert" style="text-align:center;">Add Success</div>';
			}
		}
}
if (isset($_GET['delete'])) 
{
	$del_cat = mysqli_query($conn, "DELETE FROM `category` WHERE `c_id` = '$_GET[delete]'");
	if(isset($del_cat))
	{
		$msg2 = '<div class="alert alert-success" role="alert" style="text-align:center;">Delete Success</div>';
	}
}
?>

      <article class="col-lg-9">
      <div class="row">

      	<div class="col-md-8">
      	
      		
 					 <div class="panel panel-info">
                      <div class="panel-heading"> <strong>Edit / Remove Category</strong></div>
                      <div class="panel-body">
		                        <table class="table table-hover">
		                        	<thead>
		                        	<tr>
		                        		<th>#</th>
		                        		<th>Category Name</th>
		                        		<th>Edit</th>
		                        		<th>Delete</th>
		                        	</tr>
		                        	</thead>
		                        	<tbody>
		                        	<?php 
		                        		$cat= mysqli_query($conn," SELECT * FROM `category` ORDER BY `c_id` DESC ");
		                        		$num = 1;
		                        		while ($category = mysqli_fetch_assoc($cat)) 
		                        		{
		                        			echo 
		                        			'
			                        			<tr>
			                        			<td>'.$num.'</td>
			                        			<td>'.$category['c_name'].'</td>
			                        			<td><a href="edit_cat.php?cate='.$category['c_id'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit "></i></a></td>
			                        			<td><a href="arc.php?delete='.$category['c_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i></a></td>
			                        			</tr>
		                        			';
		                        		$num++;
		                        		}
		                        	 ?>
		                        		
		                        	</tbody>
		                        </table>

                      </div>
                    </div>
                    <?php echo $msg2; ?>

      	</div>
      	<div class="col-md-4">
      		
 					 <div class="panel panel-info">
                      <div class="panel-heading"><strong> Add New Category</strong> </div>
                      <div class="panel-body">
                        
							<form class="form-horizontal" method="POST" action="">
							  <div class="form-group">
							    <label for="category" class="col-sm-3 control-label" style="text-align: left;">New Category</label>
							    <div class="col-sm-8">
							      <input type="text" name="category" class="form-control" id="category" placeholder="Category Name">
							    </div>
							  </div>
							 
							  
							  <hr>
							  <div class="form-group">
							  
							    <div class="col-sm-offset-3 col-sm-9">
							    <?php echo $msg; ?>
							      <input   type="submit" class="btn btn-primary" name="add_category" value="Add Category">
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