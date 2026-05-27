<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php require('Inc/links.php') ?>
    <title>Hotel-Facilities</title>

    <style>
        .facility-main-card {
            transition: .4s ease;
        }

        .facility-main-card:hover {
            transform: scale(1.03);
            background: #0f172a;
        }

        .facility-main-card:hover h5,
        .facility-main-card:hover p {
            color: black;
        }

        .facility-icon {
            transition: .4s ease;
        }

        .facility-main-card:hover .facility-icon {
            transform: scale(1.03);
        }

        .facility-main-card p {
            line-height: 1.8;
            color: #64748b;
        }
    </style>
</head>

<body class="bg-light ">

    <?php require('Inc/header.php') ?>

    <div class="container py-5">
        <h2 class="fw-bold h-font text-center section-title">OUR FACILITIES</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            At Velora Stay, we offer premium facilities designed to provide comfort, convenience, and relaxation for every guest. From luxurious rooms and high-speed WiFi to fine dining, secure parking, and 24/7 customer support, every facility is carefully crafted to make your stay enjoyable and memorable.
        </p>
    </div>

    <div class="container pb-5">
        <div class="row">
            <?php
            $res = selectAll('facilities');
            $path = FACILITIES_IMG_PATH;

            while ($row = mysqli_fetch_assoc($res)) {
                echo <<<data
                            <div class="col-lg-4 col-md-6 mb-5 px-4 ">
                            <div class="bg-white rounded-4 shadow p-4 facility-main-card h-100 ">
                                <div class="d-flex align-items-center mb-2 ">
                                    <img src="$path$row[icon]"
                                        class="facility-icon"
                                        height="50px">
                                    <h5 class="m-0 ms-3 fw-bold">$row[name]</h5>
                                </div>
                                <p>$row[description]</p>
                            </div>
                        </div>

                data;
            }

            ?>
        </div>
    </div>
    <?php require('Inc/footer.php') ?>



</body>

</html>