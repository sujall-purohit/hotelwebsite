<?php

require('../Inc/db_config.php');
require('../Inc/essentials.php');


/* ======================================================
   ADD FEATURE
====================================================== */

if (isset($_POST['add_feature'])) {

    $frm_data = filteration($_POST);

    $q = "INSERT INTO `features`(`name`) VALUES (?)";

    $values = [$frm_data['name']];

    $res = insert($q, $values, 's');

    echo $res;

    exit;
}


/* ======================================================
   GET FEATURES
====================================================== */

if (isset($_POST['get_features'])) {

    $res = selectAll('features');

    $i = 1;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<data

        <tr>

            <td>$i</td>

            <td>$row[name]</td>

            <td>

                <button type="button"
                    onclick="rem_feature($row[sr_no])"
                    class="btn btn-danger btn-sm shadow-none">

                    <i class="bi bi-trash"></i>
                    Delete

                </button>

            </td>

        </tr>

        data;

        $i++;
    }

    exit;
}


/* ======================================================
   REMOVE FEATURE
====================================================== */

if (isset($_POST['rem_feature'])) {

    $frm_data = filteration($_POST);

    $values = [$frm_data['rem_feature']];

    // Check Feature Used In Rooms
    $check_q = select(
        "SELECT * FROM `room_features`
        WHERE `features_id`=?",
        [$frm_data['rem_feature']],
        'i'
    );

    if (mysqli_num_rows($check_q) == 0) {

        $q = "DELETE FROM `features`
              WHERE `sr_no`=?";

        $res = delete($q, $values, 'i');

        echo $res;
    } else {

        echo 'room_added';
    }

    exit;
}


/* ======================================================
   ADD FACILITY
====================================================== */

if (isset($_POST['add_facility'])) {

    $frm_data = filteration($_POST);

    // Check File
    if (!isset($_FILES['icon'])) {

        echo 'no_file';

        exit;
    }

    // Upload SVG
    $img_r = uploadSVGImage(
        $_FILES['icon'],
        FACILITIES_FOLDER
    );

    // Upload Errors
    if (
        $img_r == 'inv_img' ||
        $img_r == 'inv_size' ||
        $img_r == 'upd_failed'
    ) {

        echo $img_r;

        exit;
    }

    // Insert Facility
    $q = "INSERT INTO `facilities`
          (`icon`,`name`,`description`)
          VALUES (?,?,?)";

    $values = [
        $img_r,
        $frm_data['name'],
        $frm_data['desc']
    ];

    $res = insert($q, $values, 'sss');

    echo $res;

    exit;
}


/* ======================================================
   GET FACILITIES
====================================================== */

if (isset($_POST['get_facilities'])) {

    $res = selectAll('facilities');

    $i = 1;

    $path = FACILITIES_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {

        echo <<<data

        <tr class="align-middle">

            <td>$i</td>

            <td>

                <img src="$path$row[icon]"
                    width="100px">

            </td>

            <td>$row[name]</td>

            <td>$row[description]</td>

            <td>

                <button type="button"
                    onclick="rem_facility($row[sr_no])"
                    class="btn btn-danger btn-sm shadow-none">

                    <i class="bi bi-trash"></i>
                    Delete

                </button>

            </td>

        </tr>

        data;

        $i++;
    }

    exit;
}


/* ======================================================
   REMOVE FACILITY
====================================================== */

if (isset($_POST['rem_facility'])) {

    $frm_data = filteration($_POST);

    $values = [$frm_data['rem_facility']];

    // Check Facility Used In Rooms
    $check_q = select(
        "SELECT * FROM `room_facilities`
        WHERE `facilities_id`=?",
        [$frm_data['rem_facility']],
        'i'
    );

    if (mysqli_num_rows($check_q) == 0) {

        // Get Facility Image
        $pre_q = "SELECT * FROM `facilities`
                  WHERE `sr_no`=?";

        $res = select($pre_q, $values, 'i');

        $img = mysqli_fetch_assoc($res);

        // Delete Image
        if (
            deleteImage(
                $img['icon'],
                FACILITIES_FOLDER
            )
        ) {

            // Delete Record
            $q = "DELETE FROM `facilities`
                  WHERE `sr_no`=?";

            $res = delete($q, $values, 'i');

            echo $res;
        } else {

            echo 0;
        }
    } else {

        echo 'room_added';
    }

    exit;
}
