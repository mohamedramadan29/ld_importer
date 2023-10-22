<?php
ob_start();
session_start();
include "init.php";
?>
<!-- Slider -->
<section class="section-slide">
	<div class="wrap-slick1 rs1-slick1">
		<?php
		$stmt = $connect->prepare("SELECT * FROM banners LIMIT 1");
		$stmt->execute();
		$banner1_data = $stmt->fetch();
		$banner1_id = $banner1_data['id'];
		?>
		<div class="slick1">
			<div class="item-slick1" style="background-image:url(admin/banners/images/<?php echo $banner1_data['image']; ?>);">
				<div class="overlay">
					<div class="container h-full" dir="rtl">
						<div class="flex-col-l-m h-full p-t-100 p-b-30">
							<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
								<span class="ltext-202 cl2 respon2">
									<?php echo $banner1_data['description']; ?>
								</span>
							</div>
							<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
								<h1 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
									<?php echo $banner1_data['head_name']; ?>
								</h1>
							</div>
							<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
								<a href="<?php echo $banner1_data['button_url']; ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
									<?php echo $banner1_data['button_text']; ?>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<?php
			$stmt = $connect->prepare("SELECT * FROM banners WHERE id !=?");
			$stmt->execute(array($banner1_id));
			$banners = $stmt->fetchAll();
			foreach ($banners as $banner) {
			?>
				<div class="item-slick1" style="background-image: url(admin/banners/images/<?php echo $banner['image']; ?>);">
					<div class="overlay">
						<div class="container h-full" dir="rtl">
							<div class="flex-col-l-m h-full p-t-100 p-b-30">
								<div class="layer-slick1 animated visible-false" data-appear="fadeInDown" data-delay="0">
									<span class="ltext-202 cl2 respon2">
										<?php echo $banner['description']; ?>
									</span>
								</div>

								<div class="layer-slick1 animated visible-false" data-appear="fadeInUp" data-delay="800">
									<h2 class="ltext-104 cl2 p-t-19 p-b-43 respon1">
										<?php echo $banner['head_name']; ?>
									</h2>
								</div>

								<div class="layer-slick1 animated visible-false" data-appear="slideInUp" data-delay="1600">
									<a href="<?php echo $banner['button_url']; ?>" class="flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04">
										<?php echo $banner['button_text']; ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</section>
<!-- START Product Banner  
<div class="about_us" dir="rtl">
	<div class="container">
		<div class="data">
			<div class="row">
				<div class="col-lg-6">
					<div class="info">
						<?php
						$stmt = $connect->prepare("SELECT * FROM products
						INNER JOIN products_image ON products_image.product_id = products.id
						WHERE products.as_banner = 1  ORDER BY products.id DESC LIMIT 1");
						$stmt->execute();
						$banner_product = $stmt->fetch();
						$banner_product_name = $banner_product['name'];
						$banner_product_description = $banner_product['description'];
						?>
						<h4> <?php echo $banner_product_name ?> </h4>
						<p>
							<?php echo $banner_product_description ?>
						</p>
						<a href="<?php echo $banner_product_name ?>" class="btn"> Read More </a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="info2" style="background-image: url(admin/product_images/<?php echo $banner_product['main_image']; ?>);">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END Broduct Banner -->

<!-- Banner -->
<div class="sec-banner bg0" dir="rtl" style="margin-top: 40px;">
	<div class="container">
		<div class="flex-w flex-c-m">
			<div class="row">
				<?php
				$stmt = $connect->prepare("SELECT * FROM categories WHERE favourite = 1 ORDER BY id DESC");
				$stmt->execute();
				$categories = $stmt->fetchAll();
				foreach ($categories as $category) {
				?>
					<div class="col-lg-4">
						<div class="m-lr-auto respon4">
							<!-- Block1 -->
							<div class="block1 wrap-pic-w" style="margin-bottom: 15px;">
								<img height="240px" loading="lazy" src="admin/category_images/<?php echo $category['image']; ?>" alt="IMG-BANNER">

								<a href="category_models?cat=<?php echo $category['slug']; ?>" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
									<div class="block1-txt-child1 flex-col-l">
										<span class="block1-name ltext-102 trans-04 p-b-8">
											<?php echo $category['name']; ?>
										</span>

									</div>
									<div class="block1-txt-child2 p-b-4 trans-05">
										<div class="block1-link stext-101 cl0 trans-09">
											כל הדגמים
										</div>
									</div>
								</a>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div>
</div>
<!-- START ABOUT US -->
<div class="about_us" dir="rtl">
	<div class="container">
		<div class="data">
			<div class="row">
				<div class="col-lg-6">
					<div class="info">
						<?php
						$stmt = $connect->prepare("SELECT * FROM about_us");
						$stmt->execute();
						$about_us_data = $stmt->fetch();
						$head_name = $about_us_data['head_name'];
						$head_desc = $about_us_data['description'];
						$head_image = $about_us_data['image'];
						$head_button = $about_us_data['button_text'];
						$head_url = $about_us_data['button_url'];
						?>
						<h4> <?php echo $head_name ?> </h4>
						<p>
							<?php echo $head_desc; ?>
						</p>
						<a href="<?php echo $head_url; ?>" class="btn"> <?php echo $head_button; ?> </a>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="info2" style="padding:140px;margin-top:10px; background-image: url(admin/about_us/images/<?php echo $head_image ?>);">

					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END ABOUT US   -->

<!-- Product -->
<section class="sec-product bg0 p-t-100 p-b-50">
	<div class="container">
		<div class="">
			<h3 class="ltext-105 cl5 txt-center respon1 latest_models">
				כל הדגמים
			</h3>
		</div>
		<!-- Tab01 -->
		<div class="tab01">
			<!-- Tab panes -->
			<div class="tab-content" >
				<!-- - -->
				<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">
							<?php
							$stmt = $connect->prepare("SELECT * FROM products
							INNER JOIN products_image ON products_image.product_id = products.id
							ORDER BY products.id DESC LIMIT 6");
							$stmt->execute();
							$allproducts = $stmt->fetchAll();
							foreach ($allproducts as $product) {
								// get product Image

							?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<a href="product-detail?slug=<?php echo $product['slug']; ?>">
										<div class="block2">
											<div class="block2-pic hov-img0">
												<img loading="lazy" src="admin/product_images/<?php echo $product['main_image']; ?>" alt="IMG-PRODUCT">
											</div>
											<div class="block2-txt flex-w flex-t p-t-14">
												<div class="block2-txt-child1 flex-col-l" dir="rtl">
													<a href="product-detail?slug=<?php echo $product['slug']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
														<?php echo $product['name']; ?>
													</a>
													<?php
													if (!empty($product['sale_price']) && $product['sale_price'] != 0) {
													?>
														<div class="d-flex">
															<span style="margin-right:10px ; color:var(--main_color);" class="stext-105 cl3">
																₪<?php echo $product['sale_price']; ?>
															</span>
															<span class="stext-105 cl3" style="text-decoration-line: line-through;">
																₪<?php echo $product['price']; ?>
															</span>
														</div>
													<?php
													} else {
													?>
														<span class="stext-105 cl3">
															₪<?php echo $product['price']; ?>
														</span>
													<?php
													}
													?>
												</div>
											</div>
										</div>
									</a>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!--   START BANNER   -->
<?php
$stmt = $connect->prepare("SELECT * FROM main_banner");
$stmt->execute();
$banner_data = $stmt->fetch();
$banner_name = $banner_data['head_name'];
$banner_desc = $banner_data['description'];
$banner_image = $banner_data['image'];
$banner_button = $banner_data['button_text'];
$banner_url = $banner_data['button_url'];
?>
<div class="banner" style="background-image: url(admin/main_banner/images/<?php echo $banner_image; ?>);">
	<div class="container">
		<div class="data">
			<div class="info">

				<h2> <?php echo $banner_name; ?> </h2>
				<p> <?php echo $banner_desc; ?> </p>
				<a href="<?php echo $banner_url; ?>" class="btn"> <?php echo $banner_button; ?> </a>
			</div>
		</div>
	</div>
</div>
<!--  END BANNER -->

<!-- Product -->
<section class="sec-product bg0 p-t-100 p-b-50">
	<div class="container">
		<div class="">
			<h3 class="ltext-105 cl5 txt-center respon1 latest_models">
				הדגמים הטובים ביותר
			</h3>
		</div>
		<!-- Tab01 -->
		<div class="tab01">
			<!-- Tab panes -->
			<div class="tab-content"  >
				<!-- - -->
				<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">
							<?php
							$stmt = $connect->prepare("SELECT * FROM products
							INNER JOIN products_image ON products_image.product_id = products.id
							WHERE products.feature_product = 1 ORDER BY products.id DESC LIMIT 6");
							$stmt->execute();
							$allproducts = $stmt->fetchAll();
							foreach ($allproducts as $product) {
								// get product Image
							?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<a href="product-detail?slug=<?php echo $product['slug']; ?>">
										<div class="block2">
											<div class="block2-pic hov-img0">
												<img loading="lazy" src="admin/product_images/<?php echo $product['main_image']; ?>" alt="IMG-PRODUCT">
											</div>
											<div class="block2-txt flex-w flex-t p-t-14">
												<div class="block2-txt-child1 flex-col-l" dir="rtl">
													<a href="product-detail?slug=<?php echo $product['slug']; ?>" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
														<?php echo $product['name']; ?>
													</a>
													<?php
													if (!empty($product['sale_price']) && $product['sale_price'] != 0) {
													?>
														<div class="d-flex">
															<span style="margin-right:10px ; color:var(--main_color);" class="stext-105 cl3">
																₪<?php echo $product['sale_price']; ?>
															</span>
															<span class="stext-105 cl3" style="text-decoration-line: line-through;">
																₪<?php echo $product['price']; ?>
															</span>
														</div>
													<?php
													} else {
													?>
														<span class="stext-105 cl3">
															₪<?php echo $product['price']; ?>
														</span>
													<?php
													}
													?>
												</div>
											</div>
										</div>
									</a>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- START STORE ADVANTAGE -->
<div class="store_advantage">
	<div class="container">
		<div class="data">
			<h3> Our advantages </h3>
			<div class="row">
				<div class="col-lg-3">
					<div class="info">
						<i class="fa fa-paypal"></i>
						<h2> Competitive prices </h2>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="info">
						<i class="fa fa-truck"></i>
						<h2> Competitive prices </h2>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="info">
						<i class="fa fa-eye"></i>
						<h2> Competitive prices </h2>
					</div>
				</div>
				<div class="col-lg-3">
					<div class="info">
						<i class="fa fa-address-book"></i>
						<h2> Competitive prices </h2>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- END STORE ADVANTAGE -->
<?php
include $tem . "footer.php";
ob_end_flush();

?>