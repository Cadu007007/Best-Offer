<?php

include_once("inc/header.php");
include_once("inc/aside.php");
$msg = '';
$category= '';

if (isset($_POST['add_post']))
{	
	$title =strip_tags( $_POST['title']);
	$post = $_POST['post'];
	$category = $_POST['category'];

	if(empty($title))
	{
		$msg = '<div class="alert alert-danger" role="alert" style="text-align:center;">Pleas Enter Post Title</div>';

	}
	elseif (empty($post)) 
	{
		$msg = '<div class="alert alert-danger" role="alert" style="text-align:center;">Pleas Enter Post Details</div>';
	}
	elseif (empty($category)) {
		$msg = '<div class="alert alert-danger" role="alert" style="text-align:center;">Pleas Enter Post Category</div>';
	}
	else
	{
		
			$image = $_FILES['image'];
				$image_name = $image['name'];
				$image_tmp = $image['tmp_name'];
				$image_size = $image['size'];
				$image_error = $image['error'];
				if ($image_name !='' )
				{
				$image_exe = explode('.',$image_name);
				$image_exe = strtolower(end($image_exe));

				$allowd =array('png','gif','jpg','jepg');
				if (in_array($image_exe, $allowd)) 
				{
					if($image_error === 0)
					{
						if($image_size <= 16000000)
						{
							$new_name = uniqid('p_post',false) .'.' .$image_exe;
							$image_dir = '../images/post/' . $new_name ;
							$image_db = 'images/post/'.$new_name;
							if (move_uploaded_file($image_tmp, $image_dir)) {
								
								$insert = mysqli_query($conn, "UPDATE `posts` SET `p_title` = '$title' , `p_post` = '$post' , `p_category` = '$category' , `p_image` = '$image_db' WHERE `p_id` = '$_GET[post]'");
								if (isset($insert)) 
								{
									$msg= '<div class="alert alert-success" role="alert" style="text-align:center;">Post Update Success</div>';
												echo '<meta http-equiv="refresh" content="3; \'p.php\' "/>';
								}

								
							} // end of move uploaded files
							else
							{
								$msg= '<div class="alert alert-warning" role="alert">Something Happend During Uplead The Photo</div>';
							}
						}
						else
						{
							$msg= '<div class="alert alert-warning" role="alert">Sorry Maximum Size For Avatar Can\'t Be Over Than 2MB</div>';
						}
					}
					else
					{
						$msg= '<div class="alert alert-warning" role="alert">Something Happend During Uplead The Photo</div>';
					}
				}
				else
				{
					$msg= '<div class="alert alert-warning" role="alert">Pleas Choose Right Extension </div>';
				}
		} // end set image
		else
		{
		$insert = mysqli_query($conn, "UPDATE `posts` SET `p_title` = '$title' , `p_post` = '$post' , `p_category` = '$category' WHERE `p_id` = '$_GET[post]'");
								if (isset($insert)) 
								{
									$msg= '<div class="alert alert-success" role="alert" style="text-align:center;">Post Update Success</div>';
												echo '<meta http-equiv="refresh" content="3; \'p.php\' "/>';
								}
		}
	} // end else in line 28
} // end add post line 10

?>

      <article class="col-lg-9">
      <div class="row">
      <div class="col-md-1"></div>
        <?php 
							  $get_post = mysqli_query($conn,"SELECT * FROM `posts` WHERE `p_id` ='$_GET[post]' ");
							  $post = mysqli_fetch_assoc($get_post);
							  ?>
      	<div class="col-md-10">
      	
      		
 					 <div class="panel panel-info">
                      <div class="panel-heading"><strong> Edit Posts </strong> <?php echo $post['p_title']; ?> </div>
                      <div class="panel-body">


							 <form action=""  class="form-horizontal" method="POST" enctype="multipart/form-data">
							  <div class="form-group">
							    <label for="title" class="col-sm-2 control-label">Post Title</label>
							    <div class="col-sm-5">
							      <input type="text" class="form-control" name="title"  id="title" placeholder="Enter Post Title" value=" <?php echo $post['p_title']; ?> " >
							    </div>
							  </div>
									<div class="form-group">
							    <label for="post" class="col-sm-2 control-label">Post</label>
							    <div class="col-sm-10">
							      <textarea rows="8" type="text" class="form-control"  name="post" id="post"><?php echo $post['p_post']; ?></textarea>
							    </div>
							  </div>
							  		<div class="form-group">
							    <label for="category" class="col-sm-2 control-label">Category</label>
							    <div class="col-sm-4">
							      <select  type="text" class="form-control" name="category" id="category">
	  	
	  	<?php 
	  	$cat=mysqli_query($conn, "SELECT * FROM `category` ");
	  	while ($cate = mysqli_fetch_assoc($cat)) 
	  	{
	  		echo '<option value="'.$cate['c_name'].'" '.($post['p_category'] == $cate['c_name'] ? 'selected' : '').'>'.$cate['c_name'].'</option>';
	  	}
	  	?>
							      	
							      </select>
							    </div>
							  </div>

							  

							    <div class="form-group">
              <label for="image" class="col-sm-2 control-label" style="margin-right: 15px;" >Post image</label>
              <div class="cols-sm-10">
                <div class="input-group" >
                  <span class="input-group-addon btn-file" ><i class="fa fa-camera fa-lg" aria-hidden="true" ></i></span>
                  <div class="fileinput fileinput-new" data-provides="fileinput">
                     <span class="btn btn-default btn-file"><span>Choose Image Profile </span><input type="file" class="form-control" name="image" id="image"></span>
    
                  </div>
                </div>
              </div>
            </div>


	  						<!--<div class="form-group">
							    <label for="category" class="col-sm-2 control-label">Category</label>
							    <div class="col-sm-4">
							      <select  type="text" class="form-control" >
									<option value="publish">Publish</option>
									<option value="draft">Draft</option>
							      	
							      </select>
							    </div>
							  </div>-->

							<?php echo $msg; ?>
							  <div class="form-group">
							  
							    <div class="col-sm-offset-2 col-sm-10">
							      <button  type="submit" name="add_post" class="btn btn-success">Update Post</button>
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