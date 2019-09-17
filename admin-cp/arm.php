<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$msg = '';

if(isset($_GET['delete']))
{
	$sql= mysqli_query($conn, "DELETE FROM `users` WHERE `u_id` = '$_GET[delete]'");
	if (isset($sql)) {
		$msg = '<div class="alert alert-success" role="alert" style="text-align:center;">Delete Success</div>';
	}

}

?>

      <article class="col-lg-9">
      <div class="row">

      	<div class="col-md-12">
      	
      		
 					 <div class="panel panel-info">
                      <div class="panel-heading"> <strong>Users</strong></div>
                      <div class="panel-body">
        <table class="table table-hover">
        	<thead>
        	<tr>
        		<th>#</th>
        		<th>Profile pic</th>
        		<th>User Name</th>
        		<th>Email</th>
        		<th>Role</th>
        		<th>Profile</th>
        		<th>Edite Details</th>
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
        		$users = mysqli_query($conn," SELECT * FROM `users` ORDER BY `u_id` ASC LIMIT $start_f , $per_page");
        		$num = 1;
        		while ($user = mysqli_fetch_assoc($users)) 
        		{
        			echo 
        			'
            			<tr>
            			<td>'.$num.'</td>
            			<td><img src="../'.$user['u_avatar'].'" width="50px" /></td>
            			<td>'.$user['u_name'].' </td>
            			<td>'.$user['u_mail'].' </td>
            			<td>'.$user['isadmain'].' </td>
            			<td><a href = "../profile.php?user='.$user['u_id'].' " class="btn btn-primary btn-xs" target="_blank" /><i class="fa fa-info" aria-hidden="true"></i> </a></td>
            			<td><a href="edit_user.php?user='.$user['u_id'].'" class="btn btn-warning btn-xs" target="_blank"><i class="fa fa-edit " ></i></a></td>
            			<td><a href="arm.php?delete='.$user['u_id'].'&page='.$page.'" class="btn btn-danger btn-xs"><i class="fa fa-trash "></i></a></td>
            			</tr>
        			';
        		$num++;
        		}
        	 ?>
        		
        	</tbody>
        </table>
                                       <?php 
                               $page_sql = mysqli_query($conn, "SELECT * FROM `users`");
                               $count_page = mysqli_num_rows($page_sql);
                               $total_page = ceil($count_page/$per_page); /// cail for make value int
                                 echo $msg;
                                ?>  
                                <nav class="text-center">
                                <ul class="pagination">
                                <?php 
                               for($i = 1 ; $i <=$total_page; $i++)
                               {
                                echo '<li '.($page==$i ? 'class="active"' : '').' ><a href="arm.php?page='.$i.'">'.$i.'</a></li>';
                               }

                               ?>
                               

                        </ul>
                      </nav>

                      </div>
                    </div>
                   
                    

      	</div>

      </div>
                  
        </article>





<?php
include_once("inc/footer.php");
?>