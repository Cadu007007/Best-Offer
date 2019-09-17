        <?php 
        if ($_SESSION['isadmain'] != 'admin') {
header("Location: ../index.php");
}

  ?>
    <div class="blurred-container" style="margin-bottom: 100px;">
            <div class="img-src" style="background-image: url('../images/bg.jpg');width: 100%; height: 550px;position: relative;"></div>
        </div>

        <aside class="col-lg-3">
                              <div class="list-group">
                      <a href="#" class="list-group-item disabled">
                          <b style="text-align: center;">  <h5>Control Panel </h5> </b>
                      </a>
                      <h5 style="text-align: center;"><a href="setting.php" class="list-group-item">Setting</a></h5>
                      <h5 style="text-align: center;"><a href="arm.php" class="list-group-item">Members</a></h5>
                      <h5 style="text-align: center;"><a href="arc.php" class="list-group-item">Categorys</a></h5>
                      <h5 style="text-align: center;"><a href="post.php" class="list-group-item">New Post</a></h5>
                      <h5 style="text-align: center;"><a href="p.php" class="list-group-item">Posts</a></h5>
                      <h5 style="text-align: center;"><a href="profile.php" class="list-group-item">Profile</a></h5>
                      
                      </div>
        </aside>
      