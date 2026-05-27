<?php
require('Inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Carousel</title>
    <?php require('Inc/links.php'); ?>
    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --light: #f8fafc;
            --border: #e2e8f0;
        }

        body {
            background: var(--light);
        }

        #main-content {
            min-height: 100vh;
            padding-top: 20px;
        }

        .page-title {
            font-weight: 700;
            color: var(--primary);
            margin-bottom: 25px;
        }

        .custom-card {
            border-radius: 24px;
            overflow: hidden;
            transition: .3s ease;
        }

        .custom-card:hover {
            transform: translateY(-4px);
        }

        .custom-card .card-body {
            padding: 25px;
        }

        .card-title {
            font-weight: 700;
            color: var(--primary);
        }

        .custom-btn {
            border-radius: 30px;
            padding: 8px 18px;
            transition: .3s ease;
        }

        .custom-btn:hover {
            transform: translateY(-2px);
        }

        .carousel-item-box {
            position: relative;
            overflow: hidden;
            border-radius: 18px;
        }

        .carousel-item-box img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: .3s ease;
        }

        .carousel-item-box:hover img {
            transform: scale(1.05);
        }

        .modal-content {
            border: none;
            border-radius: 24px;
            overflow: hidden;
        }

        .modal-header {
            border-bottom: 1px solid var(--border);
            padding: 20px 24px;
        }

        .modal-body {
            padding: 24px;
        }

        .modal-footer {
            border-top: 1px solid var(--border);
            padding: 18px 24px;
        }

        .form-control {
            border-radius: 14px;
            padding: 12px;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        @media(max-width:991px) {

            #main-content {
                margin-top: 60px;
            }

        }

        .modal.fade .modal-dialog {
            transform: translateY(20px);
            transition: .3s ease;
        }

        .modal.show .modal-dialog {
            transform: translateY(0);
        }
    </style>
</head>

<body class="bg-light">

    <?php require('Inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <h3 class="page-title">
                    Carousel Images
                </h3>


                <!-- ================= CAROUSEL SECTION ================= -->
                <div class="card border-0 shadow-sm custom-card mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">
                                Carousel Management
                            </h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm custom-btn"
                                data-bs-toggle="modal" data-bs-target="#carousel-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="carousel-data">
                            <div class="col-md-2 mb-3">

                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= CAROUSEL MODAL ================= -->
                <div class="modal fade" id="carousel-s" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog">
                        <form id="carousel_s_form">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title fw-bold">
                                        Add Carousel Image
                                    </h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="carousel_picture" id="carousel_picture_inp" accept=".jpg,.png,.webp,.jpeg" class="form-control shadow-none" required>
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                        onclick="carousel_picture_inp.value=''" class="btn text-secondary shadow-none" data-bs-dismiss="modal">
                                        Cancel
                                    </button>

                                    <button type="submit"
                                        class="btn custom-bg text-white shadow-none">
                                        Save
                                    </button>

                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <?php require('Inc/scripts.php'); ?>
    <script src="scripts/carousel.js"></script>

</body>

</html>