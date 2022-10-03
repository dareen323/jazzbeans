<?php include "../php/conn.php"; ?>

<?php include_once "../methods.php"; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Jazz Beans - Profile</title>

    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" rel="stylesheet" />
</head>
<style>
    body {
        background-color: black;
    }

    p {
        color: white;
    }
</style>

<body>
    <header>

    </header>
    <?php


    ?>
    <main>
        <section class=" h-max-content ">
            <div class="container  ">
                <div class="row d-flex justify-content-center align-items-center h-100">

                    <div class="col-lg-8 col-xl-6">
                        <div class="card border-top border-bottom border-3" style="background: rgba(255, 255, 255, 0.159); backdrop-filter: blur(5px);">
                            <div class="card-body p-5">

                                <p class="lead fw-bold mb-5" style="color: #f37a27;">Purchase Reciept</p>




                                <?php
                                $invoice_id = $_REQUEST["i_Id"];
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
                                        <div class="col mb-3">
                                            <p class="small text-muted mb-1">Invoice No.</p>
                                            <p><?php echo ($result->invoice_num); ?></p>
                                        </div>
                                    </div>





                                <?php
                                }
                                ?>




                                <hr color="grey">



                                <?php
                                $invoice_id = $_REQUEST["i_Id"];
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





                                    <div class="row ms-2 my-4">

                                        <div class="col-md-8 col-lg-8">
                                            <p class="lead fw-bold mb-0" style="color: #f37a27;">Total Price:</p>
                                        </div>

                                        <div class="col-md-4 col-lg-4">
                                            <p class="lead fw-bold mb-0" style="color: #f37a27;"><?php echo $result->total_price ?>JOD</p>
                                        </div>
                                    </div>



                                    <hr color="grey">




                                    <a href="http://localhost/jazzbeans/admin/dashboard.php" class="btn btn-primary">Back</a>

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