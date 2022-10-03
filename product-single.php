<?php require_once "./php/conn.php";
include_once "./methods.php";
$id = $_REQUEST["p_id"];
$product = getSingleProduct($id);
//  print_r($product);
//  die;
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Details</title>
	<?php include_once "header.php"; ?>
	<!-- END nav -->

	<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image: url(images/bg_3.jpg)" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center">
					<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 bread">Product Detail</h1>
						<p class="breadcrumbs">
							<span class="mr-2"><a href="shop.php">Shop</a></span>
							<span>Product Detail</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mb-5 ftco-animate">
					<a href="product img url" class="image-popup"><img src="<?php $imgg = ltrim($product["img"], ".");
																			echo "." . $imgg;  ?>" class="img-fluid" alt="Colorlib Template" /></a>
				</div>
				<div class="col-lg-6 product-details pl-md-5 ftco-animate">
					<h3><?php echo ($product["name"]); ?></h3>
					<!-- ------------------------------------ -->
					<?php
					if ($product["discount"] && $product["discount"] < $product["price"]) { ?>
						<h6> <span> <?php echo ($product["discount"]) . " JOD"; ?> </span></h6>
						<span>
							<p class="Secondary text"> <s><?php echo ($product["price"]) . " JOD"; ?></s></p>
						</span>
					<?php 		 } else { ?>


						<p class="price">
							<span><?php echo  $product["price"] . " JOD"; ?></span>
						</p>


					<?php	}

					?>

					<!-- ------------------------------------ -->
					<p><?php echo ($product["short_desc"]); ?></p>
					<br>
					<p><?php echo ($product["description"]); ?></p>
					<div class="row mt-4">
						<div class="w-100"></div>

					</div>
					<p>
						<a id="Anchor" onclick=" addToCart(<?php if (count($_SESSION) > 0) { ?>
																												<?php echo $_SESSION['id']['id']; ?>
																												<?php		} else { ?>
																													<?php echo 1; ?>
																													<?php	}; ?> , <?php echo $product['id']; ?>)" class="btn btn-primary btn-outline-primary">Add to cart</a>
					</p>
				</div>
			</div>
		</div>
	</section>
	<!-- Related Section  -->
	<?php
	$pCateg = $product["category_id"];
	?>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center mb-5 pb-3">
				<div class="col-md-7 heading-section ftco-animate text-center">
					<span class="subheading">Discover</span>
					<h2 class="mb-4">Related products</h2>
					<p></p>
				</div>
			</div>
			<div class="row">
				<?php
				$arr = getProductsFromCategory($pCateg);
				shuffle($arr);
				for ($i = 0; $i < count($arr) && $i < 4; $i++) { ?>

					<div class="col-md-3">
						<div class="menu-entry">
							<a href="http://localhost/jazzbeans/product-single.php?p_id=<?php echo ($arr[$i]["id"]); ?>" class="img" style="background-image: url(<?php $imgg = ltrim($arr[$i]["img"], ".");
																																									echo "." . $imgg;  ?>)"></a>
							<div class="text text-center pt-4">
								<h3><a href="http://localhost/jazzbeans/product-single.php?p_id=<?php echo ($arr[$i]["id"]); ?>"><?php echo ($arr[$i]["name"]); ?></a></h3>
								<p>
									<?php echo ($arr[$i]["short_desc"]); ?>
								</p>
								<!-- .................. -->
								<?php
								if ($arr[$i]["discount"] && $arr[$i]["discount"] < $arr[$i]["price"]) { ?>
									<h6> <span> <?php echo ($arr[$i]["discount"]) . " JOD"; ?> </span></h6>
									<span>
										<p class="Secondary text"> <s><?php echo ($arr[$i]["price"]) . " JOD"; ?></s></p>
									</span>
								<?php 		 } else { ?>


									<p class="price">
										<span><?php echo  $product["price"] . " JOD"; ?></span>
									</p>


								<?php	}

								?>

								<!-- ------------------------------------ -->
								<p>
									<a id="Anchor" onclick=" addToCart(<?php if (count($_SESSION) > 0) { ?>
																												<?php echo $_SESSION['id']['id']; ?>
																												<?php		} else { ?>
																													<?php echo 1; ?>
																													<?php	}; ?> , <?php echo $arr[$i]['id']; ?>)" class="btn btn-primary btn-outline-primary">Add to cart</a>
								</p>
							</div>
						</div>
					</div>

				<?php
				}
				?>
			</div>
		</div>
	</section>

	<!-- loader --><?php include_once "footer.php"; ?>
	<div id="ftco-loader" class="show fullscreen">
		<svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg>
	</div>
	<script src="./cart.js"></script>
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


	</body>

</html>