<?php
ob_start();
session_start();
include "init.php";
if (isset($_GET['cat'])) {
    $cat_slug = $_GET['cat'];
    $stmt = $connect->prepare("SELECT * FROM categories WHERE slug = ?");
    $stmt->execute(array($cat_slug));
    $cat_data = $stmt->fetch();
    $cat_id = $cat_data['id'];
} else {
    header("Location:index");
}
if (isset($_POST['search_button'])) {
    $search_product = $_POST['search_product'];
    $stmt = $connect->prepare("SELECT * FROM products
							INNER JOIN products_image ON products_image.product_id = products.id
							WHERE products.cat_id = ? AND products.publish = 1 AND name LIKE '%$search_product%' ORDER BY products.id DESC");
    $stmt->execute();
    $allproducts = $stmt->fetchAll($cat_id);
} else {
    $stmt = $connect->prepare("SELECT * FROM products
	INNER JOIN products_image ON products_image.product_id = products.id
	WHERE products.cat_id = ? AND products.publish = 1 ORDER BY products.id DESC");
    $stmt->execute(array($cat_id));
    $allproducts = $stmt->fetchAll();
}

?>
<!-- Product -->
<div class="bg0 m-t-23 p-b-140" dir="rtl">
    <div class="container">
        <div class="flex-w flex-sb-m p-b-52">

            <!-- Search product -->
            <div class="dis-none panel-search w-full p-t-10 p-b-15">
                <form action="" method="post">
                    <div class="bor8 dis-flex p-l-15 justify-content-between">
                        <input value="<?php if (isset($_REQUEST['search_product'])) echo $_REQUEST['search_product']; ?>" class="mtext-107 cl2 size-114 plh2 p-r-15" type="text" name="search_product" placeholder="Enter Product Name">
                        <button type="submit" name="search_button" class="btn search_button flex-c-m fs-16 cl2 hov-cl1 trans-04">
                            <i class="fa fa-search"></i> Search
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row isotope-grid">
            <?php
            foreach ($allproducts as $product) {
                $stmt = $connect->prepare("SELECT * FROM categories WHERE id=?");
                $stmt->execute(array($product['cat_id']));
                $category_data = $stmt->fetch();
            ?>
                <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item <?php echo $category_data['slug']; ?>">
                    <!-- Block2 -->
                    <a href="product-detail?slug=<?php echo $product['slug']; ?>">
                        <div class="block2">
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
                    </a>
                </div>
            <?php
            }
            ?>
        </div>

        <!-- Load more
		<div class="flex-c-m flex-w w-full p-t-45">
			<a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
				Load More
			</a>
		</div>
		 -->
    </div>
</div>

<?php
include $tem . "footer.php";
ob_end_flush();

?>