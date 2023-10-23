<?php
if (isset($_POST['edit_cat'])) {
    $banner_id = $_POST['banner_id'];
    $head_name = $_POST['head_name'];
    $description = $_POST['description'];
    $button_text = $_POST['button_text'];
    $button_url = $_POST['button_url'];
    $formerror = [];

    // main image
    if (!empty($_FILES['main_image']['name'])) {
        $main_image_name = $_FILES['main_image']['name'];
        $main_image_name = str_replace(' ', '-', $main_image_name);
        $main_image_temp = $_FILES['main_image']['tmp_name'];
        $main_image_type = $_FILES['main_image']['type'];
        $main_image_size = $_FILES['main_image']['size'];
        // حصل على امتداد الصورة من اسم الملف المرفوع
        $image_extension = pathinfo($main_image_name, PATHINFO_EXTENSION);
        if (!empty($image_name)) {
            $image_name = str_replace(' ', '-', $image_name);
            $main_image_uploaded = $image_name . '.' . $image_extension;
            $upload_path = 'about_us/images/' . $main_image_uploaded;
            // حفظ ملف الصورة المرفوع
            move_uploaded_file($main_image_temp, $upload_path);

            // تحقق من نوع الصورة وتحويلها إلى WebP إذا كان ذلك ممكنًا
            if (exif_imagetype($upload_path) === IMAGETYPE_JPEG) {
                $image = imagecreatefromjpeg($upload_path);
            } elseif (exif_imagetype($upload_path) === IMAGETYPE_PNG) {
                // افتح الصورة PNG
                $image = imagecreatefrompng($upload_path);

                // إنشاء نسخة Truecolor فارغة لتحويل الصورة إليها
                $truecolor_image = imagecreatetruecolor(imagesx($image), imagesy($image));

                // نسخ الصورة إلى النسخة Truecolor
                imagecopy($truecolor_image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));

                // حدد مسار حفظ ملف الصورة بتنسيق WebP
                $webp_path = 'about_us/images/' . pathinfo($main_image_uploaded, PATHINFO_FILENAME) . '.webp';

                // قم بحفظ الصورة كملف WebP
                imagewebp($truecolor_image, $webp_path);

                // حرر الذاكرة
                imagedestroy($image);
                imagedestroy($truecolor_image);

                // قم بتحديث المسار الذي تم تحميل الصورة إليه ليكون بامتداد .webp
                $main_image_uploaded = pathinfo($main_image_uploaded, PATHINFO_FILENAME) . '.webp';
            }
        } else {
            $main_image_uploaded = $main_image_name;
            $upload_path = 'about_us/images/' . $main_image_uploaded;
            // حفظ ملف الصورة المرفوع
            move_uploaded_file($main_image_temp, $upload_path);

            // تحقق من نوع الصورة وتحويلها إلى WebP إذا كان ذلك ممكنًا
            if (exif_imagetype($upload_path) === IMAGETYPE_JPEG) {
                $image = imagecreatefromjpeg($upload_path);
            } elseif (exif_imagetype($upload_path) === IMAGETYPE_PNG) {
                // افتح الصورة PNG
                $image = imagecreatefrompng($upload_path);

                // إنشاء نسخة Truecolor فارغة لتحويل الصورة إليها
                $truecolor_image = imagecreatetruecolor(imagesx($image), imagesy($image));

                // نسخ الصورة إلى النسخة Truecolor
                imagecopy($truecolor_image, $image, 0, 0, 0, 0, imagesx($image), imagesy($image));

                // حدد مسار حفظ ملف الصورة بتنسيق WebP
                $webp_path = 'about_us/images/' . pathinfo($main_image_uploaded, PATHINFO_FILENAME) . '.webp';

                // قم بحفظ الصورة كملف WebP
                imagewebp($truecolor_image, $webp_path);

                // حرر الذاكرة
                imagedestroy($image);
                imagedestroy($truecolor_image);

                // قم بتحديث المسار الذي تم تحميل الصورة إليه ليكون بامتداد .webp
                $main_image_uploaded = pathinfo($main_image_uploaded, PATHINFO_FILENAME) . '.webp';
            }
        }
    } else {
        $main_image_uploaded = '';
    }
    // main Video
    if (!empty($_FILES['video']['name'])) {
        $main_video_name = $_FILES['video']['name'];
        $main_video_temp = $_FILES['video']['tmp_name'];
        $main_video_type = $_FILES['video']['type'];
        $main_video_size = $_FILES['video']['size'];
        $main_video_uploaded = time() . '_' . $main_video_name;
        move_uploaded_file(
            $main_video_temp,
            'about_us/images/' . $main_video_uploaded
        );
    } else {
        $main_video_uploaded = '';
    }
    if (empty($formerror)) {
        $stmt = $connect->prepare("UPDATE about_us SET head_name=?,description=?,button_text=?,button_url=? WHERE id = ? ");
        $stmt->execute(array($head_name, $description, $button_text, $button_url, $banner_id));
        if (!empty($_FILES['main_image']['name'])) {
            $stmt = $connect->prepare("UPDATE about_us SET image=? WHERE id = ? ");
            $stmt->execute(array($main_image_uploaded, $banner_id));
        }
        if (!empty($_FILES['video']['name'])) {
            $stmt = $connect->prepare("UPDATE about_us SET video=? WHERE id = ? ");
            $stmt->execute(array($main_video_uploaded, $banner_id));
        }
        if ($stmt) {
            $_SESSION['success_message'] = "تم التعديل بنجاح ";
            header('Location:main?dir=about_us&page=report');
            exit();
        }
    } else {
        $_SESSION['error_messages'] = $formerror;
        header('Location:main?dir=about_us&page=report');
        exit();
    }
}
