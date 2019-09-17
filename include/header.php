<?php 


include_once("include/config.php");
include_once("include/function.php");
session_start();
ob_start();

  $sel_setting = mysqli_query($conn , "SELECT * FROM `setting` ");
  $setting = mysqli_fetch_assoc($sel_setting);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Best Offer</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/pe-icon-7-stroke.css" rel="stylesheet" />
  <link href="css/ct-navbar.css" rel="stylesheet" />  
  
  <link href="css/item.css" rel="stylesheet">
  
  <link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/register.css">



   <link rel="icon" href="images/Background.png" type="image/gif" sizes="32x32"  />



  </head>
  <body>
  
     <nav class="navbar navbar-ct-blue navbar-fixed-top navbar-transparent" role="navigation" >
          
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
              <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
              <a class="navbar-brand navbar-brand-logo" href="index.php">
                    <div class="logo">
                    <img src="images/Background.png" style="width: 60px; height: 60px;">
                    </div>
                    <div class="brand"><span style="font-weight: bold; color:#ddd;"> Best </span> <span style="font-weight: bold; color: #fff;">Offer</span> </div>
              </a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
              <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a href="javascript:void(0);" data-toggle="search" class="hidden-xs">
                            <i class="pe-7s-search"></i>
                            <p>Search</p>
                        </a>
                    </li>

                    <?php
                      logg();
                    ?>

               </ul>
               <form class="navbar-form navbar-right navbar-search-form" role="search" action="search.php">                  
                 <div class="form-group">
                      <input type="text" value="" name= "search" class="form-control" placeholder="Search...">
                 </div> 
              </form>
              
            </div><!-- /.navbar-collapse -->
          </div><!-- /.container-fluid -->
        </nav>
        
