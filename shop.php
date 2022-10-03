<?php
include "./php/conn.php";
include_once "methods.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title>Our Shop</title>
	<?php include "header.php"; ?>
	<section class="home-slider owl-carousel">
		<div class="slider-item" style="background-image: url(images/bg_3.jpg)" data-stellar-background-ratio="0.5">
			<div class="overlay"></div>
			<div class="container">
				<div class="row slider-text justify-content-center align-items-center">
					<div class="col-md-7 col-sm-12 text-center ftco-animate">
						<h1 class="mb-3 mt-5 bread"><a href="#checkout">Order Online</a></h1>
						<p class="breadcrumbs">
							<span class="mr-2"><a href="index.html">Home</a></span>
							<span>Shop</span>
						</p>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="ftco-section" id="checkout">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 ftco-animate">
					<div class="container">
						<div class="row d-md-flex">
							<div class="col-lg-12 ftco-animate p-md-5">
								<div class="row">
									<div class="col-md-12 nav-link-wrap mb-5">
										<div class="nav ftco-animate nav-pills justify-content-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
											<!--  -->
											<a class="nav-link active" id="v-pills-a-tab" data-toggle="pill" href="#v-pills-a" role="tab" aria-controls="v-pills-a" aria-selected="true">All Products </a>
											<?php
											$allCategory = getAllCategories();
											foreach ($allCategory as $category) {
											?>
												<a class="nav-link" id="v-pills-<?php echo $category["id"]; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $category["id"]; ?>" role="tab" aria-controls="v-pills-<?php echo $category["id"]; ?>" aria-selected="true"><?php echo $category["name"]; ?></a>
											<?php
											}
											?>



										</div>
									</div>
									<div class="col-md-12 d-flex align-items-center">

										<div class="tab-content ftco-animate" id="v-pills-tabContent">

											<!--Bill-0 Coffee-->
											<div class="tab-pane fade show active" id="v-pills-a" role="tabpanel" aria-labelledby="v-pills-a-tab">
												<div class="row ">
													<?php

													$allProduct = getAllProduct();
													if (isset($_POST['srch'])) {
														$search = $_POST['srch'];
														$pattern = "$search";
														$sql = "SELECT * FROM products WHERE products . name REGEXP '$pattern' ";

														$query = connect()->prepare($sql);


														$query->execute();
														$results = $query->fetchAll();
														// var_dump($results);
														foreach ($results as $result) {
													?>
															<div class="col-md-4">
																<div class="menu-entry">
																	<a href="product-single.php?p_id=<?php echo $result["id"]; ?>" class="img" style="background-image: url(<?php $imgg = ltrim($result["img"], ".");
																																											echo "." . $imgg;  ?>); "></a>
																	<div class="text text-center pt-4">
																		<h3>
																			<a href="product-single.php?p_id=<?php echo $result["id"]; ?>"><?php echo $result["name"]; ?></a>
																		</h3>
																		<p><?php echo $result["short_desc"]; ?></p>
																		<!-- ------------------------------------ -->
																		<?php
																		if ($result["discount"] && $result["discount"] < $result["price"]) { ?>
																			<h6> <span> <?php echo ($result["discount"]) . " JOD"; ?> </span></h6>
																			<span>
																				<p class="Secondary text"> <s><?php echo ($result["price"]) . " JOD"; ?></s></p>
																			</span>
																		<?php 		 } else { ?>


																			<p class="price">
																				<span><?php echo  $result["price"] . " JOD"; ?></span>
																			</p>


																		<?php	}

																		?>

																		<!-- ------------------------------------ -->


																		<p>
																			<a id="Anchor" onclick=" addToCart(<?php if (count($_SESSION) > 0) { ?>
																												<?php echo $_SESSION['id']['id']; ?>
																												<?php		} else { ?>
																													<?php echo 1; ?>
																													<?php	}; ?> , <?php echo $result['id']; ?>)" class="btn btn-primary btn-outline-primary">Add to cart</a>
																		</p>
																	</div>
																</div>
															</div>

														<?php



														}
													} elseif (isset($_POST['start_price']) && isset($_POST['end_price'])) {
														$startprice = $_POST['start_price'];
														$endprice = $_POST['end_price'];
														$sql = "SELECT * FROM products WHERE price BETWEEN $startprice AND $endprice ";
														$query = connect()->prepare($sql);
														$query->execute();
														$filters = $query->fetchAll();
														foreach ($filters as $filter) {
														?>
															<div class="col-md-3">
																<div class="menu-entry">
																	<a href="product-single.php?p_id=<?php echo $filter["id"]; ?>" class="img" style="
																		background-image: url(<?php $imgg = ltrim($filter["img"], ".");
																								echo "." . $imgg;  ?>);
																			"></a>
																	<div class="text text-center pt-4">
																		<h3>
																			<a href="product-single.php?p_id=<?php echo $filter["id"]; ?>"><?php echo $filter["name"]; ?></a>
																		</h3>
																		<p><?php echo $filter["short_desc"]; ?></p>
																		<!-- ------------------------------------ -->
																		<?php
																		if ($filter["discount"] && $filter["discount"] < $filter["price"]) { ?>
																			<h6> <span> <?php echo ($filter["discount"]) . " JOD"; ?> </span></h6>
																			<span>
																				<p class="Secondary text"> <s><?php echo ($filter["price"]) . " JOD"; ?></s></p>
																			</span>
																		<?php 		 } else { ?>


																			<p class="price">
																				<span><?php echo  $filter["price"] . " JOD"; ?></span>
																			</p>


																		<?php	}

																		?>

																		<!-- ------------------------------------ -->
																		<p>
																			<a id="Anchor" onclick=" addToCart(<?php if (count($_SESSION) > 0) { ?>
																												<?php echo $_SESSION['id']['id']; ?>
																												<?php		} else { ?>
																													<?php echo 1; ?>
																													<?php	}; ?> , <?php echo $filter['id']; ?>)" class="btn btn-primary btn-outline-primary">Add to cart</a>
																		</p>
																	</div>
																</div>
															</div>
														<?php
														}
													} else {
														foreach ($allProduct as $product) {
														?>
															<div class="col-md-3">
																<div class="menu-entry">
																	<a href="product-single.php?p_id=<?php echo $product["id"]; ?>" class="img" style="
																		background-image: url(<?php $imgg = ltrim($product["img"], ".");
																								echo "." . $imgg;  ?>);
																			"></a>
																	<div class="text text-center pt-4">
																		<h3>
																			<a href="product-single.php?p_id=<?php echo $product["id"]; ?>"><?php echo $product["name"]; ?></a>
																		</h3>
																		<p><?php echo $product["short_desc"]; ?></p>
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
													<?php }
													} ?>
												</div>
											</div>

											<!--Bill-0 Coffee-->
											<?php
											foreach ($allCategory as $category) {
											?>
												<div class="tab-pane fade show" id="v-pills-<?php echo $category["id"]; ?>" role="tabpanel" aria-labelledby="v-pills-<?php echo $category["id"]; ?>-tab">
													<div class="row">
														<?php
														$products = getProductsFromCategory($category["id"]);

														foreach ($products as $product) {

														?>
															<div class="col-md-4 text-center">
																<div class="menu-wrap">
																	<a href="product-single.php?p_id=<?php echo $product["id"]; ?>" class="menu-img img mb-4" style="background-image: url(<?php $imgg = ltrim($product["img"], ".");
																																															echo "." . $imgg;  ?>);"></a>
																	<div class="text">
																		<h3>
																			<a href="product-single.php?p_id=<?php echo $product["id"]; ?>"><?php echo $product["name"]; ?></a>
																		</h3>
																		<p><?php echo $product["short_desc"]; ?></p>
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
														<?php }

														?>
													</div>
												</div>
											<?php } ?>


										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!-- .col-md-8 -->

				<div class="col-xl-4 sidebar ftco-animate">
					<div class="sidebar-box">
						<form action="shop.php" method="post" class="search-form">
							<div class="form-group">
								<div class="icon">
									<span class="icon-search"></span>
								</div>
								<p>
									<a href="shop.php" class="btn btn-primary btn-outline-primary">Clear Filters</a>
								</p>
								<input type="text" class="form-control" name="srch" placeholder="Search..." required />

							</div>
						</form>
					</div>

					<div class="sidebar-box ftco-animate">
						<div class="filter">
							<form action="" method="post">
								<div class="row">
									<div class="col-md-4">
										<input type="text" name="start_price" value="<?php if (isset($_POST['start_price'])) {
																							echo $_POST['start_price'];
																						} else {
																							echo "0";
																						} ?>" class="form-control">
									</div>
									<div class="col-md-4">
										<input type="text" name="end_price" value="<?php if (isset($_POST['end_price'])) {
																						echo $_POST['end_price'];
																					} else {
																						echo "500";
																					} ?>" class="form-control">
									</div>
									<div class="col-md-4">
										<label for=""></label> <br />
										<button type="submit" class="btn btn-primary px-4">Filter</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php include "footer.php"; ?>
	<!-- loader -->
	<div id="ftco-loader" class="show fullscreen">
		<svg class="circular" width="48px" height="48px">
			<circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee" />
			<circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00" />
		</svg>
	</div>

	<!-- <script src="jazzbeans/register/javascript/logout.js"></script> -->
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