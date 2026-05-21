<?php
session_start();
require('Inc/essentials.php');
adminLogin();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel- Dashboard</title>
    <?php require('Inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden"></div>
        </div>
    </div>


    <?php require('Inc/scripts.php'); ?>
</body>

</html>