<?php

if (isset($_POST['add_pro'])) {
  $formerror = [];
  $cat_id = $_POST['cat_id'];
  $name = $_POST['name'];
  $slug = createSlug($name);
  $description = $_POST['description'];
  $price = $_POST['price'];
  $purchase_price = $_POST['purchase_price'];
  $sale_price = $_POST['sale_price'];
  $av_num = $_POST['av_num'];
  $tags = $_POST['tags'];
  $publish = $_POST['publish'];
  /**
   * More Attribute For Main Image
   */
  $image_name = $_POST['image_name'];
  $image_alt = $_POST['image_alt'];
  $image_desc = $_POST['image_desc'];
  $image_keys = $_POST['image_keys'];
 
  // main image
  if (empty($formerror)) {
    if (!empty($_FILES['main_image']['name'])) {
      $main_image_name = $_FILES['main_image']['name'];
      $main_image_name = str_replace(' ', '-', $main_image_name);
      $main_image_temp = $_FILES['main_image']['tmp_name'];
      $main_image_type = $_FILES['main_image']['type'];
      $main_image_size = $_FILES['main_image']['size'];
      $main_image_uploaded = time() . '_' . $main_image_name;
      $upload_path = 'product_images/' . $main_image_uploaded;
      // Move the uploaded image to its destination
      move_uploaded_file($main_image_temp, $upload_path);
      // Check the image type and convert it to WebP if it's supported
      if (exif_imagetype($upload_path) === IMAGETYPE_JPEG) {
        $image = imagecreatefromjpeg($upload_path);
      } elseif (exif_imagetype($upload_path) === IMAGETYPE_PNG) {
        $image = imagecreatefrompng($upload_path);
      }
      if ($image !== false) {
        $webp_path = 'product_images/' . pathinfo($main_image_uploaded, PATHINFO_FILENAME) . '.webp';
        // Save the image as WebP
        imagewebp($image, $webp_path);
        // Clean up memory
        imagedestroy($image);
        // Update the uploaded image path to the WebP version
        $main_image_uploaded = pathinfo($main_image_uploaded, PATHINFO_FILENAME) . '.webp';
      }
    } else {
      $formerror[] = ' من فضلك ادخل صورة  المنتج   ';
    }
  }
  // Insert Product Gallary
  if (!empty($_FILES['more_images']['name'])) {
    $image_names = $_POST['image_name_gallary'];
    $image_alts = $_POST['image_alt_gallary'];
    $image_descs = $_POST['image_desc_gallary'];
    $image_keyss = $_POST['image_keys_gallary'];
    $total_images = count($_FILES['more_images']['name']);
  } else {
    $total_images = 0;
  }
  if (empty($name)) {
    $formerror[] = ' من فضلك ادخل اسم المنتج   ';
  }
  if (empty($price)) {
    $formerror[] = ' من فضلك ادخل سعر المنتج   ';
  }
  if (empty($cat_id)) {
    $formerror[] = ' من فضلك ادخل قسم المنتج   ';
  }

  if (empty($formerror)) {
    $stmt = $connect->prepare("INSERT INTO products (cat_id,name, slug , description,purchase_price,
    price, sale_price , av_num,tags,publish)
    VALUES (:zcat,:zname,:zslug,:zdesc,:zpurchase_price,:zprice,:zsale_price,:zav_num,:ztags,:zpublish)");
    $stmt->execute(array(
      "zcat" => $cat_id,
      "zname" => $name,
      "zslug" => $slug,
      "zdesc" => $description,
      "zpurchase_price" => $purchase_price,
      "zprice" => $price,
      "zsale_price" => $sale_price,
      "zav_num" => $av_num,
      "ztags" => $tags,
      "zpublish" => $publish
    ));
    // get the last product
    $stmt = $connect->prepare("SELECT * FROM products ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $last_product = $stmt->fetch();
    $last_pro_id = $last_product['id'];
    // Insert Main Images To db 
    $stmt = $connect->prepare("INSERT INTO products_image (product_id, main_image,image_name, image_alt , image_desc,image_keys)
    VALUES(:zproduct_id,:zmain_image,:zimage_name,:zimage_alt, :zimage_desc,:zimage_keys)");
    $stmt->execute(array(
      "zproduct_id" => $last_pro_id,
      "zmain_image" => $main_image_uploaded,
      "zimage_name" => $image_name,
      "zimage_alt" => $image_alt,
      "zimage_desc" => $image_desc,
      "zimage_keys" => $image_keys,
    ));
    // Insert Product Gallery To db 
    if ($total_images > 0) {

      for ($i = 0; $i < $total_images; $i++) {
        $new_image_name = $image_names[$i];
        $image_alt = $image_alts[$i];
        $image_desc = $image_descs[$i];
        $image_keys_gal = $image_keyss[$i];
        $image_name = $_FILES['more_images']['name'][$i];
        $image_name = str_replace(' ', '-', $image_name);
        $image_temp = $_FILES['more_images']['tmp_name'][$i];
        $image_type = $_FILES['more_images']['type'][$i];
        $image_size = $_FILES['more_images']['size'][$i];
        $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);
        if (!empty($new_image_name)) {
          $new_image_name = str_replace(' ', '-', $new_image_name);
          $main_image_uploaded = $new_image_name . '.' . $image_extension;
          move_uploaded_file(
            $image_temp,
            'product_images/' . $main_image_uploaded
          );
        } else {
          $main_image_uploaded = $image_name;
          move_uploaded_file(
            $image_temp,
            'product_images/' . $main_image_uploaded
          );
        }
        $stmt = $connect->prepare("INSERT INTO products_gallary (product_id,image,image_name, image_alt , image_desc,image_keys)
      VALUES(:zproduct_id,:zimage,:zimage_name,:zimage_alt, :zimage_desc,:zimage_keys_gal)");
        $stmt->execute(array(
          "zproduct_id" => $last_pro_id,
          "zimage" => $main_image_uploaded,
          "zimage_name" => $new_image_name,
          "zimage_alt" => $image_alt,
          "zimage_desc" => $image_desc,
          "zimage_keys_gal" => $image_keys_gal,
        ));
      }
    }
    ////////////////////////////////
    /*
    $vartions_name = $_POST['vartions_name'];

    $vartions_price = $_POST['vartions_price'];
    if ($vartions_name > 0) {
      for ($i = 0; $i < count($vartions_name); $i++) {
        $vartion_name =   $vartions_name[$i];
        $vartion_price =  $vartions_price[$i];
        //////////// attribute images //////////////
        $image_att_name = $_FILES['vartions_image']['name'][$i];
        $image_att_name = str_replace(' ', '-', $image_att_name);
        $image_att_temp = $_FILES['vartions_image']['tmp_name'][$i];
        $image_att_type = $_FILES['vartions_image']['type'][$i];
        $image_att_size = $_FILES['vartions_image']['size'][$i];
        $image_extension = pathinfo($image_att_name, PATHINFO_EXTENSION);
        $main_image_uploaded = $image_att_name;
        move_uploaded_file(
          $image_att_temp,
          'product_images/' . $main_image_uploaded
        );
        $stmt = $connect->prepare("INSERT INTO product_details2 (product_id,vartions_name,price,image) VALUES 
          (:zpro_id,:zvartion_name,:zprice,:zimage)");
        $stmt->execute(array(
          "zpro_id" => $last_pro_id,
          "zvartion_name" => $vartion_name,
          "zprice" => $vartion_price,
          "zimage" => $main_image_uploaded,
        ));
      }
    }*/
    if ($stmt) {
      $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";

      if (isset($_SESSION['success_message'])) {
        $message = $_SESSION['success_message'];
        unset($_SESSION['success_message']);
?>
        <?php
        ?>
        <script src="plugins/jquery/jquery.min.js"></script>
        <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
        <script>
          $(function() {
            Swal.fire({
              position: 'center',
              icon: 'success',
              title: '<?php echo $message; ?>',
              showConfirmButton: false,
              timer: 2000
            })
          })
        </script>
      <?php
      }
      header('Location:main?dir=products&page=add');
    }
  } else {
    $_SESSION['error_messages'] = $formerror;
    foreach ($formerror as $error) {
      ?>
      <div class="alert alert-danger alert-dismissible" style="max-width: 800px; margin:20px">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <?php echo $error; ?>
      </div>
<?php
    }
    unset($_SESSION['error_messages']);
  }
}
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1 class="m-0 text-dark"> اضافة منتج </h1>
      </div>
      <!-- /.col -->
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-left">
          <li class="breadcrumb-item"><a href="main.php?dir=dashboard&page=dashboard">الرئيسية</a></li>
          <li class="breadcrumb-item active"> اضافة منتج </li>
        </ol>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container-fluid -->
</section>
<!-- /.content-header -->
<!-- DOM/Jquery table start -->
<section class="content">
  <div class="container-fluid">
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="row">
        <div class="col-md-6">
          <div class="card card-primary">
            <div class="card-body">
              <div class="form-group">
                <label for="inputName"> الأسم </label>
                <input required type="text" id="name" name="name" class="form-control" value="<?php if (isset($_REQUEST['name'])) echo $_REQUEST['name'] ?>">
              </div>
              <div class='form-group'>
                <label> الوصف </label>
                <textarea name="description" class="form-control" id="summernote" rows="4" style="min-height: 200px;"> <?php if (isset($_REQUEST['description'])) echo $_REQUEST['description'] ?> </textarea>
              </div>
              <div class="form-group">
                <label for="inputStatus"> القسم </label>
                <select required id="" class="form-control custom-select select2" name="cat_id">
                  <option selected disabled> -- اختر -- </option>
                  <?php
                  $stmt = $connect->prepare("SELECT * FROM categories");
                  $stmt->execute();
                  $allcat = $stmt->fetchAll();
                  foreach ($allcat as $cat) {
                  ?>
                    <option <?php if (isset($_REQUEST['cat_id']) && $_REQUEST['cat_id'] == $cat['id']) echo "selected"; ?> value="<?php echo $cat['id']; ?>"> <?php echo $cat['name'] ?> </option>
                  <?php
                  }
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label for="Company-2" class="block"> اضافة التاج <span class="badge badge-danger"> من فضلك افصل بين كل تاج والاخر (,) </span> </label>
                <input required id="Company-2" name="tags" type="text" class="form-control">
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <div class="col-md-6">
          <div class="card card-secondary">
            <div class="card-body">
              <div class="form-group">
                <label for="inputEstimatedBudget"> سعر الشراء </label>
                <input type="number" id="purchase_price" name="purchase_price" class="form-control" value="<?php if (isset($_REQUEST['purchase_price'])) echo $_REQUEST['purchase_price'] ?>">
              </div>
              <div class="form-group">
                <label for="inputEstimatedBudget"> سعر البيع </label>
                <input required type="number" id="price" name="price" class="form-control" value="<?php if (isset($_REQUEST['price'])) echo $_REQUEST['price'] ?>">
              </div>
              <div class="form-group">
                <label for="inputEstimatedBudget"> سعر التخفيض </label>
                <input type="number" id="sale_price" name="sale_price" class="form-control" value="<?php if (isset($_REQUEST['sale_price'])) echo $_REQUEST['sale_price'] ?>">
              </div>
              <div class="form-group">
                <label for="inputEstimatedBudget"> العدد المتاح </label>
                <input type="number" id="av_num" name="av_num" class="form-control" value="<?php if (isset($_REQUEST['av_num'])) echo $_REQUEST['av_num'] ?>">
              </div>
              <div class="form-group">
                <label for="customFile"> صورة المنتج </label>
                <input type="file" class="dropify" multiple data-height="150" data-allowed-file-extensions="jpg jpeg png svg webp" data-max-file-size="4M" name="main_image" data-show-loader="true" />
                <br>
                <p class="btn btn-warning btn-sm" id="show_details_image"> تفاصيل اضافية <i class="fa fa-plus"></i> </p>
                <style>
                  .image_details {
                    display: none;
                  }
                </style>
                <div class="image_details">
                  <br>
                  <input type="text" class="form-control" name="image_name" placeholder="اسم الصورة">
                  <br>
                  <input type="text" class="form-control" name="image_alt" placeholder="الاسم البديل">
                  <br>
                  <input type="text" class="form-control" name="image_desc" placeholder="وصف مختصر ">
                  <br>
                  <input type="text" class="form-control" name="image_keys" placeholder=" كلمات مفتاحية للصورة  ">
                </div>

              </div>
              <div class="form-group">
                <p class="btn btn-primary btn-sm" id="add_to_gallary"> اضافة الي المعرض <i class="fa fa-plus"></i> </p>
              </div>
              <div class="image_gallary">
              </div>
              <div></div>

              <div class="form-group">
                <label for="Company-2" class="block"> نشر المنتج </label>
                <select name="publish" id="" class="form-control select2">
                  <option value="" disabled> اختر الحالة </option>
                  <option value="1"> نشر المنتج </option>
                  <option value="0"> ارشيف </option>
                </select>
              </div>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      <!-- Add Vartion Products -->
      <?php
      //  include "add_vartions.php";
      ?>

      <div class="row" style="display: flex;justify-content: space-between;">
        <button type="submit" class="btn btn-primary" name="add_pro"> <i class="fa fa-save"></i> حفظ </button>
        <a href="main.php?dir=products&page=report" class="btn btn-secondary">رجوع <i class="fa fa-backward"></i> </a>
      </div>
    </form>
    <br>
    <br>
  </div>
  <!-- /.container-fluid -->
</section>