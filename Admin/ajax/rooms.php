<?php

require('../Inc/db_config.php');
require('../Inc/essentials.php');

adminLogin();

$conn = $GLOBALS['conn'];


/* ======================================================
   TOGGLE ROOM STATUS
====================================================== */

if (isset($_POST['toggle_status'])) {

    $frm_data = filteration($_POST);

    $q = "UPDATE `rooms`
          SET `status`=?
          WHERE `sr_no`=?";

    $v = [
        $frm_data['value'],
        $frm_data['toggle_status']
    ];

    $res = update($q, $v, 'ii');

    echo $res ? 1 : 0;

    exit;
}


/* ======================================================
   EDIT ROOM
====================================================== */

if (isset($_POST['edit_room'])) {

    $frm_data = filteration($_POST);

    $features = isset($_POST['features'])
        ? json_decode($_POST['features'], true)
        : [];

    $facilities = isset($_POST['facilities'])
        ? json_decode($_POST['facilities'], true)
        : [];

    if (!is_array($features)) $features = [];

    if (!is_array($facilities)) $facilities = [];

    /* =========================
       UPDATE ROOM
    ========================= */

    $q1 = "UPDATE `rooms`
            SET `name`=?,
                `area`=?,
                `price`=?,
                `quantity`=?,
                `adult`=?,
                `children`=?,
                `description`=?
            WHERE `sr_no`=?";

    $values = [

        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['desc'],
        $frm_data['room_id']

    ];

    $res = update($q1, $values, 'siiiiisi');

    /* =========================
       DELETE OLD RELATIONS
    ========================= */

    delete(
        "DELETE FROM `room_features`
        WHERE `room_id`=?",
        [$frm_data['room_id']],
        'i'
    );

    delete(
        "DELETE FROM `room_facilities`
        WHERE `room_id`=?",
        [$frm_data['room_id']],
        'i'
    );

    /* =========================
       INSERT FACILITIES
    ========================= */

    if (!empty($facilities)) {

        $q2 = "INSERT INTO `room_facilities`
               (`room_id`,`facilities_id`)
               VALUES (?,?)";

        $stmt = mysqli_prepare($conn, $q2);

        if ($stmt) {

            foreach ($facilities as $f) {

                $f = (int)$f;

                mysqli_stmt_bind_param(
                    $stmt,
                    'ii',
                    $frm_data['room_id'],
                    $f
                );

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }

    /* =========================
       INSERT FEATURES
    ========================= */

    if (!empty($features)) {

        $q3 = "INSERT INTO `room_features`
               (`room_id`,`features_id`)
               VALUES (?,?)";

        $stmt = mysqli_prepare($conn, $q3);

        if ($stmt) {

            foreach ($features as $f) {

                $f = (int)$f;

                mysqli_stmt_bind_param(
                    $stmt,
                    'ii',
                    $frm_data['room_id'],
                    $f
                );

                mysqli_stmt_execute($stmt);
            }

            mysqli_stmt_close($stmt);
        }
    }

    echo 1;

    exit;
}


/* ======================================================
   ADD ROOM
====================================================== */

if (isset($_POST['add_room'])) {

    $frm_data = filteration($_POST);

    $flag = 0;

    $features = isset($_POST['features'])
        ? json_decode($_POST['features'], true)
        : [];

    $facilities = isset($_POST['facilities'])
        ? json_decode($_POST['facilities'], true)
        : [];

    if (!is_array($features)) $features = [];

    if (!is_array($facilities)) $facilities = [];

    /* =========================
       INSERT ROOM
    ========================= */

    $q1 = "INSERT INTO `rooms`
            (`name`,`area`,`price`,
            `quantity`,`adult`,
            `children`,`description`)
            VALUES (?,?,?,?,?,?,?)";

    $values = [

        $frm_data['name'],
        $frm_data['area'],
        $frm_data['price'],
        $frm_data['quantity'],
        $frm_data['adult'],
        $frm_data['children'],
        $frm_data['desc']

    ];

    if (insert($q1, $values, 'siiiiis')) {

        $flag = 1;
    }

    /* =========================
       INSERT FEATURES/FACILITIES
    ========================= */

    if ($flag == 1) {

        $room_id = mysqli_insert_id($conn);

        /* ---------- FACILITIES ---------- */

        if (!empty($facilities)) {

            $q2 = "INSERT INTO `room_facilities`
                   (`room_id`,`facilities_id`)
                   VALUES (?,?)";

            $stmt = mysqli_prepare($conn, $q2);

            if ($stmt) {

                foreach ($facilities as $f) {

                    $f = (int)$f;

                    mysqli_stmt_bind_param(
                        $stmt,
                        'ii',
                        $room_id,
                        $f
                    );

                    mysqli_stmt_execute($stmt);
                }

                mysqli_stmt_close($stmt);
            }
        }

        /* ---------- FEATURES ---------- */

        if (!empty($features)) {

            $q3 = "INSERT INTO `room_features`
                   (`room_id`,`features_id`)
                   VALUES (?,?)";

            $stmt = mysqli_prepare($conn, $q3);

            if ($stmt) {

                foreach ($features as $f) {

                    $f = (int)$f;

                    mysqli_stmt_bind_param(
                        $stmt,
                        'ii',
                        $room_id,
                        $f
                    );

                    mysqli_stmt_execute($stmt);
                }

                mysqli_stmt_close($stmt);
            }
        }
    }

    echo $flag;

    exit;
}


/* ======================================================
   GET ALL ROOMS
====================================================== */

if (isset($_POST['get_all_rooms'])) {

    $res = select(
        "SELECT * FROM `rooms`
        WHERE `removed`=?",
        [0],
        'i'
    );

    $i = 1;

    $data = "";

    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['status'] == 1) {

            $status = "

            <button onclick='toggle_status({$row['sr_no']},0)'
                class='btn btn-dark btn-sm shadow-none'>

                Active

            </button>

            ";
        } else {

            $status = "

            <button onclick='toggle_status({$row['sr_no']},1)'
                class='btn btn-warning btn-sm shadow-none'>

                Inactive

            </button>

            ";
        }

        $room_name = htmlspecialchars($row['name']);

        $data .= "

        <tr class='align-middle'>

            <td>$i</td>

            <td>{$room_name}</td>

            <td>{$row['area']} sq.ft</td>

            <td>

                <span class='badge rounded-pill bg-light text-dark'>
                    Adult: {$row['adult']}
                </span>

                <br>

                <span class='badge rounded-pill bg-light text-dark'>
                    Children: {$row['children']}
                </span>

            </td>

            <td>₹{$row['price']}</td>

            <td>{$row['quantity']}</td>

            <td>$status</td>

            <td>

                <button type='button'
                    onclick='edit_details({$row['sr_no']})'
                    class='btn btn-primary shadow-none btn-sm'
                    data-bs-toggle='modal'
                    data-bs-target='#edit-room'>

                    <i class='bi bi-pencil-square'></i>

                </button>

                <button type='button'
                    onclick=\"room_images({$row['sr_no']},'{$room_name}')\"
                    class='btn btn-info shadow-none btn-sm'
                    data-bs-toggle='modal'
                    data-bs-target='#room-images'>

                    <i class='bi bi-images'></i>

                </button>

                <button type='button'
                    onclick='remove_room({$row['sr_no']})'
                    class='btn btn-danger shadow-none btn-sm'>

                    <i class='bi bi-trash'></i>

                </button>

            </td>

        </tr>

        ";

        $i++;
    }

    echo $data;

    exit;
}


/* ======================================================
   GET ROOM
====================================================== */

if (isset($_POST['get_room'])) {

    $frm_data = filteration($_POST);

    $res1 = select(
        "SELECT * FROM `rooms`
        WHERE `sr_no`=?",
        [$frm_data['get_room']],
        'i'
    );

    $res2 = select(
        "SELECT * FROM `room_features`
        WHERE `room_id`=?",
        [$frm_data['get_room']],
        'i'
    );

    $res3 = select(
        "SELECT * FROM `room_facilities`
        WHERE `room_id`=?",
        [$frm_data['get_room']],
        'i'
    );

    $roomdata = mysqli_fetch_assoc($res1);

    $roomdata['desc'] =
        $roomdata['description'];

    $features = [];

    $facilities = [];

    while ($row = mysqli_fetch_assoc($res2)) {

        $features[] = $row['features_id'];
    }

    while ($row = mysqli_fetch_assoc($res3)) {

        $facilities[] = $row['facilities_id'];
    }

    $data = [

        "roomdata" => $roomdata,
        "features" => $features,
        "facilities" => $facilities

    ];

    echo json_encode($data);

    exit;
}


/* ======================================================
   ADD ROOM IMAGE
====================================================== */

if (isset($_POST['add_image'])) {

    $frm_data = filteration($_POST);

    if (!isset($_FILES['image'])) {

        echo 'no_file';

        exit;
    }

    $img_r = uploadImage(
        $_FILES['image'],
        ROOMS_FOLDER
    );

    if (
        $img_r == 'inv_img' ||
        $img_r == 'inv_size' ||
        $img_r == 'upd_failed'
    ) {

        echo $img_r;

        exit;
    }

    $q = "INSERT INTO `room_images`
          (`room_id`,`image`)
          VALUES (?,?)";

    $values = [
        $frm_data['room_id'],
        $img_r
    ];

    $res = insert($q, $values, 'is');

    echo $res;

    exit;
}


/* ======================================================
   GET ROOM IMAGES
====================================================== */

if (isset($_POST['get_room_images'])) {

    $frm_data = filteration($_POST);

    $res = select(
        "SELECT * FROM `room_images`
        WHERE `room_id`=?",
        [$frm_data['get_room_images']],
        'i'
    );

    $path = ROOMS_IMG_PATH;

    while ($row = mysqli_fetch_assoc($res)) {

        if ($row['thumb'] == 1) {

            $thumb_btn = "

            <i class='bi bi-check-lg
                text-light bg-success
                px-2 py-1 rounded fs-5'>
            </i>

            ";
        } else {

            $thumb_btn = "

            <button
                onclick='thumb_image($row[sr_no],$row[room_id])'
                class='btn btn-secondary shadow-none'>

                <i class='bi bi-check-lg'></i>

            </button>

            ";
        }

        echo <<<data

        <tr class='align-middle'>

            <td>
                <img src='$path$row[image]'
                    class='img-fluid'>
            </td>

            <td>$thumb_btn</td>

            <td>

                <button
                    onclick='rem_image($row[sr_no],$row[room_id])'
                    class='btn btn-danger shadow-none'>

                    <i class='bi bi-trash'></i>

                </button>

            </td>

        </tr>

        data;
    }

    exit;
}


/* ======================================================
   REMOVE IMAGE
====================================================== */

if (isset($_POST['rem_image'])) {

    $frm_data = filteration($_POST);

    $values = [
        $frm_data['image_id'],
        $frm_data['room_id']
    ];

    $pre_q = "SELECT * FROM `room_images`
              WHERE `sr_no`=?
              AND `room_id`=?";

    $res = select($pre_q, $values, 'ii');

    $img = mysqli_fetch_assoc($res);

    if (
        $img &&
        deleteImage(
            $img['image'],
            ROOMS_FOLDER
        )
    ) {

        $q = "DELETE FROM `room_images`
              WHERE `sr_no`=?
              AND `room_id`=?";

        $res = delete($q, $values, 'ii');

        echo $res;
    } else {

        echo 0;
    }

    exit;
}


/* ======================================================
   THUMB IMAGE
====================================================== */

if (isset($_POST['thumb_image'])) {

    $frm_data = filteration($_POST);

    update(
        "UPDATE `room_images`
        SET `thumb`=?
        WHERE `room_id`=?",
        [0, $frm_data['room_id']],
        'ii'
    );

    $q = "UPDATE `room_images`
          SET `thumb`=?
          WHERE `room_id`=?
          AND `sr_no`=?";

    $v = [

        1,
        $frm_data['room_id'],
        $frm_data['image_id']

    ];

    $res = update($q, $v, 'iii');

    echo $res;

    exit;
}


/* ======================================================
   REMOVE ROOM
====================================================== */

if (isset($_POST['remove_room'])) {

    $frm_data = filteration($_POST);

    /* =========================
       REMOVE IMAGES
    ========================= */

    $res1 = select(
        "SELECT * FROM `room_images`
        WHERE `room_id`=?",
        [$frm_data['room_id']],
        'i'
    );

    while ($row = mysqli_fetch_assoc($res1)) {

        deleteImage(
            $row['image'],
            ROOMS_FOLDER
        );
    }

    /* =========================
       DELETE RELATIONS
    ========================= */

    delete(
        "DELETE FROM `room_images`
        WHERE `room_id`=?",
        [$frm_data['room_id']],
        'i'
    );

    delete(
        "DELETE FROM `room_features`
        WHERE `room_id`=?",
        [$frm_data['room_id']],
        'i'
    );

    delete(
        "DELETE FROM `room_facilities`
        WHERE `room_id`=?",
        [$frm_data['room_id']],
        'i'
    );

    /* =========================
       SOFT DELETE ROOM
    ========================= */

    $res = update(
        "UPDATE `rooms`
        SET `removed`=?
        WHERE `sr_no`=?",
        [1, $frm_data['room_id']],
        'ii'
    );

    echo $res ? 1 : 0;

    exit;
}
