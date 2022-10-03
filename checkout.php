<?php
require_once "./php/conn.php";
include_once "./methods.php";


?>
<!DOCTYPE html>
<html lang="en">
<style>
  input::-webkit-outer-spin-button,
  input::-webkit-inner-spin-button {
    -webkit-appearance: none;
    margin: 0;
  }
</style>

<head>
  <title>Checkout</title>
  <?php include_once "header.php"; ?>
  <?php
  if (count($_SESSION) == 0) {
    header("Location: http://localhost/jazzbeans/register/register.php");
  }
  assignCart($_SESSION['id']['id']);
  ?>
  <section class="home-slider owl-carousel">
    <div class="slider-item" style="background-image: url(images/bg_3.jpg)" data-stellar-background-ratio="0.5">
      <div class="overlay"></div>
      <div class="container">
        <div class="row slider-text justify-content-center align-items-center">
          <div class="col-md-7 col-sm-12 text-center ftco-animate">
            <h1 class="mb-3 mt-5 bread"><a href="#checkout">Checkout</a></h1>
            <p class="breadcrumbs">
              <span class="mr-2"><a href="shop.html">Shop</a></span>
              <span>Checkout</span>
            </p>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="ftco-section" id="checkout">
    <div class="container">
      <div class="row">
        <div class="col-xl-12 ftco-animate">

          <form action="#" method="POST" class="billing-form  p-3 p-md-5">
            <!-- table --------------------------- -->

            <div class="table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th class="text-white"> Image </th>
                    <th class="text-white"> Name </th>
                    <th class="text-white"> Price </th>
                    <th class="text-white"> Amount </th>
                    <th class="text-white"> Delete </th>
                  </tr>
                </thead>
                <tbody>
                  <!-- fun table "cart" -->
                  <?php



                  $cartItems = getCartProducts($_SESSION['id']['id']);
                  if (isset($_SESSION['id']['id']) && count($cartItems) > 0) {
                    $count = 0;

                    foreach ($cartItems as $item) {


                  ?>

                      <tr>
                        <td class="py-1">
                          <img style="height: 60px ; !important" class=" rounded-circle " src="<?php $imgg = ltrim($item["img"], ".");
                                                                                                echo "." . $imgg;  ?>" alt="image">


                        </td>
                        <td class="text-white"> <?php echo $item["name"];  ?> </td>
                        <td class="text-white">
                          <!-- ------------------------------------ -->
                          <?php
                          if ($item["discount"] && $item["discount"] < $item["price"]) { ?>
                            <h6> <span> <?php echo ($item["discount"]) . " JOD"; ?> </span></h6>
                            <span>
                              <p class="Secondary text"> <s><?php echo ($item["price"]) . " JOD"; ?></s></p>
                            </span>
                          <?php      } else { ?>


                            <p class="price">
                              <span><?php echo  $item["price"] . " JOD"; ?></span>
                            </p>


                          <?php  }

                          ?>

                          <!-- ------------------------------------ -->
                        </td>
                        <td class="text-white"> <input name="quantity<?php echo $count; ?>" value="1" type="number" class="form-control text-white " placeholder=""> </td>
                        <td>
                          <a href="del_cart_item.php?del_cart_id=<?php echo $item["id"];  ?>"> <button type="button" class="btn btn-outline-danger btn-icon-text "> Delete
                            </button></a>
                        </td>
                      </tr>




                    <?php $count++;
                    }
                  } else { ?>
                    <tr>
                      <td class="text-white"> THERE </td>
                      <td class="text-white"> IS </td>
                      <td class="text-white"> NO</td>
                      <td class="py-1">
                        ITEMS
                      </td>
                      <td>
                        <a href="http://localhost/jazzbeans/register/register.php"> <button type="button" class="btn btn-outline-danger btn-icon-text "> Delete
                          </button></a>
                      </td>
                    </tr>

                  <?php  }


                  ?>
                  <!-- fun table "cart" -->


                </tbody>
              </table>
            </div>
            <!-- table--------------- -->
            <h3 class="mb-4 billing-heading">Billing Details</h3>
            <div class="row align-items-end">

              <div class="w-100"></div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="country">City</label>
                  <div class="select-wrap">
                    <div class="icon">
                      <span class="ion-ios-arrow-down"></span>
                    </div>
                    <select name="city" id="" class="form-control" required>
                      <option value="Amman" class="bg-dark">Amman</option>
                      <option value="Irbid" class="bg-dark">Irbid</option>
                      <option value="Zarqa" class="bg-dark">Zarqa</option>
                      <option value="Mafraq" class="bg-dark">Mafraq</option>
                      <option value="Ajloun" class="bg-dark">Ajloun</option>
                      <option value="Jerash" class="bg-dark">Jerash</option>
                      <option value="Madaba" class="bg-dark">Madaba</option>
                      <option value="Balqa" class="bg-dark">Balqa</option>
                      <option value="Karak" class="bg-dark">Karak</option>
                      <option value="Tafileh" class="bg-dark">Tafileh</option>
                      <option value="Maan" class="bg-dark">Maan</option>
                      <option value="Aqaba" class="bg-dark">Aqaba</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="streetaddress">Street Address</label>
                  <input name="streetaddress" type="text" class="form-control" placeholder="House number and street name" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <input name="" type="text" class="form-control" placeholder="Appartment, suite, unit etc: (optional)" />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="towncity">Area</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="postcodezip">Postcode / ZIP </label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="w-100"></div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="phone">Phone</label>
                  <input name="phone" type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="emailaddress">Email Address</label>
                  <input type="text" class="form-control" placeholder="" />
                </div>
              </div>
              <div class="w-100"></div>
              <br>
              <div class="col-12">

                <div class="form-group ">

                  <button name="btn" type="submit" class="btn btn-primary mr-2 col-12 ">Place Order</button>
                </div>

              </div>

            </div>
          </form>
          <!-- END -->


        </div>
        <!-- .col-md-8 -->


      </div>
    </div>
  </section>
  <!-- .section -->
  <!-- handle order php -->
  <?php
  // orders in cart
  $cartItems;

  $userId = (int)$_SESSION['id']['id'];

  if (isset($_POST["btn"])) {



    $invoiceNum = (int)strtok((string)date(microtime(20)), ".");

    $totalPrice = 3;
    for ($i = 0; $i < count($cartItems); $i++) {
      if ($cartItems[$i]['discount'] && $cartItems[$i]['discount'] < $cartItems[$i]['price']) {
        # code...
        $totalPrice = $totalPrice + ((float)$cartItems[$i]['discount'] * (int)$_POST["quantity$i"]);
      } else {
        $totalPrice = $totalPrice + ((float)$cartItems[$i]['price'] * (int)$_POST["quantity$i"]);
      }
    }


    addInvoice($invoiceNum, $userId, $totalPrice);



    $customerInvoice = getInvoiceByNum($invoiceNum);
    for ($i = 0; $i < count($cartItems); $i++) {

      if (addOrder((int)$cartItems[$i]['product_id'], (int)$customerInvoice['id'], (int)$_POST["quantity$i"]) && emptyCart((int)$_SESSION['id']['id'])) {
        // echo "&&&&&&&&&&&&&&&&&&&&&&&&MABROOOOK AGAAAIIINNNNNNNN ";
        // header("location: http://localhost/jazzbeans/purchased.php?i_id=" . $customerInvoice['id']);
        $_SESSION["i_Id"] = trim($customerInvoice['id']);
        echo "<script> location.href = 'http://localhost/jazzbeans/purchased.php'; </script>";
      }
    }
  }


  ?>

  <!-- handle order php -->


  <!-- loader --><?php include_once "footer.php"; ?>
  <div id="ftco-loader" class="show fullscreen">
    <svg class="circular" width="48px" height="48px">
      <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
      <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
    </svg>
  </div>

  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>

  <script>
    $(document).ready(function() {
      var quantitiy = 0;
      $(".quantity-right-plus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($("#quantity").val());

        // If is not undefined

        $("#quantity").val(quantity + 1);

        // Increment
      });

      $(".quantity-left-minus").click(function(e) {
        // Stop acting like a button
        e.preventDefault();
        // Get the field name
        var quantity = parseInt($("#quantity").val());

        // If is not undefined

        // Increment
        if (quantity > 0) {
          $("#quantity").val(quantity - 1);
        }
      });
    });
  </script>
  </body>

</html>