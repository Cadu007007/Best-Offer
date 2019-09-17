<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$msg='';

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
                    <div class="panel panel-info">
                      <div class="panel-heading">Panel heading </div>
                      <div class="panel-body">
                        <table class="table table-hover">
		                        	<thead>
		                        	<tr>
		                        		<th>#</th>
		                        		<th>Photo</th>
		                        		<th>Title</th>
		                        		<th>Category</th>
		                        		<th>Author</th>
		                        		<th>Date</th>
		                        		<th>View Post</th>
		                        		<th>Edit</th>
		                        		<th>Delete</th>
		                        	</tr>
		                        	</thead>
		                        	<tbody>
		                        	<?php 

		                        	$per_page =3;
		                        	if (!isset($_GET['page'])) 
		                        	{
		                        		$page = 1;
		                        	}
		                        	else
		                        	{
		                        		$page = (int)$_GET['page'];
		                        	}
		                        	$start_f = ($page-1) * $per_page;


		                        		$posts= mysqli_query($conn," SELECT * FROM `posts` p INNER JOIN `users` u WHERE p.p_author = u.u_id ORDER BY `p_id` DESC LIMIT $start_f , $per_page ");
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
			                        			<td>'.$post['u_name'].'</td>
			                        			<td>'.$post['p_date'].'</td>
			                        			<td><a href="../p_details.php?id='.$post['p_id'].'" class="btn btn-primary btn-xs" target="_blank"> View</a></td>
			                        			<td><a  href="edit_post.php?post='.$post['p_id'].'" class="btn btn-warning btn-xs"><i class="fa fa-edit "></i></a></td>
			                        			<td><a href="p.php?delete='.$post['p_id'].'&page='.$page.'" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i></a></td>
			                        			</tr>
		                        			';
		                        		$num++;
		                        		}
		                        	 ?>

		                        		
		                        	</tbody>
		                        </table>
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
		                       	echo '<li '.($page==$i ? 'class="active"' : '').' ><a href="p.php?page='.$i.'">'.$i.'</a></li>';
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