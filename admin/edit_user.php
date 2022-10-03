<?php
include "../php/conn.php";
include "../methods.php";


$id = $_REQUEST['u_id'];

// select values from database
$userInfo = getUserInfo($id);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit User Information</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="./assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="./assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="./assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="./assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="./assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="./assets/images/favicon.png" />
</head>


<body>
    <div class="col-12 grid-margin">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit User Information</h4>
                <form class="form-sample" action="#" method="POST" enctype="multipart/form-data">
                    <!-- <p class="card-description"> Personal info </p> -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Name</label>
                                <div class="col-sm-9">
                                    <input name="editu_name" type="text" value="<?php echo $userInfo['name'] ?> " class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Phone</label>
                                <div class="col-sm-9">
                                    <input name="editu_phone" type="text" value="<?php echo $userInfo['phone'] ?> " class="form-control" />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Email</label>
                                <div class="col-sm-9">
                                    <input name="editu_email" type="text" value="<?php echo $userInfo['email'] ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Password</label>
                                <div class="col-sm-9">
                                    <input name="editu_pass" type="text" value="<?php echo $userInfo['pwd'] ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Date of Birth</label>
                                <div class="col-sm-9">
                                    <input name="editu_birth" value="<?php echo $userInfo['dob'] ?>" class="form-control" placeholder="dd/mm/yyyy" />
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Address</label>
                                <div class="col-sm-9">
                                    <input name="editu_address" type="text" value="<?php echo $userInfo['address'] ?>" class="form-control" />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Change Image</label>
                                <div class="col-sm-9">
                                    <input name="editu_img" type="file" value="<?php echo $userInfo['img']; ?> " class="file-upload-default">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">Role</label>

                                <div class="col-sm-9">
                                    <select name="editu_role" type="text" class="form-control" id="exampleInputName1" placeholder="Users">
                                        <?php
                                        if ($userInfo["role"] == "admin") { ?>
                                            <option selected value="<?php echo $userInfo["role"]; ?>">admin</option>
                                            <option value="user">user</option>

                                        <?php  } else { ?>
                                            <option value="admin">admin</option>
                                            <option selected value="<?php echo $userInfo["role"]; ?>">user</option>

                                        <?php    } ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label">User Status</label>
                                <div class="col-sm-9">
                                    <label class="col-sm-3 col-form-label"> <?php echo $userInfo['user_status'] ?></label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <button name="editu_submit" type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
                <a href="http://localhost/jazzbeans/admin/dashboard.php"> <button class="btn btn-danger mt-2  ">Cancel</button></a>
            </div>
        </div>
    </div>



    <!-- To Edit User Information -->
    <?php


    if (isset($_POST['editu_submit'])) {

        $name = $_POST['editu_name'];
        $email = $_POST['editu_email'];
        $birth = $_POST['editu_birth'];
        $role = $_POST['editu_role'];
        $address = $_POST['editu_address'];
        $phone = $_POST['editu_phone'];
        $pass = $_POST['editu_pass'];

        $filename = $_FILES["editu_img"]["name"];
        $tempname = $_FILES["editu_img"]["tmp_name"];
        $folder = "../images/" . $filename;

        move_uploaded_file($tempname, $folder);


        if (editUserAdmin($id, $name, $address, $phone, $email, $pass, $birth, $folder, $role)) {
            // echo "hi";
            echo "<script> window.location = 'http://localhost/jazzbeans/admin/dashboard.php' </script>";
        } else {
            header("#?err=1");
        }
    }


    ?>


    <!-- plugins:js -->
    <script src="./assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="./assets/vendors/select2/select2.min.js"></script>
    <script src="./assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="./assets/js/off-canvas.js"></script>
    <script src="./assets/js/hoverable-collapse.js"></script>
    <script src="./assets/js/misc.js"></script>
    <script src="./assets/js/settings.js"></script>
    <script src="./assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="./assets/js/file-upload.js"></script>
    <script src="./assets/js/typeahead.js"></script>
    <script src="./assets/js/select2.js"></script>
    <!-- End custom js for this page -->
</body>

</html>