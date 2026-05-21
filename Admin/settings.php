<?php
require('Inc/essentials.php');
adminLogin();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Settings</title>
    <?php require('Inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <h3 class="mb-4">SETTINGS</h3>

                <!-- ================= GENERAL SETTINGS ================= -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">General Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm"
                                data-bs-toggle="modal" data-bs-target="#general-s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>

                        <h6 class="card-subtitle mb-1">Site Title</h6>
                        <p class="card-text" id="site_title"></p>

                        <h6 class="card-subtitle mb-1">About Us</h6>
                        <p class="card-text" id="site_about"></p>

                    </div>
                </div>

                <!-- ================= GENERAL SETTINGS MODAL ================= -->
                <div class="modal fade" id="general-s" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog">
                        <form id="general_s_form">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">General Settings</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Site Title</label>
                                        <input type="text" id="site_title_inp" class="form-control shadow-none" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">About us</label>
                                        <textarea id="site_about_inp" class="form-control shadow-none" rows="6" required></textarea>
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                        onclick="site_title_inp.value = general_data.site_title; site_about_inp.value = general_data.site_about;"
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

                <!-- ================= SHUTDOWN SETTINGS ================= -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Shutdown Website</h5>

                            <div class="form-check form-switch">
                                <input onchange="upd_shutdown(this.checked)"
                                    class="form-check-input" type="checkbox" id="shutdown_toggle">
                            </div>
                        </div>

                        <p class="card-text">
                            No customers are allowed to book hotel rooms when shutdown mode is ON.
                        </p>

                    </div>
                </div>
                <!-- ================= CONTACT DETAILS SECTION ================= -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Contacts Settings</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm"
                                data-bs-toggle="modal" data-bs-target="#contacts-s">
                                <i class="bi bi-pencil-square"></i> Edit
                            </button>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1">Address</h6>
                                    <p class="card-text" id="address"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1">Google Map</h6>
                                    <p class="card-text" id="gmap"></p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1">Phone Numbers</h6>
                                    <p class="card-text mb-1"><i class="bi bi-telephone-fill"></i>
                                        <span id="pn1"></span>
                                    </p>
                                    <p class="card-text"><i class="bi bi-telephone-fill"></i>
                                        <span id="pn2"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1">Email</h6>
                                    <p class="card-text" id="email"></p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1">Social Links</h6>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-facebook me-1"></i>
                                        <span id="fb"></span>
                                    </p>
                                    <p class="card-text mb-1">
                                        <i class="bi bi-instagram me-1"></i>
                                        <span id="ins"></span>
                                    </p>
                                    <p class="card-text">
                                        <i class="bi bi-twitter-x me-1"></i>
                                        <span id="tw"></span>
                                    </p>
                                </div>
                                <div class="mb-4">
                                    <h6 class="card-subtitle mb-1">iFrame</h6>
                                    <iframe id="iframe" class="border p-2 w-100" loading="lazy"></iframe>

                                </div>
                            </div>
                        </div>



                    </div>
                </div>

                <!-- ================= CONTACT DETAILS MODAL ================= -->
                <div class="modal fade" id="contacts-s" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog modal-lg">
                        <form id="contacts_s_form">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Contacts Settings</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="container-fluid p-0">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Address</label>
                                                    <input type="text" name="address" id="address_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Google Map Link</label>
                                                    <input type="text" name="gmap" id="gmap_inp" class="form-control shadow-none" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Phone Numbers (with Countary Code)</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn1" id="pn1_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-telephone-fill"></i></span>
                                                        <input type="number" name="pn2" id="pn2_inp" class="form-control shadow-none" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Email</label>
                                                    <input type="email" name="email" id="email_inp" class="form-control shadow-none" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">Social Links</label>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-facebook"></i></span>
                                                        <input type="text" name="fb" id="fb_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-instagram"></i></span>
                                                        <input type="text" name="ins" id="ins_inp" class="form-control shadow-none" required>
                                                    </div>
                                                    <div class="input-group mb-3">
                                                        <span class="input-group-text"><i class="bi bi-twitter"></i></span>
                                                        <input type="text" name="tw" id="tw_inp" class="form-control shadow-none" required>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label fw-bold">iFrame Src</label>
                                                    <input type="text" name="iframe" id="iframe_inp" class="form-control shadow-none" required>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                        onclick="contacts_inp(contacts_data)"
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


                <!-- ================= MANAGEMENT TEAM SECTION ================= -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">

                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h5 class="card-title m-0">Management Team</h5>
                            <button type="button" class="btn btn-dark shadow-none btn-sm"
                                data-bs-toggle="modal" data-bs-target="#team-s">
                                <i class="bi bi-plus-square"></i> Add
                            </button>
                        </div>
                        <div class="row" id="team-data">
                            <div class="col-md-2 mb-3">

                            </div>

                        </div>
                    </div>
                </div>

                <!-- ================= MANAGEMENT TEAM MODAL ================= -->
                <div class="modal fade" id="team-s" data-bs-backdrop="static" tabindex="-1">
                    <div class="modal-dialog">
                        <form id="team_s_form">

                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title">Add Team Member</h5>
                                </div>

                                <div class="modal-body">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Name</label>
                                        <input type="text" name="member_name" id="member_name_inp" class="form-control shadow-none" required>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Picture</label>
                                        <input type="file" name="member_picture" id="member_picture_inp" accept=".jpg,.png,.webp,.jpeg" class="form-control shadow-none" required>
                                    </div>

                                </div>

                                <div class="modal-footer">

                                    <button type="button"
                                        onclick="member_name.value='',member_picture.value='' " class="btn text-secondary shadow-none" data-bs-dismiss="modal">
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
    <script src="scripts/settings.js"></script>

</body>

</html>