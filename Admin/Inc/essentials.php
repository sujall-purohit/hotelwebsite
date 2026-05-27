<?php
// FRONTEND PATHS
define('SITE_URL', 'http://localhost/hotelWebsite/');
define('ABOUT_IMG_PATH', SITE_URL . 'images/about/');
define('CAROUSEL_IMG_PATH', SITE_URL . 'images/carousel/');
define('FACILITIES_IMG_PATH', SITE_URL . 'images/facilities/');
define('ROOMS_IMG_PATH', SITE_URL . 'images/rooms/');

// BACKEND PATHS
define('UPLOAD_IMAGE_PATH', $_SERVER['DOCUMENT_ROOT'] . '/hotelWebsite/images/');
define('ABOUT_FOLDER', 'about/');
define('CAROUSEL_FOLDER', 'carousel/');
define('FACILITIES_FOLDER', 'facilities/');
define('ROOMS_FOLDER', 'rooms/');
define('USERS_FOLDER', 'users/');

// ADMIN LOGIN CHECK
function adminLogin()
{
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['adminLogin']) || $_SESSION['adminLogin'] !== true) {
        redirect('index.php');
        exit;
    }
}

// REDIRECT
function redirect($url)
{
    if (!headers_sent()) {
        header("Location: $url");
    } else {
        echo "
        <script>
            window.location.href='$url';
        </script>
        ";
    }
    exit;
}

// ALERT
function alert($type, $msg)
{
    $bs_class = ($type == "success") ? "alert-success" : "alert-danger";
    echo <<<ALERT
    <div class="alert $bs_class
        alert-dismissible fade show
        custom-alert"
        role="alert">
        <strong class="me-3">
            $msg
        </strong>
        <button type="button"
            class="btn-close"
            data-bs-dismiss="alert"
            aria-label="Close">
        </button>
    </div>
ALERT;
}

// IMAGE UPLOAD
function uploadImage($image, $folder)
{
    $valid_mime = ['image/jpeg', 'image/jpg', 'image/png', 'image/webp'];
    $allowed_ext = ['jpg', 'jpeg', 'png', 'webp'];
    $img_mime = $image['type'];
    $img_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    //   EXTENSION CHECK
    if (!in_array($img_ext, $allowed_ext)) {
        return 'inv_img';
    }

    //   MIME CHECK
    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    }

    //   VERIFY REAL IMAGE
    if (!getimagesize($image['tmp_name'])) {
        return 'inv_img';
    }

    //   SIZE CHECK
    if (($image['size'] / (1024 * 1024)) > 2) {
        return 'inv_size';
    }

    //   GENERATE FILE NAME
    $rname = 'IMG_' . random_int(11111, 99999) . '.' . $img_ext;
    $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

    //   MOVE FILE
    if (move_uploaded_file($image['tmp_name'], $img_path)) {
        return $rname;
    } else {
        return 'upd_failed';
    }
}

// DELETE IMAGE
function deleteImage($image, $folder)
{
    $file = UPLOAD_IMAGE_PATH . $folder . $image;

    if (file_exists($file)) {
        if (unlink($file)) {
            return true;
        }
    }
    return false;
}

// SVG IMAGE UPLOAD
function uploadSVGImage($image, $folder)
{
    $valid_mime = ['image/svg+xml'];
    $allowed_ext = ['svg'];
    $img_mime = $image['type'];
    $img_ext = strtolower(pathinfo($image['name'], PATHINFO_EXTENSION));

    if (!in_array($img_ext, $allowed_ext)) {
        return 'inv_img';
    }

    if (!in_array($img_mime, $valid_mime)) {
        return 'inv_img';
    }

    if (($image['size'] / (1024 * 1024)) > 1) {
        return 'inv_size';
    }
    $rname = 'IMG_' . random_int(11111, 99999) . '.svg';
    $img_path = UPLOAD_IMAGE_PATH . $folder . $rname;

    if (move_uploaded_file($image['tmp_name'], $img_path)) {
        return $rname;
    } else {
        return 'upd_failed';
    }
}
