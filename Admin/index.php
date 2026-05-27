<?php

session_start();

require('Inc/db_config.php');
require('Inc/essentials.php');

if (
    isset($_SESSION['adminLogin'])
    && $_SESSION['adminLogin'] == true
) {
    redirect('dashboard.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8" />

    <meta name="viewport"
        content="width=device-width, initial-scale=1.0" />

    <title>
        Admin Login Panel
    </title>

    <?php require('Inc/links.php'); ?>

    <style>
        :root {
            --primary: #0f172a;
            --secondary: #1e293b;
            --light: #f8fafc;
            --border: #e2e8f0;
        }

        body {
            background:
                linear-gradient(135deg,
                    #0f172a,
                    #1e293b);

            min-height: 100vh;
            overflow: hidden;
        }

        .login-container {
            min-height: 100vh;
        }

        .login-form {
            width: 100%;
            max-width: 420px;
            border-radius: 28px;
            overflow: hidden;
            background: white;
            box-shadow:
                0 15px 40px rgba(0, 0, 0, .18);

            animation: fadeUp .5s ease;
        }

        .login-header {
            background: #0f172a;
            padding: 28px 20px;
        }

        .login-title {
            color: white;
            font-weight: 700;
            margin: 0;
            letter-spacing: 1px;
        }

        .login-body {
            padding: 35px;
        }

        .form-control {
            border-radius: 14px;
            padding: 12px 14px;
            box-shadow: none !important;
        }

        .form-control:focus {
            border-color: var(--primary);
        }

        .custom-btn {
            background: #0f172a;
            border: none;
            border-radius: 30px;
            padding: 10px 26px;
            transition: .3s;
            font-weight: 500;
        }

        .custom-btn:hover {
            background: #1e293b;
            transform: translateY(-2px);
        }

        .login-icon {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            font-size: 34px;
            color: #0f172a;
        }

        @keyframes fadeUp {

            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }

        }

        @media(max-width:576px) {

            .login-body {
                padding: 25px;
            }

        }
    </style>

</head>

<body>

    <div class="container-fluid">

        <div class="row justify-content-center align-items-center login-container">

            <div class="col-lg-4 col-md-6 col-11">

                <div class="login-form">

                    <!-- Header -->

                    <div class="login-header text-center">

                        <h4 class="login-title">

                            ADMIN LOGIN PANEL

                        </h4>

                    </div>

                    <!-- Body -->

                    <div class="login-body">

                        <div class="login-icon">

                            <i class="bi bi-shield-lock-fill"></i>

                        </div>

                        <form method="POST">

                            <!-- Username -->

                            <div class="mb-3">

                                <label class="form-label fw-semibold">

                                    Admin Name

                                </label>

                                <input name="admin_name"
                                    type="text"
                                    class="form-control shadow-none"
                                    placeholder="Enter admin name"
                                    required>

                            </div>

                            <!-- Password -->

                            <div class="mb-4">

                                <label class="form-label fw-semibold">

                                    Password

                                </label>

                                <input name="admin_password"
                                    type="password"
                                    class="form-control shadow-none"
                                    placeholder="Enter password"
                                    required>

                            </div>

                            <!-- Button -->

                            <div class="text-center">

                                <button name="login"
                                    type="submit"
                                    class="btn text-white custom-btn shadow-none">

                                    Login

                                </button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <!-- Login Logic -->

    <?php

    if (isset($_POST['login'])) {

        $frm_data = filteration($_POST);

        $query = "SELECT * FROM `admin_cred`
        WHERE `admin_name`=?";

        $values = array(
            $frm_data['admin_name']
        );

        $res = select($query, $values, "s");

        if ($res->num_rows == 1) {

            $row = mysqli_fetch_assoc($res);

            // Plain text password check
            // Replace later with password_verify()

            if (
                $frm_data['admin_password']
                == $row['admin_password']
            ) {

                $_SESSION['adminLogin'] = true;

                $_SESSION['adminId'] = $row['sr_no'];

                redirect('dashboard.php');
            } else {

                alert(
                    'error',
                    'Invalid Password!'
                );
            }
        } else {

            alert(
                'error',
                'Login Failed - Invalid Credentials!'
            );
        }
    }

    ?>

    <?php require('Inc/scripts.php'); ?>

</body>

</html>