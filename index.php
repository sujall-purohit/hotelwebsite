<?php
require_once('Admin/Inc/essentials.php');
require_once('Admin/Inc/db_config.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Swiper JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css" />
    <?php require('Inc/links.php') ?>
    <title>Hotel-Home</title>
    <style>
        body {
            background: linear-gradient(to bottom, #f8fafc, #eef2ff);
            letter-spacing: .2px;
            overflow-x: hidden;
        }

        html {
            scroll-behavior: smooth;
        }

        .section-title {
            font-size: 2.5rem;
            margin-bottom: 15px;
        }

        .section-subtitle {
            color: #64748b;
            font-size: 1.05rem;
            line-height: 1.8;
            max-width: 650px;
            margin: auto;
        }

        .section-divider {
            width: 80px;
            height: 4px;
            background: #0f172a;
            border-radius: 20px;
        }

        .room-card,
        .facility-card,
        .testimonial-card,
        .contact-card,
        .availability-box {
            transition: .4s ease;
        }

        .room-card:hover,
        .facility-card:hover,
        .testimonial-card:hover,
        .contact-card:hover {
            transform: translateY(-10px);
        }


        .navbar {
            position: sticky;
            top: 0;
            z-index: 999;
            backdrop-filter: blur(12px);
            background: rgba(255, 255, 255, .88) !important;
        }

        .custom-shadow {
            box-shadow: 0 10px 30px rgba(0, 0, 0, .08);
        }


        .swiper-slide {
            position: relative;
        }

        .swiper-slide::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, .55),
                    rgba(0, 0, 0, .1));
            border-radius: 24px;
            z-index: 2;
        }

        .carousel-img {
            height: 85vh;
            object-fit: cover;
            border-radius: 24px;
            position: relative;
            z-index: 1;
        }

        .carousel-caption-custom {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 5;
            text-align: center;
            color: white;
        }

        .carousel-caption-custom h1 {
            font-size: 4rem;
            font-weight: 700;
        }

        .carousel-caption-custom p {
            font-size: 1.2rem;
            letter-spacing: 1px;
        }

        .availability-form {
            margin-top: -30px;
            position: relative;
            z-index: 10;
        }

        .availability-box {
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, .2);
        }

        .availability-box input,
        .availability-box select {
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }

        .availability-box input:focus,
        .availability-box select:focus {
            border-color: #0f172a;
            box-shadow: none;
        }

        .custom-bg {
            background: linear-gradient(135deg, #0f172a, #1e293b);
            border: none;
            border-radius: 30px;
            transition: .3s ease;
        }

        .custom-bg:hover {
            background: #1e293b;
            transform: translateY(-2px);
        }

        .btn {
            font-weight: 500;
            padding: .6rem 1.2rem;
        }

        .room-card {
            border-radius: 24px;
            overflow: hidden;
            transition: .4s ease;
        }

        .room-card:hover {
            transform: translateY(-10px);
        }

        .room-card img {
            height: 240px;
            object-fit: cover;
            transition: .5s ease;
        }

        .room-card:hover img {
            transform: scale(1.05);
        }

        .badge {
            font-weight: 500;
            letter-spacing: .3px;
        }

        .facility-card {
            transition: .4s ease;
        }

        .facility-card:hover {
            transform: translateY(-8px);
            background: #0f172a !important;
        }

        .facility-card:hover h5 {
            color: white;
        }

        .facility-card img {
            transition: .4s ease;
        }

        .facility-card:hover img {
            transform: scale(1.15);
        }

        .testimonial-card {
            border-radius: 22px;
            transition: .4s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-10px);
        }


        .contact-card i {
            color: #0f172a;
            font-size: 1.1rem;
        }


        @media screen and (max-width:768px) {

            .carousel-img {
                height: 55vh;
            }

            .carousel-caption-custom h1 {
                font-size: 2.4rem;
            }

            .carousel-caption-custom p {
                font-size: 1rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .availability-form {
                margin-top: 25px;
            }

        }

        .room-card .card-body {
            display: flex;
            flex-direction: column;
        }

        .room-card .room-actions {
            margin-top: auto;
        }
    </style>
</head>
<?php
$contact_q = mysqli_query(
    $conn,
    "SELECT * FROM `contact_details` LIMIT 1"
);

$contact_r = mysqli_fetch_assoc($contact_q);
?>

<body class="bg-light ">

    <?php require('Inc/header.php') ?>

    <!-- Carousel -->
    <div class="container-fluid px-lg-4 mt-4">
        <div class="swiper swiper-container">
            <div class="swiper-wrapper">
                <?php
                $res = selectAll('carousel');
                while ($row = mysqli_fetch_assoc($res)) {

                    $path = CAROUSEL_IMG_PATH;

                    echo <<<data
                                 <div class="swiper-slide">
                                    <img src="{$path}{$row['image']}"
                                        class="w-100 d-block carousel-img" />
                                    <div class="carousel-caption-custom">
                                        <h1 class="h-font">
                                            Luxury & Comfort
                                        </h1>
                                        <p>
                                            Experience premium hotel living
                                        </p>
                                    </div>
                                </div>
                            data;
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Check Availability Form -->
    <div class="container availability-form">
        <div class="row">
            <div class="col-lg-12 bg-white custom-shadow p-4 rounded-4 availability-box">
                <h4 class="fw-bold mb-4">Check Booking Availability</h4>
                <form action="">
                    <div class="row align-items-end g-3">
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-in</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Check-out</label>
                            <input type="date" class="form-control shadow-none">
                        </div>
                        <div class="col-lg-3 mb-3">
                            <label class="form-label" style="font-weight: 500;">Adult</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-2 mb-3">
                            <label class="form-label" style="font-weight: 500;">Children</label>
                            <select class="form-select shadow-none">
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                        <div class="col-lg-1 mb-lg-3 mt-2">
                            <button type="submit" class="btn text-white custom-bg w-100 shadow-none">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Rooms -->
    <h2 class="text-center fw-bold h-font section-title mt-5">OUR ROOMS</h2>
    <div class="section-divider mx-auto mb-4"></div>
    <p class="text-center text-secondary mb-5">
        Experience luxury and comfort with our premium rooms
    </p>
    <div class="container py-5">
        <div class="row">

            <?php
            $room_res = select("SELECT * FROM `rooms` WHERE `status`=? AND `removed`=? ORDER BY `sr_no` DESC LIMIT 3", [1, 0], 'ii');

            while ($room_data = mysqli_fetch_assoc($room_res)) {
                // Features 
                $fea_q = mysqli_query($conn, "SELECT f.name FROM `features` f 
                    INNER JOIN `room_features` rfea ON f.sr_no = rfea.features_id 
                    WHERE rfea.room_id = '$room_data[sr_no]'");

                $features_data = "";
                while ($fea_row = mysqli_fetch_assoc($fea_q)) {
                    $features_data .= "<span class='badge rounded-pill bg-light text-dark px-3 py-2 me-1 mb-1 '>
                                    $fea_row[name]
                                </span>";
                }
                // Facilities
                $fac_q = mysqli_query($conn, "SELECT f.name FROM `facilities` f 
                    INNER JOIN `room_facilities` rfac ON f.sr_no = rfac.facilities_id 
                    WHERE rfac.room_id = '$room_data[sr_no]'");

                $facilities_data = "";
                while ($fac_row = mysqli_fetch_assoc($fac_q)) {
                    $facilities_data .= "<span class='badge rounded-pill bg-light text-dark px-3 py-2  me-1 mb-1'>
                                    $fac_row[name]
                                </span>";
                }

                //Thumbnail
                $room_thumb = ROOMS_IMG_PATH . "thumbnail.jpg";
                $thumb_q = mysqli_query($conn, "SELECT * FROM `room_images` 
                    WHERE `room_id`='$room_data[sr_no]' AND `thumb`='1'");

                if (mysqli_num_rows($thumb_q) > 0) {
                    $thumb_res = mysqli_fetch_assoc($thumb_q);
                    $room_thumb = ROOMS_IMG_PATH . $thumb_res['image'];
                }


                // Print Room Card
                echo <<<data

                                <div class="col-lg-4 col-md-6 my-3">
                                <div class="card border-0 custom-shadow rounded-4 overflow-hidden room-card h-100" style="max-width: 350px; margin:auto;">
                                    <img src="$room_thumb" class="card-img-top">
                                    <div class="card-body">
                                        <h5>$room_data[name]</h5>
                                        <h5 class="text-success fw-bold">
                                            ₹ $room_data[price] / night
                                        </h5>
                                        <div class="features">
                                            <h6 class="mb-1">Features</h6>
                                             $features_data

                                        </div>
                                        <div class="facilities">
                                            <h6 class="mb-1">Facilities</h6>
                                             $facilities_data
                                        </div>
                                        <div class="guests">
                                            <h6 class="mb-1">Guests</h6>
                                            <span class="badge rounded-pill bg-light text-dark px-3 py-2 ">
                                            $room_data[adult] Adults
                                        </span>
                                        <span class="badge rounded-pill bg-light text-dark px-3 py-2 ">
                                             $room_data[children] Children
                                        </span>
                                           
                                        </div>
                                        <div class="rating">
                                            <h6 class="mb-1">Rating</h6>
                                            <span class="badge rounded-pill bg-white">
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                                <i class="bi bi-star-fill text-warning"></i>
                                            </span>
                                        </div>
                                        <div class="room-actions">
                                        <div class="d-flex gap-2 mt-4">
                                            <a href="#" class="btn text-white custom-bg flex-fill shadow-none">Book Now</a>
                                            <a href="room_details.php?id=$room_data[sr_no]" class="btn btn-outline-dark flex-fill shadow-none rounded-pill">More Details</a>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    data;
            }

            ?>

            <div class="col-lg-12 text-center">
                <a href="rooms.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none">View All Rooms</a>
            </div>
        </div>
    </div>

    <!-- Facilities -->
    <h2 class="text-center fw-bold h-font section-title">OUR FACILITIES</h2>
    <div class="section-divider mx-auto mb-4"></div>
    <p class="text-center section-subtitle mb-5">
        Experience luxury and comfort with our premium hospitality
    </p>
    <div class="container py-5">
        <div class="row justify-content-evenly px-lg-0 px-md-0 px-5">
            <?php
            $res = mysqli_query($conn, "SELECT * FROM `facilities` ORDER BY `sr_no` DESC  LIMIT 5");
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data

                                    <div class="col-lg-2 col-md-4 col-6">

                        <div class="facility-card text-center bg-white shadow-sm rounded-4 py-4 h-100">

                            <img src="$path$row[icon]" width="50px">

                            <h5 class="mt-3">$row[name]</h5>

                        </div>

                    </div>

                data;
            }

            ?>
            <div class="col-lg-12 text-center">
                <a href="facilities.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none mt-5">More Facilities >>></a>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <h2 class="text-center fw-bold h-font section-title">TESTIMONIALS</h2>
    <div class="section-divider mx-auto mb-4"></div>
    <p class="text-center section-subtitle mb-5">
        Experience luxury and comfort with our premium hospitality
    </p>
    <div class="container">
        <div class="swiper swiper-testimonials">
            <div class="swiper-wrapper mb-5">
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
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
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
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
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
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
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
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
                <div class="swiper-slide bg-white p-4">
                    <div class="profile d-flex align-items-center mb-3">
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
            <div class="swiper-pagination"></div>
        </div>
        <div class="col-lg-12 text-center">
            <a href="about.php" class="btn btn-sm btn-outline-dark rounded-0 fw-bold shadow-none mb-4 mt-4">Know More >>></a>
        </div>
    </div>



    <!-- Reach Us -->

    <h2 class="text-center fw-bold h-font section-title">REACH US</h2>
    <div class="section-divider mx-auto mb-4"></div>
    <p class="text-center section-subtitle mb-5">
        Experience luxury and comfort with our premium hospitality
    </p>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-8 mb-lg-0 mb-4">

                <div class="bg-white custom-shadow rounded-4 overflow-hidden p-3 h-100">
                    <iframe class="w-100 rounded-4" src="<?php echo $contact_r['iframe'] ?>" height="320px" loading="lazy"></iframe>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded">
                    <h5>Call us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill"></i> +<?php echo $contact_r['pn1'] ?></a>
                    <br>
                    <?php
                    if ($contact_r['pn2'] != '') {
                        echo <<<data
                            <a href="tel:+{$contact_r['pn2']}" class="d-inline-block text-decoration-none text-dark">
                                 <i class="bi bi-telephone-fill"></i> +{$contact_r['pn2']}
                            </a>
                        data;
                    }
                    ?>
                </div>
                <div class="bg-white p-4 rounded">
                    <h5>Follow us</h5>
                    <a href="<?php echo $contact_r['tw'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-3 rounded-pill">
                            <i class="bi bi-twitter-x me-1"></i> Twitter
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block mb-3">
                        <span class="badge bg-light text-dark fs-6 p-3 rounded-pill">
                            <i class="bi bi-facebook me-1"></i> Facebook
                        </span>
                    </a>
                    <br>
                    <a href="<?php echo $contact_r['ins'] ?>" class="d-inline-block ">
                        <span class="badge bg-light text-dark fs-6 p-3 rounded-pill">
                            <i class="bi bi-instagram me-1"></i> Instagram
                        </span>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php require('Inc/footer.php') ?>


    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <!-- Swiper JS -->
    <script>
        var swiper = new Swiper(".swiper-container", {
            spaceBetween: 30,
            effect: "fade",
            loop: true,
            autoplay: {
                delay: 3500,
                disableOnInteraction: false,
            }
        });

        var swiper = new Swiper(".swiper-testimonials", {

            effect: "coverflow",
            grabCursor: true,
            centeredSlides: true,
            slidesPerView: 3,
            loop: true,
            coverflowEffect: {
                rotate: 50,
                stretch: 0,
                depth: 100,
                modifier: 1,
                slideShadows: false,
            },
            pagination: {
                el: ".swiper-pagination",
            },
            breakpoints: {
                320: {
                    slidesPerView: 1,
                },
                640: {
                    slidesPerView: 1,
                },
                768: {
                    slidesPerView: 2,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
</body>

</html>