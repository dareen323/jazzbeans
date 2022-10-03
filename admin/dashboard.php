<?php include_once "../php/conn.php";
include_once "../methods.php";
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Corona Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
  <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="assets/css/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>

<body>
  <div class="container-scroller">
    <!-- partial:partials/_sidebar.html -->

    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar p-0 fixed-top d-flex flex-row">

        <div class="navbar-menu-wrapper  d-flex align-items-stretch">
          <!-- <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-toggle="minimize">
            <span class="mdi mdi-menu"></span> 
          </button> -->
          <ul class="navbar-nav w-100">
            <li class="nav-item w-100">
              <form class="nav-link mt-2 mt-md-0 d-none d-lg-flex search">

              </form>
            </li>
          </ul>
          <ul class="navbar-nav navbar-nav-right">


            <li class="nav-item dropdown">
              <a class="nav-link" id="profileDropdown" href="#" data-toggle="dropdown">
                <div class="navbar-profile">
                  <img class="img-xs rounded-circle" src="<?php echo getUserInfo((int)$_SESSION["id"]["id"])["img"]; ?>" alt="">
                  <p class="mb-0 d-none d-sm-block navbar-profile-name"><?php $idd = $_SESSION["id"]["id"];
                                                                        echo getUserInfo($idd)["name"];  ?></p>
                  <i class="mdi mdi-menu-down d-none d-sm-block"></i>
                </div>
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="profileDropdown">
                <h6 class="p-3 mb-0">Profile</h6>
                <div class="dropdown-divider"></div>

                <div class="dropdown-divider"></div>
                <a href="../index.php" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-home text-primary"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Home Page</p>
                  </div>

                </a>
                <div class="dropdown-divider"></div>
                <a href="../register/includes/logout.inc.php?id=<?php
                                                                echo $_SESSION["id"][0]; ?>" class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-dark rounded-circle">
                      <i class="mdi mdi-logout text-danger"></i>
                    </div>
                  </div>
                  <div class="preview-item-content">
                    <p class="preview-subject mb-1">Log out</p>
                  </div>

                </a>

              </div>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-format-line-spacing"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">

          <div class="row">
            <div class="col-sm-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Total Revenue</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0"><?php
                                          $total = 0;
                                          foreach (getAllInvoices() as $key) {
                                            $total = $total + (int)$key["total_price"];
                                          }
                                          echo $total;
                                          ?> JOD</h2>
                        <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                      </div>
                      <h6 class="text-muted font-weight-normal"></h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-codepen text-primary ml-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-sm-6 grid-margin">
              <div class="card">
                <div class="card-body">
                  <h5>Sales</h5>
                  <div class="row">
                    <div class="col-8 col-sm-12 col-xl-8 my-auto">
                      <div class="d-flex d-sm-block d-md-flex align-items-center">
                        <h2 class="mb-0"><?php $total = 0;
                                          foreach (getAllInvoices() as $key) {
                                            $total++;
                                          }
                                          echo $total;
                                          ?></h2>
                        <p class="text-success ml-2 mb-0 font-weight-medium"></p>
                      </div>
                      <h6 class="text-muted font-weight-normal"></h6>
                    </div>
                    <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                      <i class="icon-lg mdi mdi-wallet-travel text-danger ml-auto"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <!-- strat table products -->
          <!-- get all products method -->
          <?php
          $products = getAllProduct();

          ?>
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between">

                  <h4 class="card-title">Products table</h4>
                  <a href="http://localhost/jazzbeans/admin/add_product.php"> <button type="button" class="btn btn-primary mr-2">Add New Product</button>
                  </a>
                </div>

                </p>
                <div class="table-responsive">
                  <table class="table table-bordered">
                    <thead>
                      <tr>
                        <th> # </th>
                        <th> Name </th>
                        <th> Price </th>
                        <th> Short Description </th>
                        <th> publish </th>
                        <th> Actions </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      foreach ($products as $product) { ?>
                        <tr>
                          <td><?php echo $product["id"]; ?> </td>
                          <td><?php echo $product["name"]; ?></td>
                          <td> <?php echo $product["price"]; ?> JOD</td>
                          <td> <?php echo $product["short_desc"]; ?></td>
                          <td> <?php if ($product["short_desc"]) echo "Publish";
                                else echo "Unpublish";  ?> </td>
                          <td>
                            <div class="d-flex justify-content-around"> <a href="edit_product.php?p_id=<?php echo $product["id"]; ?>"> <button type="button" class="btn btn-outline-secondary btn-icon-text "> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                </button></a>
                              <a href="./del_product.php?p_id=<?php echo $product["id"]; ?>"><button type="button" class="btn btn-outline-danger btn-icon-text "> Delete
                                </button></a>

                            </div>
                          </td>
                        </tr>
                      <?php  }
                      ?>

                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- start category table============================= -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">


              <div class="card-body">
                <div class="d-flex justify-content-between">

                  <h4 class="card-title">Categories table</h4>
                  <a href="http://localhost/jazzbeans/admin/add_category.php"> <button type="button" class="btn btn-primary mr-2">Add New Category</button>
                  </a>
                </div>
                </p>
                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>

                      <tr>
                        <th> ID </th>
                        <th> Image </th>
                        <th> Name </th>
                        <th> Description </th>
                        <th class="text-center"> Actions </th>
                      </tr>


                    </thead>
                    <tbody>
                      <?php foreach (getAllCategories() as $category) { ?>
                        <tr>
                          <td> <?php echo $category["id"]; ?> </td>
                          <td class="py-1">
                            <img src="<?php echo $category["img"]; ?>" alt="image">
                          </td>
                          <td> <?php echo $category["name"]; ?> </td>
                          <td>
                            <?php echo $category["description"]; ?>
                          </td>
                          <td>
                            <div class="d-flex justify-content-around"> <a href="edit_category.php?c_id=<?php echo $category["id"]; ?>"> <button type="button" class="btn btn-outline-secondary btn-icon-text "> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                </button></a>
                              <a href="./del_category.php?c_id=<?php echo $category["id"]; ?>"><button type="button" class="btn btn-outline-danger btn-icon-text "> Delete
                                </button></a>

                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- start users table============================= -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">


              <div class="card-body">
                <h4 class="card-title">Users table</h4>


                <div class="table-responsive">
                  <table class="table table-striped">
                    <thead>

                      <tr>
                        <th> ID </th>
                        <th> Image </th>
                        <th> Name </th>
                        <th> Email </th>
                        <th> online </th>
                        <th class="text-center"> Actions </th>
                      </tr>


                    </thead>
                    <tbody>
                      <?php foreach (getAllUsers() as $user) { ?>
                        <tr>
                          <td> <?php echo $user["id"]; ?> </td>
                          <td class="py-1">
                            <img src="<?php echo $user["img"]; ?>" alt="image">
                          </td>
                          <td> <?php echo $user["name"]; ?> </td>
                          <td>
                            <?php echo $user["email"]; ?>
                          </td>
                          <td>
                            <?php echo $user["user_status"]; ?>
                          </td>
                          <td>
                            <div class="d-flex justify-content-around"> <a href="edit_user.php?u_id=<?php echo $user["id"]; ?>"> <button type="button" class="btn btn-outline-secondary btn-icon-text "> Edit <i class="mdi mdi-file-check btn-icon-append"></i>
                                </button></a>
                              <a href="./del_user.php?u_id=<?php echo $user["id"]; ?>"><button type="button" class="btn btn-outline-danger btn-icon-text "> Delete
                                </button></a>

                            </div>
                          </td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>


          <!-- orders  -->
          <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">


              <div class="card-body">
                <h4 class="card-title">Orders</h4>
                <div class="table-responsive">
                  <table class="table">
                    <thead>
                      <tr>


                        <th> Client </th>
                        <th> Order No </th>
                        <th> Total Price </th>
                        <th> Payment </th>
                        <th> Date </th>
                        <th> Payment Status </th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      $invoicesIDs = [];
                      foreach (getAllInvoices() as $invoice) {
                        array_push($invoicesIDs, $invoice[0]);
                      ?>
                        <tr>
                          <td>
                            <img src="<?php echo getUserInfo($invoice["user_id"])["img"]; ?>" alt="image" />
                            <span class="pl-2"><?php echo getUserInfo($invoice["user_id"])["name"]; ?></span>
                          </td>
                          <td> <?php echo $invoice["invoice_num"]; ?> </td>
                          <td><?php echo $invoice["total_price"]; ?> JOD</td>
                          <td> Cash </td>
                          <td> <?php echo $invoice["currentdate"]; ?> </td>

                          <td>
                            <a href="http://localhost/jazzbeans/admin/invoice_details.php?i_Id=<?php echo $invoice['id']; ?>">
                              <div class="badge badge-outline-success">View Details</div>
                            </a>
                          </td>
                        </tr>



                      <?php }





                      ?>


                    </tbody>
                  </table>
                </div>
              </div>

            </div>
          </div>


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © Jazz Beans.com 2022</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="assets/vendors/chart.js/Chart.min.js"></script>
  <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
  <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
  <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="assets/js/off-canvas.js"></script>
  <script src="assets/js/hoverable-collapse.js"></script>
  <script src="assets/js/misc.js"></script>
  <script src="assets/js/settings.js"></script>
  <script src="assets/js/todolist.js"></script>
  <!-- endinject -->
  <!-- Custom js for this page -->
  <script src="assets/js/dashboard.js"></script>
  <!-- End custom js for this page -->
</body>

</html>