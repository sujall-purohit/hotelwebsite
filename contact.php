<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <?php
    require('Inc/links.php');
    require('Admin/Inc/essentials.php');
    require('Admin/Inc/db_config.php');
    require('Inc/links.php');
    $contact_q = "SELECT * FROM `contact_details` WHERE `sr_no`=?";
    $values = [1];
    $contact_r = mysqli_fetch_assoc(
        select($contact_q, $values, 's')
    );

    ?>
    <title>Hotel-Contact</title>

    <style>
        .contact-box {
            transition: .4s ease;
            border-radius: 24px;
            height: 100%;
        }

        .contact-box:hover {
            transform: translateY(-8px);
        }

        .contact-form input,
        .contact-form textarea {
            border-radius: 14px;
            padding: 12px;
            border: 1px solid #e2e8f0;
        }

        .contact-form input:focus,
        .contact-form textarea:focus {
            border-color: #0f172a;
            box-shadow: none;
        }

        .contact-form textarea {
            resize: none;
        }

        .contact-icon {
            background: #f1f5f9;
            padding: 10px;
            border-radius: 50%;
            margin-right: 10px;
        }

        @media screen and (max-width:768px) {

            .contact-box {
                margin-bottom: 20px;
            }

        }
    </style>
</head>

<body class="bg-light ">

    <?php require('Inc/header.php') ?>

    <div class="container py-5">
        <h2 class="fw-bold h-font text-center section-title">CONTACT US</h2>
        <div class="h-line bg-dark"></div>
        <p class="text-center mt-3">
            We’re here to assist you with bookings, inquiries, and any support you may need. At Velora Stay, our team is committed to providing quick responses, personalized assistance, and exceptional hospitality to ensure your experience is smooth, comfortable, and memorable.
        </p>
    </div>

    <div class="container py-5">
        <div class="row">
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white rounded-4 custom-shadow p-4 contact-box">
                    <iframe class="w-100 rounded-4 mb-4" src="<?php echo $contact_r['iframe'] ?>" height="320px" loading="lazy"></iframe>
                    <h5>Addess</h5>
                    <a href="<?php echo $contact_r['gmap'] ?>" target="_blank" class="d-inline-block text-decoration-none text-dark mb-2">
                        <i class="bi bi-geo-alt-fill"></i><?php echo $contact_r['address'] ?>
                    </a>
                    <h5 class="mt-4">Call us</h5>
                    <a href="tel: +<?php echo $contact_r['pn1'] ?>" class="d-inline-block mb-2 text-decoration-none text-dark"><i class="bi bi-telephone-fill contact-icon"></i> +<?php echo $contact_r['pn1'] ?></a>
                    <br>

                    <?php
                    if ($contact_r['pn2'] != '') {
                        echo <<<data
                        <a href="tel: +$contact_r[pn2]" class="d-inline-block  text-decoration-none text-dark"><i class="bi bi-telephone-fill contact-icon"></i> +$contact_r[pn2]</a>
                        data;
                    }
                    ?>

                    <h5 class="mt-4">Email</h5>
                    <a href="<?php echo $contact_r['email'] ?>" class="d-inline-block  text-decoration-none text-dark"><i class="bi bi-envelope-fill"></i> <?php echo $contact_r['email'] ?></a>

                    <h5 class="mt-4">Follow us</h5>
                    <a href="<?php echo $contact_r['tw'] ?>" class="d-inline-block text-dark fs-5 me-2">
                        <i class="bi bi-twitter-x me-1"></i>

                    </a>
                    <a href="<?php echo $contact_r['fb'] ?>" class="d-inline-block  text-dark fs-5 me-2">
                        <i class="bi bi-facebook me-1"></i>
                    </a>
                    <a href="<?php echo $contact_r['ins'] ?>" class="d-inline-block text-dark fs-5">
                        <i class="bi bi-instagram me-1"></i>
                    </a>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 mb-5 px-4">
                <div class="bg-white  shadow p-4 shadow p-5 contact-box h-100 ">
                    <form method="post" class="contact-form">
                        <h5 class="text-center mt-4 mb-2 fs-1">Send A Message</h5>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Name</label>
                            <input name="name" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Email</label>
                            <input name="email" required type="email" class="form-control shadow-none">
                        </div>
                        <div class="mt-3">
                            <label class="form-label" style="font-weight: 500;">Subject</label>
                            <input name="subject" required type="text" class="form-control shadow-none">
                        </div>
                        <div class="col-md-12 p-0">
                            <label class="form-label" style="font-weight: 500;">Message</label>
                            <textarea name="message" required class="form-control shadow-none" rows="5" style="resize: none;"></textarea>
                        </div>
                        <div class="text-center mt-2 "> <button type="submit" name="send" class="btn text-white custom-bg mt-3 fs-5 rounded-lg ">SEND</button></div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php
    if (isset($_POST['send'])) {
        $frm_data = filteration($_POST);

        $q = "INSERT INTO `user_queries`(`name`, `email`, `subject`, `message`) VALUES (?,?,?,?)";
        $values = [$frm_data['name'], $frm_data['email'], $frm_data['subject'], $frm_data['message']];

        $res = insert($q, $values, 'ssss');
        if ($res == 1) {
            alert('success', 'Message Sent');
        } else {
            alert('error', 'Server Down');
        }
    }
    ?>
    <?php require('Inc/footer.php') ?>



</body>

</html>