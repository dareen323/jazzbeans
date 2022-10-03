<?php
include "../php/conn.php";
include "../methods.php";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Edit Category</title>
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
    <?PHP $catg = getCategory($_REQUEST['c_id']); ?>

    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Edit Category</h4>
                <form class="forms-sample" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input value="<?php echo $catg["name"]; ?>" name="editc_name" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Upload category image</label>
                        <input value="<?php echo $catg["img"]; ?>" name="editc_img" type="file" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <input type="text" value="<?php echo $catg["description"]; ?>" name="editc_desc" class="form-control" id="exampleTextarea1" rows="4"></input>
                    </div>
                    <button name="editc_submit" type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
                <a href="http://localhost/jazzbeans/admin/dashboard.php#catdiv"> <button class="btn btn-danger mt-2">Cancel</button></a>
            </div>
        </div>
    </div>

    <!-- To Edit Category values -->
    <?php

    $id = $_REQUEST['c_id'];

    // select values from database


    if (isset($_POST["editc_submit"])) {

        $name = $_POST['editc_name'];
        $desc = $_POST['editc_desc'];

        $filename = $_FILES["editc_img"]["name"];
        $tempname = $_FILES["editc_img"]["tmp_name"];
        $folder = "../images/" . $filename;

        // Now let's move the uploaded image into the folder: image
        move_uploaded_file($tempname, $folder);
        if (editCategory($id, $name, $folder, $desc)) {
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