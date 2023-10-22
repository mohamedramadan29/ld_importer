<?php
ob_start();
session_start();
include "init.php";
if (isset($_GET['slug'])) {
	$slug = $_GET['slug'];
	$stmt = $connect->prepare("SELECT * FROM products WHERE slug = ?");
	$stmt->execute(array($slug));
	$product_data = $stmt->fetch();
	// get product category
	$stmt = $connect->prepare("SELECT * FROM categories WHERE id = ? ");
	$stmt->execute(array($product_data['cat_id']));
	$category_data = $stmt->fetch();
	// get product Image
	$stmt = $connect->prepare("SELECT * FROM products_image WHERE product_id = ? ");
	$stmt->execute(array($product_data['id']));
	$product_image = $stmt->fetch();
}
?>
<!-- breadcrumb -->
<div class="container" dir="rtl">
	<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
		<a href="index" class="stext-109 cl8 hov-cl1 trans-04">
			Home
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<a href="category_models?cat=<?php echo $category_data['slug']; ?>" class="stext-109 cl8 hov-cl1 trans-04">
			<?php echo $category_data['name'] ?>
			<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
		</a>

		<span class="stext-109 cl4">
			<?php echo $product_data['name'] ?>
		</span>
	</div>
</div>
<!-- Product Detail -->
<section class="sec-product-detail bg0 p-t-65 p-b-60">
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-lg-7 p-b-30">
				<div class="p-l-25 p-r-30 p-lr-0-lg">
					<div class="wrap-slick3 flex-sb flex-w">
						<div class="wrap-slick3-dots"></div>
						<div class="wrap-slick3-arrows flex-sb-m flex-w"></div>
						<div class="slick3 gallery-lb">
							<div class="item-slick3" data-thumb="admin/product_images/<?php echo $product_image['main_image']; ?>">
								<div class="wrap-pic-w pos-relative">
									<img loading="lazy" src="admin/product_images/<?php echo $product_image['main_image']; ?>" alt="IMG-PRODUCT">
									<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="admin/product_images/<?php echo $product_image['main_image']; ?>">
										<i class="fa fa-expand"></i>
									</a>
								</div>
							</div>
							<!-- get product Gallary -->
							<?php
							$stmt = $connect->prepare("SELECT * FROM products_gallary WHERE product_id = ?");
							$stmt->execute(array($product_data['id']));
							$allgallary = $stmt->fetchAll();
							foreach ($allgallary as $gallary) {
							?>
								<div class="item-slick3" data-thumb="admin/product_images/<?php echo $gallary['image']; ?>">
									<div class="wrap-pic-w pos-relative">
										<img loading="lazy" src="admin/product_images/<?php echo $gallary['image']; ?>" alt="IMG-PRODUCT">
										<a class="flex-c-m size-108 how-pos1 bor0 fs-16 cl10 bg0 hov-btn3 trans-04" href="admin/product_images/<?php echo $gallary['image']; ?>">
											<i class="fa fa-expand"></i>
										</a>
									</div>
								</div>
							<?php
							}
							?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-6 col-lg-5 p-b-30 product_details">
				<div class="p-t-5 p-lr-0-lg" dir="rtl">
					<h4 style="color: var(--main_color);font-size: 26px;" class="mtext-105 cl2 js-name-detail p-b-14">
						<?php echo $product_data['name'] ?>
					</h4>
					<span class="mtext-106 cl2">
						<?php
						if (!empty($product_data['sale_price']) && $product_data['sale_price'] != 0) {
						?>
							<div class="d-flex">
								<span style="margin-right:10px ;font-weight: bold; font-size: 21px; color:var(--main_color);" class="stext-105 cl3">
									₪<?php echo $product_data['sale_price']; ?>
								</span>
								<span class="stext-105 cl3" style="font-size: 21px;text-decoration-line: line-through;">
									₪<?php echo $product_data['price']; ?>
								</span>
							</div>
						<?php
						} else {
						?>
							<span class="stext-105 cl3" style="font-size: 21px;">
								₪<?php echo $product_data['price']; ?>
							</span>
						<?php
						}
						?>
					</span>
					<p class="stext-102 cl3 p-t-23">
						<?php echo $product_data['description']; ?>
					</p>
					<br>
					<table class="table table-bordered">
						<tr dir="rtl" class="text-right">
							<th class="text-right"> מחיר </th>
							<th class="text-right" style="color: var(--main_color);"> <?php
																						if (!empty($product_data['sale_price']) && $product_data['sale_price'] != 0) {
																						?>
									<div class="d-flex">
										<span style="margin-right:10px ;font-weight: bold;color:var(--main_color);" class="stext-105 cl3">
											₪<?php echo $product_data['sale_price']; ?>
										</span>
										<span class="stext-105 cl3" style="text-decoration-line: line-through;">
											₪<?php echo $product_data['price']; ?>
										</span>
									</div>
								<?php
																						} else {
								?>
									<span class="stext-105 cl3" style="font-size: 21px;">
										₪<?php echo $product_data['price']; ?>
									</span>
								<?php
																						}
								?>
							</th>
						</tr>
						<tr>

							<?php
							if ($product_data['av_num'] != 0 && $product_data['av_num'] != null) {
							?>
								<th class="text-right"> זמין במלאי </th>
								<th style="color: var(--main_color);" class="text-right"> <?php echo $product_data['av_num'] ?> </th>
							<?php
							} else { ?>
								<th class="text-right" style="text-decoration: line-through;"> זמין במלאי </th>
								<th class="text-right" style="color: var(--main_color);"> לא זמין </th>
							<?php
							}
							?>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- Related Product  -->
<section class="sec-product bg0 p-t-100 p-b-50">
	<div class="container">
		<div class="">
			<h3 class="ltext-105 cl5 txt-center respon1 latest_models">
				Related Models
			</h3>
		</div>
		<!-- Tab01 -->
		<div class="tab01">
			<!-- Tab panes -->
			<div class="tab-content">
				<!-- - -->
				<div class="tab-pane fade show active" id="best-seller" role="tabpanel">
					<!-- Slide2 -->
					<div class="wrap-slick2">
						<div class="slick2">
							<?php
							$stmt = $connect->prepare("SELECT * FROM products
							INNER JOIN products_image ON products_image.product_id = products.id
							WHERE products.cat_id = ? AND products.id != ? ORDER BY products.id DESC LIMIT 6");
							$stmt->execute(array($category_data['id'], $product_data['id']));
							$allproducts = $stmt->fetchAll();
							foreach ($allproducts as $product) {
								// get product Image

							?>
								<div class="item-slick2 p-l-15 p-r-15 p-t-15 p-b-15">
									<!-- Block2 -->
									<div class="block2" dir="rtl">
										<div class="block2-pic hov-img0">
											<img loading="lazy" src="admin/product_images/<?php echo $product['main_image']; ?>" alt="IMG-PRODUCT">
										</div>
										<div class="block2-txt flex-w flex-t p-t-14">
											<div class="block2-txt-child1 flex-col-l ">
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

<?php
include $tem . "footer.php";
ob_end_flush();

?>