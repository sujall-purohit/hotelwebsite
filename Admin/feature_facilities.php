<?php
require('Inc/essentials.php');
require('Inc/db_config.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Features & Facilities</title>
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
            border-radius: 22px;
            overflow: hidden;
            transition: .3s;
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
            transition: .3s;
        }

        .custom-btn:hover {
            transform: translateY(-2px);
        }

        .table {
            margin-bottom: 0;
        }

        .table thead tr {
            background: #0f172a !important;
        }

        .table th {
            color: white;
            font-weight: 600;
            border: none;
            padding: 14px;
        }

        .table td {
            padding: 14px;
            vertical-align: middle;
        }

        .table-responsive-md {
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-content {
            border: none;
            border-radius: 22px;
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

        textarea {
            resize: none;
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
                    Features & Facilities
                </h3>

                <!-- ================= FEATURES ================= -->
                <div class="card border-0 shadow-sm custom-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Features</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm custom-btn"
                                data-bs-toggle="modal" data-bs-target="#feature-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-md " style="max-height:350px; overflow-y:auto;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr class="bg-dark text-light">
                                        <th scope="col">Sr No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="features-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- ================= FACILITIES ================= -->
                <div class="card border-0 shadow-sm custom-card mb-4">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Facilities</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm custom-btn"
                                data-bs-toggle="modal" data-bs-target="#facility-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-md " style="max-height:350px; overflow-y:auto;">
                            <table class="table table-hover border">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr No.</th>
                                        <th scope="col">Icon</th>
                                        <th scope="col">Name</th>
                                        <th scope="col" width="40%">Description</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="facilities-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <!-- ================= FEATURES MODAL ================= -->
    <div class="modal fade" id="feature-s" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form id="feature_s_form">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Add Team Member</h5>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="feature_name" class="form-control shadow-none" required>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="reset"
                            class="btn text-secondary shadow-none" data-bs-dismiss="modal">
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

    <!-- ================= FACITITIES MODAL ================= -->
    <div class="modal fade" id="facility-s" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog">
            <form id="facility_s_form">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">Add Facility</h5>
                    </div>

                    <div class="modal-body">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Name</label>
                            <input type="text" name="facility_name" class="form-control shadow-none" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Icon</label>
                            <input type="file" name="facility_icon" accept=".svg" class="form-control shadow-none" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Discription</label>
                            <textarea name="facility_desc" class="form-control shadow-none" rows="1"></textarea>
                        </div>

                    </div>

                    <div class="modal-footer">

                        <button type="reset"
                            class="btn text-secondary shadow-none" data-bs-dismiss="modal">
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




    <?php require('Inc/scripts.php'); ?>
    <script src="scripts/feature_facilities.js"></script>


</body>

</html>