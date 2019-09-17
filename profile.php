<?php
include_once("include/header.php");
$id = (int)$_GET['user'];


$user_info= mysqli_query($conn, "SELECT * FROM `users` WHERE `u_id`= '$id' ");
if (mysqli_num_rows($user_info) != 1)
{
    header("Location: index.php");
}
$u = mysqli_fetch_assoc($user_info);
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
    min-height: 1400px;
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
                            <img src="<?php echo $u['u_avatar']; ?>" class="img-circle" />
           
                        </div>
                    </div>
                        <div class="col-md-3">
                            <?php 
                                if(isset($_SESSION['u_id']) && $u['u_id'] == $_SESSION['u_id'])
                                {
                                    ?>
                                  <a href="edit_profile.php?user=<?php echo $u['u_id']?> " style="text-decoration: none; color:black;  display:block;"> <strong style="font-size: 24px; padding: 10px;"><i class="fa fa-cog"></i>Edit Profile</strong> </a>
                               <?php
                           }
                           ?>
                                

                                
                        </div>
                        
                    

                    
                    <div class="content-body">

                            <blockquote >
                          </br>
                          <p style="font-size: 18px;"><strong style="font-size: 24px;">User Name : </strong><?php echo $u['u_name']; ?></p>
                                <p style="font-size: 18px;"><strong style="font-size: 24px;">Email : </strong><?php echo $u['u_mail']; ?></p>
                                <p style="font-size: 18px;"><strong style="font-size: 24px;">Register Date : </strong><?php echo $u['reg_date']; ?></p>
                            </blockquote>
                       <div class="col-md-12">
               <div class="row">
               
               <div class="col-md-12">
                <div class="panel" style="color: #372c2c;  border-color: silver;">
                                        <div class="panel panel-heading" style="background-color: #2a71ae;"><b><?php echo $u['u_name'];?> Posts</b> </div>
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

                                        $posts= mysqli_query($conn," SELECT * FROM `posts` WHERE p_author = '$_GET[user]' ORDER BY `p_id` DESC LIMIT $start_f , $per_page");
                                        $num = 1;
                                        while ($post = mysqli_fetch_assoc($posts)) 
                                        {
                                            echo 
                                            '
                                                <tr>
                                                <td>'.$num.'</td>
                                                <td style="height:100px;"><img src="'.($post['p_image'] == '' ? 'images/no-image.png' : $post['p_image'] ).'" class="img_rounded" width=100px; </td>
                                                <td>'.$post['p_title'].'</td>
                                                <td>'.$post['p_category'].'</td>
                                                <td>'.$post['p_date'].'</td>
                                                <td><a href="p_details.php?id='.$post['p_id'].'" class="btn btn-primary btn-xs" target="_blank"> View</a></td>
                                                
                                                </tr>
                                            ';
                                        $num++;
                                        }
                                     ?>

                                        
                                    </tbody>
                                </table>
                                <?php 
                                
                                ?>
                               <?php 
                               $page_sql = mysqli_query($conn, "SELECT * FROM `posts` WHERE p_author = '$_GET[user]' ");
                               $count_page = mysqli_num_rows($page_sql);
                               $total_page = ceil($count_page/$per_page); /// cail for make value int
                                 
                                ?>  
                                <nav class="text-center">
                                <ul class="pagination">
                                <?php 
                               for($i = 1 ; $i <=$total_page; $i++)
                               {
                                echo '<li '.($page==$i ? 'class="active"' : '').' ><a href="profile.php?user='.$_GET['user'].'&page='.$i.'">'.$i.'</a></li>';
                               }

                               ?>
                               

                        </ul>
                      </nav>
                </div>
                </div>
                </div>
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