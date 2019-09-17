<?php
include_once("include/header.php");

$query = mysqli_query($conn , "SELECT * FROM `posts` p INNER JOIN `users` u WHERE p.p_author = u.u_id AND `p_id` = '$_GET[id]'");
$post = mysqli_fetch_assoc($query);
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
    background: #dedede;
    height: 90px;
    -webkit-box-shadow: inset 0px 4px 12px 0px rgba(50, 50, 50, 0.75);
    -moz-box-shadow:    inset 0px 4px 12px 0px rgba(50, 50, 50, 0.75);
    box-shadow:         inset 0px 4px 12px 0px rgba(50, 50, 50, 0.75);
}

.main-body {
    background: #ffffff;
    -webkit-box-shadow: 0px -4px 14px 0px rgba(50, 50, 50, 0.35);
    -moz-box-shadow:    0px -4px 14px 0px rgba(50, 50, 50, 0.35);
    box-shadow:         0px -4px 14px 0px rgba(50, 50, 50, 0.35);
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
    min-height: 600px;
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
                <?php
                if ($_SESSION['isadmain'] == 'admin') {
                   
                   ?>
                <div style=" float: left;  margin-left:5px;">
                    <a href="admin-cp/edit_post.php?post=<?php echo $post['p_id']; ?>" style="color: blue; font-size: 24px;" > <span class="fa fa-pencil" ></span></a>
                    </div>
                
                    <?php
                    }
                ?>
                    <div class="content-description">
                        
                       
                        
                      
                       
                        
                        <div class="author-avatar">

                            <a href="profile.php?user=<?php echo $post['u_id']; ?>" ><img src="<?php echo $post['u_avatar']; ?>" class="img-circle" style="" /></a>
                        </div>

                        <div class="author-name">
                            <h3><a style="text-decoration : none; color: #777;" href="profile.php?user=<?php echo $post['u_id']; ?>"><?php echo $post['u_name'];?></a></h3>
                        </div>
                        <div class="row blog-info">
                            <div class="col-xs-12 col-sm-6">
                                <span class="lead text-muted"><i class="fa fa-clock-o"></i> <?php echo $post['p_date'];?></span>
                            </div>
                            <div class="col-xs-12 col-sm-6">
                                <span class="lead text-muted"><i class="fa fa-tags"></i> <a style="color: #777; text-decoration: none;" href="category.php?category=<?php echo $post['p_category']; ?>"><?php echo $post['p_category'];?></a></span>
                            </div>
                        </div>

                        
                    </div>
                    
                    <div class="content-body">
                				<h1 style="color: #777; text-align: center;"><?php echo $post['p_title'];?></h1>
                            <blockquote style="text-align: center;">
                            <img src="<?php 
                    if($post['p_image'] != '')
                    {
                    echo $post['p_image'];
                  }else
                  {
                    echo 'images/no-image.png';
                  }

                     ?>" style="width: 70%; height:70%;" class="img-rounded"> </br>
                                <?php echo $post['p_post'];?>
                            </blockquote>
                      
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