<?php include "./php/conn.php"; ?>

<?php include_once "methods.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Jazz Beans - Profile</title>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
</head>

<body>
    <header>
        <?php include_once "header.php"; ?>
    </header>
    <?php


    ?>
    <main>
        <section class=" h-max-content mt-5">
            <div class="container py-5 h-">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <h1 class="text-center text-white my-5"> Thank you for purchasing form Jazz Beans</h1>
                    <div class="col-lg-8 col-xl-6">
                        <div class="card border-top border-bottom border-3" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(5px);">
                            <div class="card-body p-5">

                                <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Reciept</p>




                                <?php
                                $invoice_id = $_SESSION["i_Id"];
                                $sql = "SELECT * FROM `invoice` WHERE `id` = :invID";
                                $query = connect()->prepare($sql);
                                $query->bindParam(':invID', $invoice_id, PDO::PARAM_INT);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);

                                foreach ($results as $result) {


                                ?>









                                    <div class="row">
                                        <div class="col mb-3">
                                            <p class="small text-muted mb-1">Date</p>
                                            <p><?php echo $result->currentdate ?></p>
                                        </div>
                                        <div class="col mb-3">
                                            <p class="small text-muted mb-1">Order No.</p>
                                            <p><?php echo ($result->id); ?></p>
                                        </div>
                                    </div>





                                <?php
                                }
                                ?>




                                <hr color="grey">



                                <?php
                                $invoice_id = $_SESSION["i_Id"];
                                $sql = "SELECT *  FROM `products` INNER JOIN `p_order` ON `product_id` =  products.id INNER JOIN `invoice` ON `invoice_id` = invoice.id WHERE invoice.id =:invID ";
                                $query = connect()->prepare($sql);
                                $query->bindParam(':invID', $invoice_id, PDO::PARAM_INT);
                                $query->execute();
                                $results = $query->fetchAll(PDO::FETCH_OBJ);
                                // var_dump($results);

                                foreach ($results as $row) {


                                ?>





                                    <div class="py-2" style="border-radius:5px;">
                                        <div class="row">
                                            <div class="col-md-8 col-lg-9">

                                                <p style="color:#f37a27 ;"><?php echo ($row->name); ?></p>
                                            </div>
                                            <div class="col-md-4 col-lg-3">
                                                <p style="color:#f37a27 ;"><?php if ($row->discount && $row->discount < $row->price) {
                                                                                echo ($row->discount);
                                                                            } else {
                                                                                echo ($row->price);
                                                                            }  ?>JOD</p>
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
                                            <p class="mb-0" style="color:#f37a27 ;"><?php echo $shippingfees ?>JOD</p>
                                        </div>
                                    </div>
                                    </div>


                                    <hr color="grey">





                                    <div class="row my-4">

                                        <div class="col-md-8 col-lg-9">
                                            <p class="lead fw-bold mb-0" style="color: #f37a27;">Total Price:</p>
                                        </div>

                                        <div class="col-md-4 col-lg-3">
                                            <p class="lead fw-bold mb-0" style="color: #f37a27;"><?php echo $result->total_price ?>JOD</p>
                                        </div>
                                    </div>



                                    <hr color="grey">

                                    <p class="lead fw-bold mb-4 pb-2" style="color: #f37a27;">Tracking Order</p>

                                    <div class="row">
                                        <div class="col-lg-12">

                                            <div class="horizontal-timeline" style="color:#f37a27;">

                                                <ul class="list-inline items d-flex justify-content-between">
                                                    <li class="list-inline-item items-list">
                                                        <p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">Ordered</p class="py-1 px-2 rounded text-white" style="background-color: #f37a27;">
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
                                    <a href="./index.php" class="btn btn-primary">Continue to shop</a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <footer>

    </footer>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
</body>

</html>