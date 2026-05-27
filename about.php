<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('Inc/links.php') ?>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <title>Hotel-About</title>
    <style>
        .about-img {
            height: 320px;
            object-fit: cover;
            border-radius: 24px;
        }

        .stat-card {
            transition: .8s ease;
        }

        .stat-card:hover {
            transform: scale(1.1);
            background: #0f172a;
        }

        .stat-card img {
            transition: .8s ease;
        }

        .stat-card:hover img {
            transform: scale(1.1);


        }

        .team-card {
            margin-top: 20px;
            transition: .4s ease;
            border-radius: 24px;
            padding: 10px;
        }

        .team-card:hover {
            transform: scale(1.05);
        }

        .team-card img {
            height: 290px;
            object-fit: cover;
            border-radius: 24px;
        }
    </style>
</head>

<body class="bg-light ">

    <?php require('Inc/header.php') ?>

    <div class="my-5 px-4">
        <h2 class="fw-bold h-font text-center section-title">ABOUT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            At Velora Stay, we redefine luxury and comfort with elegant rooms, modern amenities, and exceptional hospitality. Whether you are traveling for business or leisure, our hotel offers a relaxing atmosphere, premium services, and unforgettable experiences designed to make every guest feel at home.
        </p>
    </div>

    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-md-6 order-lg-1 order-md-1 order-2">
                <h3 class="mb-3">John Doe</h3>
                <p>
                    Our management team is dedicated to delivering exceptional hospitality and creating memorable experiences for every guest. With a passion for excellence, professionalism, and customer satisfaction, the team works tirelessly to ensure comfort, luxury, and personalized service throughout your stay at Velora Stay.
                </p>
            </div>
            <div class="col-md-5 mb-4 order-lg-2 order-md-2 order-1">
                <img src="images/about/about.jpg"
                    class="w-80  custom-shadow about-img">
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded-4 custom-shadow p-4 text-center stat-card h-100">
                    <img src="Images/about/hotel.svg" width="70px">
                    <h4 class="mt-3">100+ ROOMS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded-4 custom-shadow p-4 text-center stat-card h-100">
                    <img src="Images/about/customers.svg" width="70px">
                    <h4 class="mt-3">200+ CUSTOMERS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded-4 custom-shadow p-4 text-center stat-card h-100">
                    <img src="Images/about/rating.svg" width="70px">
                    <h4 class="mt-3">150+ RATINGS</h4>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 mb-4 px-4">
                <div class="bg-white rounded-4 custom-shadow p-4 text-center stat-card h-100">
                    <img src="Images/about/staff.svg" width="70px">
                    <h4 class="mt-3">200+ STAFFS</h4>
                </div>
            </div>
        </div>
    </div>

    <h2 class="text-center fw-bold h-font section-title mt-5">MANAGEMENT TEAM</h2>
    <div class="section-divider mx-auto mb-4"></div>

    <p class="text-center section-subtitle mb-5">
        Meet the passionate team behind our premium hospitality
    </p>
    <div class="container px-4">
        <div class="swiper mySwiper ">
            <div class="swiper-wrapper mb-5 ">

                <?php
                $about_r = selectAll('team_details');
                $path = ABOUT_IMG_PATH;

                while ($row = mysqli_fetch_assoc($about_r)) {
                    echo <<<data
                        <div class="swiper-slide bg-white text-center overflow-hidden team-card w-25">
                                <img src="$path$row[picture]" class="w-100">
                                <h5 class="mt-2">$row[name]</h5>
                    </div>
                    data;
                }
                ?>

            </div>
            <div class="swiper-pagination"></div>
        </div>
    </div>
    <?php require('Inc/footer.php') ?>


    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

    <!-- Initialize Swiper -->
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 40,
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
                    slidesPerView: 3,
                },
                1024: {
                    slidesPerView: 3,
                },
            }
        });
    </script>
</body>

</html>