<?php

require_once('Admin/Inc/db_config.php');
require_once('Admin/Inc/essentials.php');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('Inc/links.php') ?>
    <title>Hotel-Room Details</title>

    <style>
        .pop:hover {
            border-top-color: var(--teal) !important;
            transform: scale(1.03);
            transition: all 0.3s;
        }

        .filter-box {
            position: sticky;
            top: 100px;
        }

        .room-main-card:hover {
            box-shadow: 0 20px 40px rgba(0, 0, 0, .12);
        }

        @media screen and (max-width:768px) {

            .room-img {
                height: 220px;
            }

        }

        .availability-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #16a34a;
            color: white;
            padding: 8px 14px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 600;
            z-index: 5;
        }
    </style>
</head>

<body class="bg-light ">

    <?php require('Inc/header.php') ?>
    <?php
    if (!isset($_GET['id'])) {
        redirect('rooms.php');
    }

    $data = filteration($_GET);

    $room_res = select(
        "SELECT * FROM `rooms`
    WHERE `sr_no`=? AND `status`=? AND `removed`=?",
        [$data['id'], 1, 0],
        'iii'
    );

    if (mysqli_num_rows($room_res) == 0) {
        redirect('rooms.php');
    }

    $room_data = mysqli_fetch_assoc($room_res);

    ?>
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 mb-4 px-4">
                <h2 class="fw-bold"><?php echo $room_data['name'] ?></h2>
                <div style="font-size: 14px;">
                    <a href="index.php" class="text-secondary text-decoration-none">Home</a>
                    <span class="text-secondary"> > </span>
                    <a href="rooms.php" class="text-secondary text-decoration-none">Rooms</a>
                </div>
            </div>

            <div class="col-lg-7 col-md-12 px-4">
                <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <?php
                        //Thumbnail
                        $room_img = ROOMS_IMG_PATH . "thumbnail.jpg";
                        $img_q = mysqli_query($conn, "SELECT * FROM `room_images` 
                            WHERE `room_id`='$room_data[sr_no]'");

                        if (mysqli_num_rows($img_q) > 0) {
                            $active_class = 'active';

                            while ($img_res = mysqli_fetch_assoc($img_q)) {
                                echo "
                                 <div class='carousel-item  $active_class'>
                                          <img src='" . ROOMS_IMG_PATH . $img_res['image'] . "'class='d-block w-100 rounded'>
                                 </div>";
                                $active_class = '';
                            }
                        } else {
                            echo "
                                   <div class='carousel-item active'>
                                      <img src='$room_img' class='d-block w-100'>
                                   </div>";
                        }
                        ?>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

            </div>

            <div class="col-lg-5 col-md-12 px-4">
                <div class="card mb-4 border-0 shadow-sm rounded-3">
                    <div class="card-body p-4">

                        <?php
                        echo <<<price
                                <h4 >₹$room_data[price] Per Night</h4>
                                price;

                        echo <<<rating

                                        <div class=" mb-3">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        </div>

                                rating;
                        // Features 
                        $fea_q = mysqli_query($conn, "SELECT f.name FROM `features` f 
                            INNER JOIN `room_features` rfea ON f.sr_no = rfea.features_id 
                            WHERE rfea.room_id = '$room_data[sr_no]'");

                        $features_data = "";
                        while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                            $features_data .= "<span class='badge rounded-pill bg-light text-dark px-3 py-2 mb-1 me-1 '>
                                            $fea_row[name]
                                        </span>";
                        }

                        //Facilities
                        $fac_q = mysqli_query($conn, "SELECT f.name FROM `facilities` f 
                            INNER JOIN `room_facilities` rfac ON f.sr_no = rfac.facilities_id 
                            WHERE rfac.room_id = '$room_data[sr_no]'");

                        $facilities_data = "";
                        while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                            $facilities_data .= "<span class='badge rounded-pill bg-light text-dark px-3 py-2 mb-1 me-1 '>
                                            $fac_row[name]
                                        </span>";
                        }

                        echo <<<features
                                        <div class="features mb-3">
                                                <h6 class="mb-1">Features</h6>
                                            $features_data
                                        </div>
                                features;

                        echo <<<facilities
                                        <div class="facilities mb-3">
                                                <h6 class="mb-1">Facilities</h6>
                                            $facilities_data
                                        </div>

                                facilities;

                        echo <<<guests
                                            <div class="guests mb-3">
                                                <h6 class="mb-1">Guests</h6>
                                                <span class="badge rounded-pill bg-light text-dark px-3 py-2 ">
                                                    $room_data[adult] Adults
                                                </span>
                                                <span class="badge rounded-pill bg-light text-dark px-3 py-2 ">
                                                    $room_data[children] Children
                                                </span>
                                            </div>
                                guests;

                        echo <<<area
                                        <div class="facilities mb-3">
                                                <h6 class="mb-1">Area</h6>
                                                <span class="badge rounded-pill bg-light text-dark px-3 py-2 ">
                                                    $room_data[area]sq.ft.
                                                </span>
                                            
                                        </div>

                                area;

                        echo <<<book
                                <a href="#" class="btn w-100 text-white custom-bg shadow-none mb-1">Book Now</a>
                                book;

                        ?>
                    </div>

                </div>
            </div>


            <div class=" col-12 mt-4 px-4">
                <div class="mb-5">
                    <h3 class="fw-bold mb-3">Description</h3>
                    <p>
                        <?php
                        echo $room_data['description'];
                        ?>
                    </p>
                </div>
                <div>
                    <h5 class="mb-3">Reviews And Ratings</h5>
                    <div>
                        <div class=" d-flex align-items-center mb-2">
                            <img src="Images/facilities/IMG_43553.svg" width="30px">
                            <h6 class=" m-0 ms-2">Random User1</h6>
                        </div>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Repudiandae, amet? Distinctio id iste necessitatibus possimus dolorum nihil deleniti ipsa fugit?</p>
                        <div class="rating">
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                            <i class="bi bi-star-fill text-warning"></i>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    </div>
    <?php require('Inc/footer.php') ?>



</body>

</html>