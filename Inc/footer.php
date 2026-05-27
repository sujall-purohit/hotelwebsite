    <?php
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(
        select($contact_q, $values, 'i')
    );

    $settings_q = "SELECT * FROM `settings` WHERE `sr_no`=?";
    $values = [1];
    $settings_r = mysqli_fetch_assoc(
        select($settings_q, $values, 'i')
    );
    ?>
    <style>
        .footer-section {
            background: #0f172a;
            padding: 60px 0 30px;
        }

        .footer-text {
            line-height: 1.9;
            color: #cbd5e1 !important;
        }

        .footer-link {
            color: #cbd5e1;
            text-decoration: none;
            transition: .3s ease;
        }

        .footer-link:hover {
            color: white;
            transform: scale(1.05);
        }

        .footer-social {
            color: #cbd5e1;
            text-decoration: none;
            transition: .3s ease;
        }

        .footer-social:hover {
            color: white;
            transform: scale(1.05);
        }

        .footer-bottom {
            background: #020617;
            color: white;
            padding: 18px;
            letter-spacing: .5px;
        }
    </style>
    <!-- Footer -->
    <div class="container-fluid footer-section mt-5">
        <div class="container">
            <div class="row g-4">
                <!-- Hotel Name-Details -->
                <div class="col-lg-4 p-4">
                    <h3 class="h-font fw-bold fs-2 mb-3 text-white">
                        <?php echo $settings_r['site_title'] ?>
                    </h3>
                    <p class="text-light footer-text">
                        <?php echo $settings_r['site_about'] ?>
                    </p>
                </div>
                <!-- Quick Links -->
                <div class="col-lg-4 p-4">
                    <h5 class="mb-4 text-white fw-bold">
                        Quick Links
                    </h5>
                    <a href="index.php"
                        class="footer-link d-inline-block mb-3">
                        Home
                    </a><br>
                    <a href="rooms.php"
                        class="footer-link d-inline-block mb-3">
                        Rooms
                    </a><br>
                    <a href="facilities.php"
                        class="footer-link d-inline-block mb-3">
                        Facilities
                    </a><br>
                    <a href="contact.php"
                        class="footer-link d-inline-block mb-3">
                        Contact Us
                    </a><br>
                    <a href="about.php"
                        class="footer-link d-inline-block">
                        About Us
                    </a>
                </div>
                <!-- Social Media Links -->
                <div class="col-lg-4 p-4">
                    <h5 class="mb-4 text-white fw-bold">
                        Follow Us
                    </h5>
                    <a href="<?php echo $contact_r['tw'] ?>"
                        class="footer-social d-inline-block mb-3">
                        <i class="bi bi-twitter-x me-2"></i>
                        Twitter
                    </a><br>
                    <a href="<?php echo $contact_r['fb'] ?>"
                        class="footer-social d-inline-block mb-3">
                        <i class="bi bi-facebook me-2"></i>
                        Facebook
                    </a><br>
                    <a href="<?php echo $contact_r['ins'] ?>"
                        class="footer-social d-inline-block">
                        <i class="bi bi-instagram me-2"></i>
                        Instagram
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom text-center">
        Designed By Sujal
    </div>
    <!-- Bootstrap JS bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Check Current Page Active or Not in Navbar
        function setActive() {
            let navbar = document.getElementById('nav-bar');
            let a_tags = navbar.getElementsByTagName('a');

            for (let i = 0; i < a_tags.length; i++) {
                let file = a_tags[i].href.split('/').pop();
                let file_name = file.split('.')[0];

                if (document.location.href.indexOf(file_name) >= 0) {
                    a_tags[i].classList.add('active');
                }
            }
        }
        setActive();
    </script>