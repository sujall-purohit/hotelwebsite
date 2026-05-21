<?php

require('../Inc/db_config.php');
require('../Inc/essentials.php');


if (isset($_POST['add_image'])) {

    $img_r = uploadImage($_FILES['carousel_picture'], CAROUSEL_FOLDER);

    if (!isset($_FILES['carousel_picture'])) {
        echo 'no_file';
        exit;
    }

    if ($img_r == 'inv_img' || $img_r == 'inv_size' || $img_r == 'upd_failed') {
        echo $img_r;
        exit;
    }

    $q = "INSERT INTO `carousel`(`image`) VALUES (?)";
    $values = [$img_r];

    $res = insert($q, $values, 's');
    echo $res;   // should echo 1
    exit;
}

if (isset($_POST['get_carousel'])) {

    $res = selectAll('carousel');

    while ($row = mysqli_fetch_assoc($res)) {

        $path = CAROUSEL_IMG_PATH;

        echo <<<data
                <div class="col-md-4 mb-3">
                <div class="card bg-dark text-white position-relative">
                    <img src="{$path}{$row['image']}"
                        class="img-fluid"
                        style="height:140px; width:100%; object-fit:cover;">

                    <div class="position-absolute top-0 end-0 p-1">
                    <button type="button" onclick="rem_image($row[sr_no])" class="btn btn-danger btn-sm shadow-none">
                        <i class="bi bi-trash"></i>Delete
                    </button>
                    </div>
                </div>
                </div>
                data;
    }
    exit;
}

if (isset($_POST['rem_image'])) {

    $frm_data = filteration($_POST);
    $values = [$frm_data['rem_image']];

    $pre_q = "SELECT * FROM `carousel` WHERE `sr_no`=?";
    $res = select($pre_q, $values, 'i');
    $img = mysqli_fetch_assoc($res);

    if (deleteImage($img['image'], CAROUSEL_FOLDER)) {
        $q = "DELETE FROM  `carousel` WHERE `sr_no`=?";
        $res = delete($q, $values, 'i');
        echo $res;
    } else {
        echo 0;
    }
}
