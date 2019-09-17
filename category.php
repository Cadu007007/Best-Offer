<?php 
include_once("include/header.php");

?>
<style type="text/css">
    	a{
  display: block;
  color: black;
  
}
.col-item
{
    border-bottom: 0px solid #E1E1E1;
    border-radius: 10px;
    background: #FFF;
}
.col-item:hover
{ 
  box-shadow: 0px 2px 5px -1px #000;
  -moz-box-shadow: 0px 2px 5px -1px #000;
  -webkit-box-shadow: 0px 2px 5px -1px #000;
  -webkit-border-radius: 0px;
  -moz-border-radius: 0px;
  border-radius: 10px;   
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;   
  border-bottom:0px solid #52A1D5;

      
}
.col-item .photo img
{
    margin: 0 auto;
    width: 100%;
    padding: 1px;
    border-radius: 10px 10px 0 0 ;
}

.col-item .info
{
    padding: 10px;
    border-radius: 0 0 5px 5px;
    margin-top: 1px;
}

.post-img-content
{
    height: 196px;
    position: relative;
}
.post-img-content img
{
    position: absolute;
    padding: 1px;
    border-radius: 10px 10px 0 0 ;
}
.post-title{
    display: table-cell;
    vertical-align: bottom;
    z-index: 2;
    position: relative;
}
.post-title b{
    background-color: rgba(51, 51, 51, 0.43);
    display: inline-block;
    margin-bottom: 5px;
    margin-left: 2px;
    color: #FFF;
    padding: 10px 15px;
    margin-top: 10px;
    font-size: 12px;
    border-radius: 7px;
}
.post-title b:first-child{
    font-size: 14px;
}


</style>
               <div class="blurred-container">
            <div class="img-src" style="background-image: url('images/bg.jpg');width: 100%; height: 550px;position: relative;"></div>
        </div>

<section>

  <div class="main" style="margin-bottom: 30px;">
    <div class="container">

    <div class="row">
    <br>
    <span class="separator">
        <nav class="navbar navbar-default" role="navigation" style="background-color: white; padding-top: 0px;">
            <div class="container-fluid">

                 <div class="navbar-header">
                   
                    <a class="navbar-brand " style="color: black; margin: 0px 0px; font-size: 15px; padding: 10px;" href="index.php"><p style="color: hsla(214, 60%, 44%,1); display: inline; font-size: 30px; font-weight: bold;">Best</p> Offer <span class="glyphicon glyphicon-stats"></span></a>
                   
                </div><!--/.navbar-header -->
                <div class="collapse navbar-collapse" id="navbar-admin">
                
                    <ul class="nav navbar-nav">
                                                <li><a href="category.php?category=<?php echo $setting['s_category_a']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_a'];?></a></li>
                        <li><a href="category.php?category=<?php echo $setting['s_category_b']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_b'];?></a></li>
                       <li><a href="category.php?category=<?php echo $setting['s_category_c']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_c'];?></a></li>
                        <li><a href="category.php?category=<?php echo $setting['s_category_d']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_d'];?></a></li>
                        <li><a href="category.php?category=<?php echo $setting['s_category_e']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_e'];?></a></li>
                        <li><a href="category.php?category=<?php echo $setting['s_category_f']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_f'];?></a></li>
                        <li><a href="category.php?category=<?php echo $setting['s_category_g']?>" style="color: black; margin: 20px 14px; font-size: 20px; font-weight: bold; "> <?php echo $setting['s_category_g'];?></a></li>

                       </ul>
      
               </div>
             </div><!--/.container-fluid -->
        </nav><!--/.navbar -->
        </span>
                <?php if(isset($_SESSION['u_id']))
        {

        ?>
        <a href="add_post.php" style="color: black; margin-left: 20px; font-size: 20px; font-weight: bold; " class="btn btn-primary btn-lg " ><b><i class="fa fa-plus" aria-hidden="true"></i> Add Post</b></a>
        <?php
        }
        ?>
    </div>
</div>

<div id="wrap">
          <div class="container" style="margin-top:50px;">
	<div class="row">
    <?php
       $per_page =$setting['s_posts_value'];
            if (!isset($_GET['page'])) 
            {
                $page = 1;
            }
            else
            {
                $page = (int)$_GET['page'];
            }
            $start_f = ($page-1) * $per_page;
$query = mysqli_query($conn, " SELECT * FROM `posts` p INNER JOIN `users` u WHERE p.p_author = u.u_id AND `p_category` = '$_GET[category]' ORDER BY `p_id` DESC LIMIT $start_f , $per_page" );
while ( $post = mysqli_fetch_assoc($query)) {
    # code...
?>
<!-- start-->
        
      	<div class="col-xs-12 col-sm-6 col-md-3" style="margin-top: 20px;">
      	<a  href="p_details.php?id=<?php echo $post['p_id']?>">
            <div class="col-item" >
                <div class="post-img-content" style="margin-bottom: 40px;">
                
                   <img src="<?php 
                    if($post['p_image'] != '')
                    {
                    echo $post['p_image'];
                  }else
                  {
                    echo 'images/no-image.png';
                  }

                     ?>" style=" width : 100%; height: 120%;" class="img-responsive" />
                    <div class="col-md-12">
                    <span class="post-title">
                        <b class="pull-left"><?php echo $post['p_title'];?></b>
                       
                     </span>
                     </div>
                    
                    
                </div>
                <div>
                <div class="info" >

                    <div class="row">
                    	<div class="col-md-12"></div>
                        
                        <div class="price col-md-6">

                          <h5><a style="text-decoration:none;" href="category.php?category=<?php echo $post['p_category'];?>"><b><?php echo $post['p_category']?></b></a></h5>
                           
                        </div>
                        <div class="hidden-sm col-md-6">
                            <h5 style="text-align: right; margin-top: 5px;"><a style="text-decoration:none;" href="profile.php?user=<?php echo $post['u_id']; ?>"><b ><?php echo $post['u_name']?></b></a></h5>

                        </div>
                        
                    </div>
                    <div class="separator clear-left">
                        
                        <p><h5 style="text-align: left;"><b>Date : </b><?php echo $post['p_date']?></h5></p>
                        
                       
                    </div>
                    <div class="clearfix">
                    </div>
                </div>
                </div>
            </div>
        </a>
        </div>
        
        <?php
} ?>
<!-- end-->

	</div>
</div>
        </div> <!-- /wrap -->  
        <?php

                           $page_sql = mysqli_query($conn, "SELECT * FROM 
 `posts` WHERE `p_category` = '$_GET[category]'");
                           $count_page = mysqli_num_rows($page_sql);
                           $total_page = ceil($count_page/$per_page); /// cail for make value int

                            ?>  
                            <nav class="text-center">
                            <ul class="pagination">
                            <?php 
                           for($i = 1 ; $i <= $total_page; $i++)
                           {
                            echo '<li '.($page==$i ? 'class="active"' : '').' ><a href="category.php?category='.$_GET['category'].'&page='.$i.'">'.$i.'</a></li>';
                           }

                           ?>
                               

                        </ul>
                      </nav>
 </div>

<?php include_once("include/footer.php"); ?>