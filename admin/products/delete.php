<?php
if (isset($_GET['pro_id']) && is_numeric($_GET['pro_id'])) {
    $pro_id = $_GET['pro_id'];
    $stmt = $connect->prepare('SELECT * FROM products WHERE id= ?');
    $stmt->execute([$pro_id]);
    $pro_data = $stmt->fetch();
    $count = $stmt->rowCount();
    if ($count > 0) {
        $stmt = $connect->prepare("DELETE FROM  product_details WHERE pro_id =?");
        $stmt->execute(array($pro_id));
        $stmt = $connect->prepare("DELETE FROM  products_image WHERE product_id =?");
        $stmt->execute(array($pro_id));
        $product_image = $stmt->fetch();
        if (!empty($product_image['main_image'])) {
            $pro_image = $product_image['main_image'];
            $product_image = "product_images/" . $pro_image;
            unlink($product_image);
        }
        $stmt = $connect->prepare("DELETE FROM  products_gallary WHERE product_id =?");
        $stmt->execute(array($pro_id));
        $product_image_gallary = $stmt->fetch();
        if (!empty($product_image_gallary['image'])) {
            $pro_image = $product_image_gallary['image'];
            $product_image = "product_images/" . $pro_image;
            unlink($product_image);
        }
        if ($stmt) {
            $stmt = $connect->prepare('DELETE FROM products WHERE id=?');
            $stmt->execute([$pro_id]);
            if ($stmt) {
                $_SESSION['success_message'] = " تم الحذف بنجاح  ";
                header('Location:main?dir=products&page=report');
            }
        }
    }
}
