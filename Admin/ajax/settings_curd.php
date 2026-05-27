<?php

require('../Inc/db_config.php');
require('../Inc/essentials.php');

adminLogin();


/* ======================================================
   GET GENERAL SETTINGS
====================================================== */

if (isset($_POST['get_general'])) {

    $q = "SELECT * FROM `settings`
          WHERE `sr_no`=?";

    $values = [1];

    $res = select($q, $values, "i");

    $data = mysqli_fetch_assoc($res);

    echo json_encode($data);

    exit;
}


/* ======================================================
   UPDATE GENERAL SETTINGS
====================================================== */

if (isset($_POST['upd_general'])) {

    $frm_data = filteration($_POST);

    $q = "UPDATE `settings`
          SET `site_title`=?,
              `site_about`=?
          WHERE `sr_no`=?";

    $values = [

        $frm_data['site_title'],
        $frm_data['site_about'],
        1

    ];

    $res = update($q, $values, 'ssi');

    echo $res;

    exit;
}


/* ======================================================
   UPDATE SHUTDOWN STATUS
====================================================== */

if (isset($_POST['upd_shutdown'])) {

    $q = "UPDATE `settings`
          SET `shutdown`=?
          WHERE `sr_no`=?";

    $values = [

        $_POST['upd_shutdown'],
        1

    ];

    $res = update($q, $values, 'ii');

    echo $res;

    exit;
}


/* ======================================================
   GET CONTACTS
====================================================== */

if (isset($_POST['get_contacts'])) {

    $q = "SELECT * FROM `contact_details`
          WHERE `sr_no`=?";

    $values = [1];

    $res = select($q, $values, "i");

    $data = mysqli_fetch_assoc($res);

    echo json_encode($data);

    exit;
}


/* ======================================================
   UPDATE CONTACTS
====================================================== */

if (isset($_POST['upd_contacts'])) {

    $frm_data = filteration($_POST);

    $q = "UPDATE `contact_details`
          SET `address`=?,
              `gmap`=?,
              `pn1`=?,
              `pn2`=?,
              `email`=?,
              `fb`=?,
              `ins`=?,
              `tw`=?,
              `iframe`=?
          WHERE `sr_no`=?";

    $values = [

        $frm_data['address'],
        $frm_data['gmap'],
        $frm_data['pn1'],
        $frm_data['pn2'],
        $frm_data['email'],
        $frm_data['fb'],
        $frm_data['ins'],
        $frm_data['tw'],
        $frm_data['iframe'],
        1

    ];

    $res = update($q, $values, 'sssssssssi');

    echo $res;

    exit;
}


/* ======================================================
   ADD MEMBER
====================================================== */

if (isset($_POST['add_member'])) {

    $frm_data = filteration($_POST);

    if (
        !isset($_FILES['member_picture']) ||
        $_FILES['member_picture']['name'] == ''
    ) {

        echo 'no_file';

        exit;
    }

    $img_r = uploadImage(
        $_FILES['member_picture'],
        ABOUT_FOLDER
    );

    if (
        $img_r == 'inv_img' ||
        $img_r == 'inv_size' ||
        $img_r == 'upd_failed'
    ) {

        echo $img_r;

        exit;
    }

    $q = "INSERT INTO `team_details`
          (`name`,`picture`)
          VALUES (?, ?)";

    $values = [

        $frm_data['member_name'],
        $img_r

    ];

    $res = insert($q, $values, 'ss');

    echo $res;

    exit;
}


/* ======================================================
   GET MEMBERS
====================================================== */

if (isset($_POST['get_member'])) {

    $res = selectAll('team_details');

    while ($row = mysqli_fetch_assoc($res)) {

        $path = ABOUT_IMG_PATH;

        echo <<<data

        <div class="col-md-2 mb-3">

            <div class="card bg-dark text-white position-relative">

                <img src="{$path}{$row['picture']}"
                    class="img-fluid"
                    style="height:140px;
                    width:100%;
                    object-fit:cover;">

                <div class="position-absolute top-0 end-0 p-1">

                    <button type="button"
                        onclick="rem_member($row[sr_no])"
                        class="btn btn-danger btn-sm shadow-none">

                        <i class="bi bi-trash"></i>
                        Delete

                    </button>

                </div>

                <div class="card-body p-2 text-center">

                    <p class="card-text mb-0">

                        {$row['name']}

                    </p>

                </div>

            </div>

        </div>

        data;
    }

    exit;
}


/* ======================================================
   REMOVE MEMBER
====================================================== */

if (isset($_POST['rem_member'])) {

    $frm_data = filteration($_POST);

    $values = [$frm_data['rem_member']];

    $pre_q = "SELECT * FROM `team_details`
              WHERE `sr_no`=?";

    $res = select($pre_q, $values, 'i');

    $img = mysqli_fetch_assoc($res);

    if (
        $img &&
        deleteImage(
            $img['picture'],
            ABOUT_FOLDER
        )
    ) {

        $q = "DELETE FROM `team_details`
              WHERE `sr_no`=?";

        $res = delete($q, $values, 'i');

        echo $res;
    } else {

        echo 0;
    }

    exit;
}
