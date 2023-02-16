<?php include 'admin/include/init.php'; ?>
<?php
     if (!isset($_SESSION['id'])) {
         redirect_to("../");
     }
?>
<?php $users_profile = Account_Details ::find_by_id($_SESSION['id']); ?>

<?php 
    if (isset($_POST['submit'])) {
        $firstname   = clean($_POST['firstname']);
        $lastname    = clean($_POST['lastname']);
        $phone    = clean($_POST['phone']);
        $city    = clean($_POST['city']);
        $location     = clean($_POST['location']);
        
             if (empty($firstname) || empty($lastname) || empty($phone) || empty($city) || empty($location)) {
                redirect_to("index.php");
                $session->message("
                <div class=\"alert alert-danger alert-dismissible fade show\" role=\"alert\">
                  <strong><i class='mdi mdi-account-alert'></i></strong> Please Fill up all the information.
                  <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                    <span aria-hidden=\"true\">&times;</span>
                  </button>
                </div>");
                die();
            }

            if ($users_profile) {
                $users_profile->firstname = $firstname;
                $users_profile->lastname = $lastname;
                $users_profile->phone = $phone;
                $users_profile->city = $city;
                $users_profile->location = $location;
                
                // $users_profile->date_created = date("F j, Y, g:i a"); 

                if(empty($_FILES['profile_picture'])) {
                  $users_profile->save();
                   redirect_to("proffile.php");
                  $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>The {$users_profile->firstname} {$users_profile->lastname} is successfully updated.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
                } else {
                  $users_profile->set_file($_FILES['profile_picture']);
                  $users_profile->save_image();
                  $users_profile->save();
                  redirect_to("proffile.php");
                  $session->message("
                    <div class=\"alert alert-success alert-dismissible fade show\" role=\"alert\">
                      <strong><i class='mdi mdi-check'></i></strong>The {$users_profile->firstname} {$users_profile->lastname} is successfully updated.
                      <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                        <span aria-hidden=\"true\">&times;</span>
                      </button>
                    </div>");
                }
            }
        }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Profile Detail - Administrator</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
    <link href="css/dataTables.bootstrap4.min.css" rel="stylesheet">
<!--    <link href="css/bootstrap.css" rel="stylesheet">-->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.materialdesignicons.com/2.1.19/css/materialdesignicons.min.css">
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
        div.dataTables_wrapper div.dataTables_paginate {
            font-size: 11px;
        }
         .form-control {
            font-size: 12px;
        }
        .datepicker {
            font-size: 12px;
        }
        .custom-file-label {
            color: #212529;
        }

         .box-shadow {
            box-shadow: 0 0 2px 1px rgba(0, 0, 0, 0.3);
            font-size: 12px;
        }

    </style>
</head>

<body>



<div class="row">
    <div class="col-lg-8 offset-2 pl-3 pb-3 box-shadow mt-4">
            <form method="post" action="" enctype="multipart/form-data">
            
                <h6 class="h6 mt-4 pb-2" style="border-bottom: 1px solid #dee2e6!important;">Profile Detail
                   
                </h6>

                <?php
                    if ($session->message()) {
                        echo ' <div class="form-group col-md-12">' . $session->message() . '</div>';
                    }
                ?>


                <div class="text-center mb-3 mt-3">
                    <img src="<?= $users_profile->profile_picture_picture(); ?>" style="border-radius: 50%; width: 200px;height: 200px;diplay:block;" alt="">
                       
                </div>
                <div class="custom-file mb-3" style="font-size: 13px;">
                  <input type="file" class="custom-file-input" id="customFile" name="profile_picture">
                  <label class="custom-file-label" for="customFile">Edit Profile Picture</label>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputFirstname">Firstname:</label>
                        <input type="text" name="firstname" class="form-control" value="<?= $users_profile->firstname; ?>" id="inputFirstname"  placeholder="Enter firstname">
                    </div>
                   <div class="form-group col-md-6">
                        <label for="inputLastname">Lastname:</label>
                        <input type="text" name="lastname" class="form-control" value="<?= $users_profile->lastname; ?>" id="inputLastname"  placeholder="Enter lastname">
                    </div>
                   
                </div>
                
                <div class="form-group">
                    <label for="inputPhone">Phone:</label>
                    <input type="text" name="phone" class="form-control"  value="<?= $users_profile->phone; ?>" id="inputPhone" placeholder="Enter phone">
                </div>

                <div class="form-group">
                    <label for="inputcity">City:</label>
                    <input type="text" name="city" class="form-control"  value="<?= $users_profile->city; ?>" id="inputcity" placeholder="Enter city">
                </div>

                 <!--<div class="form-group">
                        <label for="gender">Gender:</label>
                        <select name="gender" class="custom-select" id="gender">
                            <?php if($users_profile->gender == 'm') : ?>
                                <option value="m" selected>Male</option>
                                <option value="f">Female</option>
                            <?php else: ?>
                                <option value="m">Male</option>
                                <option value="f" selected>Female</option>
                            <?php endif; ?>
                        </select>
                    </div>-->

                <div class="form-group">
                    <label for="inputlocation">Location</label>
                    <textarea rows="5" name="location" class="form-control" id="inputlocation"  placeholder="Enter location"><?= $users_profile->location;  ?></textarea>
                </div>

                 <!--<div class="form-group">
                    <label for="designation">Designation:</label>
                    <select name="designation" id="designation" class="custom-select">
                        <?php if($users_profile->designation == 0) : ?>
                            <option value="0" selected>Administrator</option>
                            <option value="1">Moderator</option>
                        <?php else: ?>
                            <option value="0">Administrator</option>
                            <option value="1" selected>Moderator</option>
                        <?php endif; ?>
                    </select>
                </div>-->
                 <a href="users.php" class="btn btn-sm btn-danger float-right" style="font-size: 12px;">
                    <i class="mdi mdi-close-circle mr-2"></i> Cancel
                </a>

                <button type="submit" name="submit" class="btn btn-sm btn-success float-right mr-2" style="font-size: 12px;">
                    <i class="mdi mdi-account-plus mr-2"></i> Edit My Account
                </button>
            </form><!-- end of input form -->
    </div>
</div>

<?php include_once 'admin/include/footer.php';?>