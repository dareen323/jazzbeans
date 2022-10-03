<?php include_once "../php/conn.php";
include_once "../methods.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    <title>Document</title>
</head>

<body>
    <div class="col-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Add New Product</h4>
                <form action="#" method="POST" class="forms-sample" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="exampleInputName1">Name</label>
                        <input name="addp_name" type="text" class="form-control" id="exampleInputName1" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Price</label>
                        <input name="addp_price" type="number" class="form-control" id="exampleInputName1" placeholder="Price">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Discount</label>
                        <input name="addp_discount" type="number" class="form-control" id="exampleInputName1" placeholder="Discount">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputName1">Category</label>
                        <select name="addp_category" type="text" class="form-control" id="exampleInputName1" placeholder="Category">
                            <?php
                            foreach (getAllCategories() as $cat) {
                            ?>

                                <option selected value=" <?php echo $cat["id"];  ?> "><?php echo $cat["name"];  ?></option>



                            <?php    }
                            ?>


                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Short Description</label>
                        <textarea name="addp_sdesc" class="form-control" placeholder="Short Description" id="exampleTextarea1" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Description</label>
                        <textarea name="addp_desc" class="form-control" placeholder="Description" id="exampleTextarea1" rows="4"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="addp_img" class="file-upload-default">
                        <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                                <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleTextarea1">Tags</label>
                        <textarea name="addp_tags" class="form-control" id="exampleTextarea1" rows="4" placeholder="separate tags with a comma"></textarea>
                    </div>
                    <button name="addp_submit" type="submit" class="btn btn-primary mr-2">Submit</button>
                </form>
                <a href="http://localhost/jazzbeans/admin/dashboard.php"> <button class="btn btn-danger mt-3">Cancel</button></a>
            </div>
        </div>
    </div>
    <!-- get form data and send it -->
    <?php



    if (isset($_POST["addp_submit"])) {

        $name = $_POST["addp_name"];
        $price = (int)$_POST["addp_price"];
        $discount = (int)$_POST["addp_discount"];
        $category = (int)$_POST["addp_category"];
        $shortDesc = $_POST["addp_sdesc"];
        $Desc = $_POST["addp_desc"];
        $tags = $_POST["addp_tags"];

        $filename = $_FILES["addp_img"]["name"];
        $tempname = $_FILES["addp_img"]["tmp_name"];

        $folder = "../images/" . $filename;


        move_uploaded_file($tempname, $folder);
        if (createProduct($name, $price, $discount, $category, $shortDesc, $Desc, $folder, $tags)) {
            echo "<script> window.location = 'http://localhost/jazzbeans/admin/index.html' </script>";
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