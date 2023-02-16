<?php include_once 'admin/include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("loginn.php");
     }

    $user_count =  Account_Details::count_user();
    $booking_count =  Booking::count_booking();
    $gallery_count =  Gallery::count_all();
    $event_post =  EventWedding::count_all();
?>
<?php $users_profile = Users::find_by_id($_SESSION['id']); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Dashboard - Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
   <link href="css/dashboard.css" rel="stylesheet"><!-- side bar and background-->
   <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
<!--    <link href="css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css"><!-- side bar pics-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">
    <style>
        table.table.table-striped.table-bordered.table-sm {
            font-size:12px;
        }
        .tooltip {
            font-size: 12px;
        }

        td.special {
            padding: 0;
            padding-top: 8px;
            padding-left:6px;
            padding-bottom:6px;
            margin-top:5px;
            text-transform: capitalize;
        }
        .datepicker {
            font-size: 12px;
        }
        .alert-success {
            color: #fff;
            background-color: #3D708F9;
            border-color: none;
        }
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }

        .card-counter{
    box-shadow: 2px 2px 10px #3D708F9;
    margin: 5px;
    padding: 0px 9px;
    background-color: #fff;
    height: 100px;
    border-radius: 5px;
    transition: .3s linear all;
  }

  .card-counter:hover{
    box-shadow: 4px 4px 20px #3D708F;
    transition: .3s linear all;
  }

  .card-counter.primary{
    background-color: #007bff;
    color: #FFF;
  }

  /** /.card-counter.danger{
    background-color: #ef5350;
    color: #FFF;
  }**/

  .card-counter.success{
    background-color: #3D708F;
    color: #FFF;
  }  

  .card-counter.info{
    background-color: #26c6da;
    color: #FFF;
  }  

  .card-counter i{
    font-size: 5em;
    opacity: 0.9;
  }

  .card-counter .count-numbers{
    position: absolute;
    right: 35px;
    top: 20px;
    font-size: 32px;
    display: block;
  }

  .card-counter .count-name{
    position: absolute;
    right: 35px;
    top: 65px;
    text-transform: capitalize;
    opacity: 0.8;
    display: block;
    font-size: 16px;
  }

    </style>
</head>

<body>


<nav class="navbar sticky-top p-0" style="width: 16.7%;background-color:#3D708F;">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" style="color:white;" href="dashboard.php">
        <!--<img src="images/admin.png" alt="" style="width: 200px;"> -->
         Supplier Panel
    </a>
</nav>

<!--<li class="nav-item"><div class="dropdown-divider"></div></li>-->



<!--<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item mt-3">
                        <div class="text-center">
                            <li class="nav-item">
                              <a class="nav-link" href="service_list1.php">
                                <i class="mdi mdi-verified mr-3" style="color:#3D708F;"></i>
                               Services
                                </a>
                                </li>
</div>
      </div>
</div>
</li>
</div> -->






<!--<div class="container-fluid">
    <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <ul class="nav flex-column">
                    <li class="nav-item mt-3">
                        <div class="text-center">
                            <a href="users_profile.php" class="user-button">
                                <img src="<?= $users_profile->profile_picture_picture(); ?>" class="img-fluid rounded-circle" width="52" height="52" alt="">
                                <div class="user-profile"><?= $users_profile->firstname . ' ' . $users_profile->lastname; ?></div>
                            </a>
                                <div class="text-center mt-0" style="font-size: 11px;color:#72777a;">
                                    <?= ($users_profile->designation == 0) ? 'Administrator' : 'Moderator'; ?>
                                </div>
                        </div>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>

                    <li class="nav-item">
                        <a class="nav-link" href="dashboard.php">
                            <i class="mdi mdi-home mr-3" style="color:#ba372a;"></i>
                            Dashboard <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="blog_events.php">
                            <i class="mdi mdi-comment-text mr-3" style="color:#3D708F;"></i>
                            Blogs &amp; Events
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="client.php" >
                            <i class="mdi mdi-account-multiple mr-3" style="color: #ba372a"></i>
                            Bookings
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>

                    <li class="nav-item">
                        <a class="nav-link" href="service_list.php">
                            <i class="mdi mdi-verified mr-3" style="color:#3D708F;"></i>
                            Services
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="photos_view.php">
                            <i class="mdi mdi-image-multiple mr-3" style="color:#673ab7!important"></i>
                            Users
                        </a>
                    </li>
                    <!--<li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="photos_add.php">
                            <i class="mdi mdi-upload-multiple mr-3" style="color:#ba372a!important"></i>
                            Upload Photos
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="users.php">
                            <i class="mdi mdi-account-card-details mr-3" style=" color:#ba372a !important;"></i>
                            Admins Management
                        </a>
                    </li>
                    <li class="nav-item"><div class="dropdown-divider"></div></li>
                    <li class="nav-item">
                        <a class="nav-link" href="task_all_calendar.php">
                            <i class="mdi mdi-calendar-text mr-3" style="color:#3D708F!important;"></i>
                            Task Calendar
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10" style="margin-top: -40px;z-index: 999">
            <nav class="navbar navbar-expand-lg navbar-light bg-light" style="margin-left:-15px;margin-right: -15px;">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">

                    </ul>
                </div>

                <div class="form-inline my-2 my-lg-0">
                    <a class="nav-link" href="users_profile.php"><b><?= ucfirst($users_profile->firstname) . ' ' . ucfirst($users_profile->lastname); ?></b></a>
                    <a class="nav-link" href="logout.php"><b><i class="mdi mdi-logout" style="color: #f44336!important;"></i> Logout</b></a>
                </div>
            </nav>



<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h4 class="h4 mt-4">WELCOME, <?= ucfirst($users_profile->firstname) . ' ' . ucfirst($users_profile->lastname); ?></h4>
</div>
<!-- <div class="row">
    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL CUSTOMERS</div>
            
                <div class="card-body">
                <h5 class="card-title"><?=  $user_count; ?></h5>
                    <p class="card-text"></p>
               </div>
        </div>
    </div>

    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL BOOKING</div>
                <div class="card-body">
                <h5 class="card-title"><?=  $booking_count; ?></h5>
                    <p class="card-text"></p>
               </div>
        </div>
    </div>
       

    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL PHOTOS</div>
                <div class="card-body">
                <h5 class="card-title"><?=  $gallery_count; ?></h5>
                    <p class="card-text"></p>
                </div>
        </div>
    </div>
       

    <div class="col-lg-3">
        <div class="card bg-light mb-3" style="max-width: 18rem;">
            <div class="card-header">TOTAL BLOGS</div>
                <div class="card-body">
                <h5 class="card-title"><?=  $event_post; ?></h5>
                    <p class="card-text"></p>
               </div>
        </div>
    </div>
       
       
    
</div> -->

    <div class="row">
    <div class="col-lg-3">
      <div class="card-counter primary">
      <a class="nav-link" href="client.php" style="color:#ffffff;">
        <i class="mdi mdi-account-multiple"></i>
        <span class="count-numbers"><?=  $user_count; ?></span>
        <span class="count-name">Total Customers</span>
      </a>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card-counter success">
      <a class="nav-link" href="blog_events1.php" style="color:#ffffff;">
        <i class="mdi mdi-book-open-page-variant"></i>
        <span class="count-numbers"><?=  $booking_count; ?></span>
        <span class="count-name">Blog Events</span>
        </a>
      </div>
    </div>

    <div class="col-lg-3">
    <div class="card-counter primary">
      <a class="nav-link" href="Calendar1.php" style="color:#ffffff;">
        <i class="mdi mdi-image-multiple"></i>
        <!--<span class="count-numbers"><?=  $gallery_count; ?></span>-->
        <span class="count-name">Calendar</span>
        </a>
      </div>
    </div>

    <div class="col-lg-3">
      <div class="card-counter info">
      <a class="nav-link" href="service_list1.php" style="color:#ffffff;">
        <i class="mdi mdi-comment-text"></i>
        <span class="count-numbers"><?=  $event_post; ?></span>
        <span class="count-name">Service List</span>
        </a>
      </div>
    </div>
  </div>




<?php include_once 'admin/include/footer.php';?>