<?php
if (isset($_POST['add_cat'])) {
    $head_name = $_POST['head_name'];
    $description = $_POST['description'];
    $button_text = $_POST['button_text'];
    $button_url = $_POST['button_url'];
    $formerror = [];
    if (empty($head_name)) {
        $formerror[] = 'من فضلك ادخل العنوان  ';
    }
    // main image
    if (!empty($_FILES['main_image']['name'])) {
        $main_image_name = $_FILES['main_image']['name'];
        $main_image_temp = $_FILES['main_image']['tmp_name'];
        $main_image_type = $_FILES['main_image']['type'];
        $main_image_size = $_FILES['main_image']['size'];
        $main_image_uploaded = time() . '_' . $main_image_name;
        move_uploaded_file(
            $main_image_temp,
            'banners/images/' . $main_image_uploaded
        );
    } else {
        $main_image_uploaded = '';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("INSERT INTO banners (head_name , description,image,button_text,button_url)
        VALUES (:zname,:zdesc,:zimage,:zbutton_text,:zbutton_url)");
        $stmt->execute(array(
            "zname" => $head_name,
            "zdesc" => $description,
            "zimage" => $main_image_uploaded,
            "zbutton_text" => $button_text,
            "zbutton_url" => $button_url,
        ));
        if ($stmt) {
            $_SESSION['success_message'] = " تمت الأضافة بنجاح  ";
            header('Location:main?dir=banners&page=report');
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=banners&page=report');
        exit();
    }
}
