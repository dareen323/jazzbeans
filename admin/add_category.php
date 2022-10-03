<?php include "../php/conn.php";
include "../methods.php";

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Create Category</title>
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
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Create New Category</h4>
                <form class="forms-sample" action="#" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input name="addc_name" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label>Upload category image</label>
                        <input name="addc_img" type="file" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea name="addc_desc" class="form-control" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <button name="addc_submit" type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
                <a href="http://localhost/jazzbeans/admin/dashboard.php"> <button class="btn btn-danger mt-3">Cancel</button></a>
            </div>
        </div>
    </div>


    <!-- Get form data and send it to database -->
    <?php
    if (isset($_POST["addc_submit"])) {
        $name = $_POST['addc_name'];
        $desc = $_POST['addc_desc'];

        $filename = $_FILES["addc_img"]["name"];
        $tempname = $_FILES["addc_img"]["tmp_name"];
        $folder = "../images/" . $filename;

        // Now let's move the uploaded image into the folder: image
        move_uploaded_file($tempname, $folder);
        if (createCategory($name, $folder, $desc)) {
            echo "<script> window.location = 'http://localhost/jazzbeans/admin/dashboard.php' </script>";
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