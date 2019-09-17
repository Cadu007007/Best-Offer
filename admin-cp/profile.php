<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$msg='';
$get_user= mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id` = '$_SESSION[u_id]'");
$user = mysqli_fetch_object($get_user);
if (isset($_GET['delete']))
{
	$sql = mysqli_query($conn, "DELETE FROM `posts` WHERE `p_id` = '$_GET[delete]'");
	if(isset($sql))
	{
		$msg = '<div class="alert alert-success" role="alert" style="text-align:center;">Delete Success</div>';
	}
}
?>

        <article class="col-lg-9">
               <div class="col-md-1"> </div>
               <div class="col-md-10"> 
               
               	 <div class="panel panel-info">
                      <div class="panel-heading"><b>Hello </b><?php echo $user->u_name; ?> </div>
                      <div class="panel-body">
                      <div class="col-md-3">
                        <img src="../<?php echo $user->u_avatar; ?>" class="img-thumbnail" width="100%">
                        </div>
                      
                        <div class="col-md-9">
                        	<p><b>User name : </b> <?php echo $user->u_name; ?></p>
                        	<p><b>Email </b> <?php echo $user->u_mail; ?> </p>
                        	<p><b>Register date </b><?php echo $user->reg_date; ?></p>

                        </div>
                        <div class="col-md-3">
                        	<hr>
                        	<p><a href="edit_user.php?user=<?php echo $user->u_id; ?>" class="btn btn-primary "> Edit Profile</a></p>
                        </div>
</div>
                    </div>
               
               </div>
               <div class="col-md-12">
               <div class="row">
               <div class="col-md-1"> </div>
               <div class="col-md-10">
               	<div class="panel panel-danger">
               		<div class="panel panel-heading"><b>Your Posts</b> </div>
               		<div class="panel-body">
               			                        <table class="table table-hover">
		                        	<thead>
		                        	<tr>
		                        		<th>#</th>
		                        		<th>Photo</th>
		                        		<th>Title</th>
		                        		<th>Category</th>
		                        		<th>Date</th>
		                        		<th>View Post</th>
		                        		<th>Edit</th>
		                        		<th>Delete</th>
		                        	</tr>
		                        	</thead>
		                        	<tbody>
		                        	<?php 
		                        	     	$per_page =8;
		                        	if (!isset($_GET['page'])) 
		                        	{
		                        		$page = 1;
		                        	}
		                        	else
		                        	{
		                        		$page = (int)$_GET['page'];
		                        	}
		                        	$start_f = ($page-1) * $per_page;

		                        		$posts= mysqli_query($conn," SELECT * FROM `posts` WHERE p_author = '$_SESSION[u_id]' ORDER BY `p_id` DESC LIMIT $start_f , $per_page");
		                        		$num = 1;
		                        		while ($post = mysqli_fetch_assoc($posts)) 
		                        		{
		                        			echo 
		                        			'
			                        			<tr>
			                        			<td>'.$num.'</td>
			                        			<td><img src="../'.($post['p_image'] == '' ? 'images/no-image.png' : $post['p_image'] ).'" class="img_rounded" width=100px;</td>
			                        			<td>'.$post['p_title'].'</td>
			                        			<td>'.$post['p_category'].'</td>
			                        			<td>'.$post['p_date'].'</td>
			                        			<td><a href="../p_details.php?id='.$post['p_id'].'" class="btn btn-primary btn-xs" target="_blank"> View</a></td>
			                        			<td><a  href="edit_post.php?post='.$post['p_id'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit "></i></a></td>
			                        			<td><a href="profile.php?delete='.$post['p_id'].'" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i></a></td>
			                        			</tr>
		                        			';
		                        		$num++;
		                        		}
		                        	 ?>

		                        		
		                        	</tbody>
		                        </table>
		                        <?php 
		                        echo $msg;
		                        ?>
 		                       <?php 
		                       $page_sql = mysqli_query($conn, "SELECT * FROM `posts`");
		                       $count_page = mysqli_num_rows($page_sql);
		                       $total_page = ceil($count_page/$per_page); /// cail for make value int
								 echo $msg;
								?>	
								<nav class="text-center">
		                      	<ul class="pagination">
		                      	<?php 
		                       for($i = 1 ; $i <=$total_page; $i++)
		                       {
		                       	echo '<li '.($page==$i ? 'class="active"' : '').' ><a href="profile.php?page='.$i.'">'.$i.'</a></li>';
		                       }

		                       ?>
		                       

                      	</ul>
                      </nav>
               	</div>
               </div>
        </article>
<?php
include_once("inc/footer.php");
?>