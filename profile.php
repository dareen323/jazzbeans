<?php include "./php/conn.php"; ?>

<?php include_once "methods.php";




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />

    <title>Jazz Beans - Profile</title>
    <?php include_once "header.php"; ?>
</head>
<?php
if (count($_SESSION) == 0) {
    header("Location: http://localhost/jazzbeans/index.php");
}
?>

<body class="mt-5">



    <?php
    $userID = $_SESSION["id"]['id'];
    $sql = "SELECT `name` , `address` , `phone` , `email` , `pwd` , `img` ,`dob` FROM users_info WHERE id = :usrID";

    $query = connect()->prepare($sql);
    $query->bindParam(':usrID', $userID, PDO::PARAM_INT);
    $query->execute();
    $results = $query->fetchAll(PDO::FETCH_OBJ);
    foreach ($results as $result) {


    ?>


        <!-- enctype added for the uploaded file also remove action="000" -->

        <form name=" editForm" action="" id="editForm" method="POST" enctype="multipart/form-data">


            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(5px);">
                        <div class="modal-header">
                            <h3 class="modal-title text-black text-white " id="exampleModalLabel">Edit Personal Informations</h3>
                            <hr>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">


                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="usrname" value="<?php echo trim(($result->name)); ?>" id="username">
                                <label for="username">Full Name</label>

                            </div>

                            <div class="form-floating mb-3">

                                <input type="email" class="form-control" name="email" value="<?php echo trim(($result->email)); ?>" id="email">
                                <label for="email">Email address</label>

                            </div>


                            <div class="form-floating mb-3">

                                <input type="text" class="form-control" name="phone" value="<?php echo trim(($result->phone)); ?>" id="phone">
                                <label for="phone">Phone number</label>

                            </div>


                            <div class="form-floating">
                                <input type="password" class="form-control" value="<?php echo ($result->pwd); ?>" name="pass" id="password">
                                <label for="password">New Password</label>

                            </div>

                            <div class="form-floating mt-3">
                                <input type="date" class="form-control" name="dob" value="<?php echo ($result->dob); ?>" id="dob">
                                <label for="cpassword">Date of birth</label>

                            </div>


                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="address" value="<?php echo ($result->address); ?>" id="address">
                                <label for="address">Address</label>

                            </div>


                            <div class="mt-2">
                                <label for="photo" class="form-label" style="color:azure;">Personal Photo</label>

                                <input class="form-control" value="<?php echo ($result->img); ?>" name="photo" type="file" id="photo">

                            </div>


                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button value="edit" type="submit" name="editFormBtn" id="editFormBtn" class="btn btn-primary">edit</button>

                        </div>
                    </div>
                </div>
            </div>

        </form>


        <!-- Editing the user information -->

        <?php
        if (isset($_POST['editFormBtn'])) {
            $usrname = $_POST['usrname'];
            $pass = $_POST['pass'];
            $dob = $_POST['dob'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $phone = $_POST['phone'];

            $filename = $_FILES["photo"]["name"];
            $tempname = $_FILES["photo"]["tmp_name"];



            $folder = "../images/" . $filename;
            move_uploaded_file($tempname, $folder);

            editUser($userID, $usrname, $address, $phone, $email, $pass, $dob, $folder);
            echo "<script> window.location = 'http://localhost/jazzbeans/profile.php'</script>";
        }

        ?>

        <div class="container py-5">

            <div class="row">
                <div class="col-lg-4">
                    <div class="card mb-4 text-dark" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(2px);">
                        <div class="card-body text-center">
                            <img src="<?php $imgg = ltrim($result->img, ".");
                                        echo "." . $imgg;  ?>" alt="avatar" class="rounded-circle img-fluid" style="width: 150px; height:148px">
                            <h5 class="my-3 text-white   "><?php echo ($result->name); ?></h5>
                            <p class="text-muted mb-1">Full Stack Developer</p>
                            <p class="text-muted mb-4">Bay Area, San Francisco, CA</p>
                            <div class="d-flex justify-content-center mb-2">
                                <?php
                                if (getOneUser($_SESSION['id']['id'])["role"] == "admin") {
                                    echo  '<a href="http://localhost/jazzbeans/admin/dashboard.php"> <button type="button" class="btn btn-success btn-outline-primary mx-1">dashboard</button></a>';
                                }
                                ?>

                                <button type="button" class="btn btn-primary btn-outline-primary mx-1" data-bs-toggle="modal" data-bs-target="#exampleModal">edit</button>
                                <a href="register/includes/logout.inc.php?id=<?php echo $_SESSION["id"]['id']; ?>"><button type="button" class="btn btn-danger btn-outline-danger mx-1" onclick="">Logout</button></a>

                            </div>
                        </div>
                    </div>

                </div>
                <div class="col-lg-8">
                    <div class="card mb-4 text-white" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(2px);">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Full Name</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo ($result->name); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Email</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo ($result->email); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Password</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0">**********</p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Date of birth</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo ($result->dob); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">phone number</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo ($result->phone); ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-3">
                                    <p class="mb-0">Address</p>
                                </div>
                                <div class="col-sm-9">
                                    <p class="text-muted mb-0"><?php echo ($result->address); ?></p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        <?php
    }
        ?>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4 mb-md-0" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(2px); min-height:auto;">
                    <div class="card-body">
                        <h3>Orders History</h3>
                        <hr />
                        <div class="table-responsive">
                            <table id="mytable" class="table table-bordred table-striped">
                                <thead class="text-white">
                                    <th>Order Number</th>
                                    <th>invoice Number</th>
                                    <th>Order date</th>
                                    <th>Total Price</th>
                                    <th>View order</th>

                                </thead>

                                <tbody>

                                    <?php

                                    $sql = "SELECT * FROM `invoice` WHERE `user_id` = :usrID";
                                    $query = connect()->prepare($sql);
                                    $query->bindParam(':usrID', $userID, PDO::PARAM_INT);
                                    $query->execute();
                                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($results as $result) {

                                    ?>

                                        <!-- Display Records -->
                                        <tr class="text-white">
                                            <td class="text-white"><?php echo ($result->id); ?></td>
                                            <td class="text-white"><?php echo ($result->invoice_num); ?></td>
                                            <td class="text-white"><?php echo ($result->currentdate); ?></td>
                                            <td class="text-white"><?php echo ($result->total_price); ?> JOD</td>
                                            <td class="text-white"><button class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#exampleModal<?php echo $result->id; ?>"> Order Details</td></button>



                                        </tr>

                                    <?php


                                    }
                                    ?>


                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

        <?php include_once "footer.php"; ?>

        <?php

        $sql = "SELECT * FROM `invoice` WHERE `user_id` = :usrID";
        $query = connect()->prepare($sql);
        $query->bindParam(':usrID', $userID, PDO::PARAM_INT);
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($results as $result) {

        ?>


            <div class="modal fade" id="exampleModal<?php echo $result->id; ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog ">
                    <div class="modal-content" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(5px);">
                        <div class="modal-header">
                            <h3 class="modal-title text-black text-white " id="exampleModalLabel">Purchase Reciept</h3>
                            <hr>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">

                            <div class="card-body p-5">


                                <?php
                                $invoice_id = $result->id;
                                $sql = "SELECT * FROM `invoice` WHERE `id` = :invID";
                                $query = connect()->prepare($sql);
                                $query->bindParam(':invID', $invoice_id, PDO::PARAM_INT);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                foreach ($results as $result) {

                                ?>
                                    <div class="row">
                                        <div class="col-6 mb-1">
                                            <p class="small text-muted mb-1">Date</p>
                                            <p><?php echo $result->currentdate ?></p>
                                        </div>
                                        <div class="col-3 mb-1">
                                            <p class="small text-muted mb-1">Order No.</p>
                                            <p><?php echo ($result->id); ?></p>
                                        </div>
                                        <div class="col-3 mb-1">
                                            <p class="small text-muted mb-1">invoice No.</p>
                                            <p><?php echo ($result->invoice_num); ?></p>
                                        </div>
                                    </div>

                                <?php
                                }
                                ?>

                                <hr color="grey">
                                <div class="py-2" style="border-radius:5px;">
                                    <div class="row">
                                        <div class="col-md-4 col-lg-6">

                                            <p style="color:#f37a27 ;">Product name</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3">

                                            <p style="color:#f37a27 ;">Quantity</p>
                                        </div>
                                        <div class="col-md-4 col-lg-3">
                                            <p class="text-center" style="color:#f37a27 ;">Price</p>
                                        </div>
                                    </div>
                                </div>
                                <?php
                                $invoice_id = $result->id;
                                $sql = "SELECT *  FROM `products` INNER JOIN `p_order` ON `product_id` =  products.id INNER JOIN `invoice` ON `invoice_id` = invoice.id WHERE invoice.id =:invID ";
                                $query = connect()->prepare($sql);
                                $query->bindParam(':invID', $invoice_id, PDO::PARAM_INT);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                // var_dump($results);
                                $SumPrices = 0;
                                foreach ($results as $row) {

                                    $SumPrices += $row->price;
                                ?>

                                    <div class="py-2" style="border-radius:5px;">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-6">

                                                <p style="color:#f37a27 ;"><?php echo ($row->name); ?></p>
                                            </div>
                                            <div class="col-md-4 col-lg-3">

                                                <p class="text-center" style="color:#f37a27 ;"><?php echo ($row->quantity); ?></p>
                                            </div>
                                            <div class="col-md-4 col-lg-3">
                                                <p class="text-center" style="color:#f37a27 ;"><?php echo ($row->price); ?> JOD</p>
                                            </div>
                                        </div>
                                    </div>

                                <?php
                                }
                                $shippingfees = 3;
                                ?>

                                <div class="row mt-2">
                                    <div class="col-md-8 col-lg-9">
                                        <p class="mb-0" style="color:#f37a27 ;">Shipping fees</p>
                                    </div>
                                    <div class="col-md-4 col-lg-3">
                                        <p class="mb-0 text-center" style="color:#f37a27 ;"><?php echo $shippingfees ?> JOD</p>
                                    </div>
                                </div>
                            </div>

                            <hr color="grey">

                            <div class="row my-4">

                                <div class="col-md-8 col-lg-9">
                                    <p class="lead fw-bold mb-0" style="color: #f37a27;">Total Price:</p>
                                </div>

                                <div class="col-md-4 col-lg-3">
                                    <p class="lead fw-bold mb-0" style="color: #f37a27;"><?php echo $row->total_price ?> JOD</p>
                                </div>
                            </div>

                            <hr color="grey">

                            <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>

                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="horizontal-timeline" style="color:#f37a27;">

                                        <ul class="list-inline items d-flex justify-content-between">
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded text-white" style="background-color: green;">Ordered</p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                                            </li>
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Shipped</p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
                                            </li>
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">On the way
                                                </p>
                                            </li>
                                            <li class="list-inline-item items-list">
                                                <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Delivered
                                                </p>
                                            </li>
                                        </ul>

                                    </div>

                                </div>
                            </div>

                            <p class="mt-4 pt-2">Want any help? <a href="contact.php" style="color: #f37a27;">Please contact
                                    us</a></p>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>


    <?php }; ?>

</body>

</html>