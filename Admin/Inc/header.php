<!-- Top Navbar -->

<div class="container-fluid bg-dark text-light p-3 d-flex align-items-center justify-content-between sticky-top shadow-sm">

    <h3 class="mb-0 fw-bold">
        ADMIN PANEL
    </h3>

    <a href="logout.php"
        class="btn btn-light btn-sm fw-semibold">

        LOG OUT

    </a>

</div>


<!-- Sidebar -->

<div class="container-fluid">

    <div class="row">

        <div class="col-lg-2 bg-dark border-top border-3 border-secondary min-vh-100 px-0"
            id="dashboard-menu">

            <nav class="navbar navbar-expand-lg navbar-dark">

                <div class="container-fluid flex-lg-column align-items-stretch">

                    <h4 class="mt-3 text-light text-center fw-bold">

                        ADMIN PANEL

                    </h4>

                    <!-- Mobile Toggle -->

                    <button class="navbar-toggler shadow-none"
                        type="button"
                        data-bs-toggle="collapse"
                        data-bs-target="#adminDropdown"
                        aria-controls="adminDropdown"
                        aria-expanded="false"
                        aria-label="Toggle navigation">

                        <span class="navbar-toggler-icon"></span>

                    </button>

                    <!-- Menu -->

                    <div class="collapse navbar-collapse flex-column align-items-stretch mt-3"
                        id="adminDropdown">

                        <ul class="nav nav-pills flex-column">

                            <li class="nav-item">

                                <a class="nav-link text-white"
                                    href="dashboard.php">

                                    Dashboard

                                </a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link text-white"
                                    href="rooms.php">

                                    Rooms

                                </a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link text-white"
                                    href="feature_facilities.php">

                                    Features & Facilities

                                </a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link text-white"
                                    href="user_queries.php">

                                    User Queries

                                </a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link text-white"
                                    href="carousel.php">

                                    Carousel

                                </a>

                            </li>

                            <li class="nav-item">

                                <a class="nav-link text-white"
                                    href="settings.php">

                                    Settings

                                </a>

                            </li>

                        </ul>

                    </div>

                </div>

            </nav>

        </div>

    </div>

</div>