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
    <title>Admin Panel -Rooms</title>
    <?php require('Inc/links.php'); ?>
</head>
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

    .custom-btn {
        border-radius: 30px;
        padding: 8px 18px;
        transition: .3s ease;
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

    .table-responsive-lg {
        border-radius: 18px;
        overflow: hidden;
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

    textarea {
        resize: none;
    }

    .form-check-input {
        box-shadow: none !important;
    }

    .sticky-top {
        z-index: 1;
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

<body class="bg-light">

    <?php require('Inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <h3 class="page-title">
                    Rooms
                </h3>

                <!-- ================= ROOMS ================= -->
                <div class="card border-0 shadow-sm custom-card mb-4">
                    <div class="card-body">
                        <div class="text-end mb-4">

                            <button type="button" class="btn btn-dark shadow-none btn-sm custom-btn"
                                data-bs-toggle="modal" data-bs-target="#add-room">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>

                        <div class="table-responsive-lg " style="height:450px; overflow-y:auto;">
                            <table class="table table-hover border text-center">
                                <thead>
                                    <tr>
                                        <th scope="col">Sr No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Area</th>
                                        <th scope="col">Guests</th>
                                        <th scope="col">Price</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="room-data">

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ================= ROOM MODAL ================= -->
    <div class="modal fade" id="add-room" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="add_room_form" autocomplete="off">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            Add Room
                        </h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Area</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Price</label>
                                <input type="number" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Quantity</label>
                                <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Adult (Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Children (Max.)</label>
                                <input type="number" min="1" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='features' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                        $opt[name]
                                        </label>
                                        
                                        </div>
                                        
                                        ";
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='facilities' value='$opt[id]' class='form-check-input shadow-none'>
                                        $opt[name]
                                        </label>
                                        
                                        </div>
                                        
                                        ";
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
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
    <!-- =================EDIT ROOM MODAL ================= -->
    <div class="modal fade" id="edit-room" data-bs-backdrop="static" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <form id="edit_room_form" autocomplete="off">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Edit Room</h5>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Name</label>
                                <input type="text" name="name" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Area</label>
                                <input type="number" min="1" name="area" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Price</label>
                                <input type="number" min="1" name="price" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Quantity</label>
                                <input type="number" min="1" name="quantity" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Adult (Max.)</label>
                                <input type="number" min="1" name="adult" class="form-control shadow-none" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-semibold">Children (Max.)</label>
                                <input type="number" min="1" name="children" class="form-control shadow-none" required>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Features</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('features');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='features' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                        $opt[name]
                                        </label>
                                        
                                        </div>
                                        
                                        ";
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-12 mb-3">
                                <label class="form-label fw-semibold">Facilities</label>
                                <div class="row">
                                    <?php
                                    $res = selectAll('facilities');
                                    while ($opt = mysqli_fetch_assoc($res)) {
                                        echo "
                                        <div class='col-md-3 mb-1'>
                                        <label>
                                        <input type='checkbox' name='facilities' value='$opt[sr_no]' class='form-check-input shadow-none'>
                                        $opt[name]
                                        </label>
                                        
                                        </div>
                                        
                                        ";
                                    }

                                    ?>

                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-semibold">Description</label>
                                <textarea name="desc" rows="4" class="form-control shadow-none" required></textarea>
                            </div>
                            <input type="hidden" name="room_id">
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

    <!-- =================MANAGE ROOM IMAGE MODAL ================= -->
    <div class="modal fade" id="room-images" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Room Name</h5>
                    <button type="button" class="btn-close shadow-none" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="border-bottom border-3 pb-3 mb-3">
                        <form id="add_image_form">
                            <div id="image-alert"></div>
                            <label class="form-label fw-semibold">Add Image</label>
                            <input type="file" name="image" accept=".jpg,.png,.webp,.jpeg" class="form-control shadow-none mb-3" required>
                            <button class="btn custom-bg text-white shadow-none">ADD</button>
                            <input type="hidden" name="room_id">
                        </form>
                    </div>
                    <div class="table-responsive-lg " style="height:450px; overflow-y:auto;">
                        <table class="table table-hover border text-center ">
                            <thead>
                                <tr class="bg-dark text-light sticky-top">
                                    <th scope="col" width="60%">Image</th>
                                    <th scope="col">Thumb</th>
                                    <th scope="col">Delete</th>
                                </tr>
                            </thead>
                            <tbody id="room-image-data">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require('Inc/scripts.php'); ?>
    <script src="scripts/rooms.js"></script>


</body>

</html>