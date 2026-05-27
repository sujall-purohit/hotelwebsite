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
        vertical-align: middle;
    }

    .table td {
        padding: 14px;
        vertical-align: middle;
    }

    .table-responsive-md {
        border-radius: 18px;
        overflow: hidden;
    }

    .sticky-top {
        z-index: 1;
    }

    .message-box {
        max-width: 350px;
        white-space: normal;
        word-break: break-word;
    }

    .badge-custom {
        background: #e2e8f0;
        color: #0f172a;
        border-radius: 30px;
        padding: 7px 14px;
        font-size: 12px;
    }

    .empty-state {
        padding: 60px 20px;
        text-align: center;
        color: #64748b;
    }

    @media(max-width:991px) {

        #main-content {
            margin-top: 60px;
        }

    }
</style>

<?php
require_once('Inc/essentials.php');
require_once('Inc/db_config.php');
require_once('Inc/links.php');
adminLogin();

if (isset($_GET['seen'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['seen'] == 'all') {
        $q = "UPDATE `user_queries` SET `seen`=?";
        $values = [1];
        if (update($q, $values, 'i')) {
            alert('success', 'Marked As Read');
        } else {
            alert('error', 'Operation Failed');
        }
    } else {
        $q = "UPDATE `user_queries` SET `seen`=? WHERE `sr_no`=?";
        $values = [1, $frm_data['seen']];
        if (update($q, $values, 'ii')) {
            alert('success', 'Marked As Read');
        } else {
            alert('error', 'Operation Failed');
        }
    }
}

if (isset($_GET['del'])) {
    $frm_data = filteration($_GET);
    if ($frm_data['del'] == 'all') {
        $q = "DELETE FROM `user_queries`";
        if (mysqli_query($conn, $q)) {
            alert('success', 'All Data Deleted');
        } else {
            alert('error', 'Operation Failed');
        }
    } else {
        $q = "DELETE FROM `user_queries` WHERE `sr_no`=?";
        $values = [$frm_data['del']];
        if (update($q, $values, 'i')) {
            alert('success', 'Data Deleted');
        } else {
            alert('error', 'Operation Failed');
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - User Queries</title>
    <?php require('Inc/links.php'); ?>
</head>

<body class="bg-light">

    <?php require('Inc/header.php'); ?>

    <div class="container-fluid" id="main-content">
        <div class="row">
            <div class="col-lg-10 ms-auto p-4 overflow-hidden">

                <h3 class="page-title">
                    User Queries
                </h3>


                <div class="card border-0 shadow-sm custom-card mb-4">
                    <div class="card-body">

                        <div class="text-end mb-4">
                            <a href="?seen=all" class="btn btn-dark shadow-none btn-sm custom-btn"><i class="bi bi-check-all"></i> Mark All Read</a>
                            <a href="?del=all" class="btn btn-danger shadow-none btn-sm custom-btn"><i class="bi bi-trash"></i> Delete All</a>
                        </div>

                        <div class="table-responsive-md " style="height: 450px; overflow-y:scroll;">
                            <table class="table table-hover border">
                                <thead class="sticky-top">
                                    <tr class="bg-dark text-light">
                                        <th scope="col">Sr No.</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="30%">Message</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $q = "SELECT * FROM `user_queries` ORDER BY `sr_no` DESC";
                                    $data = mysqli_query($conn, $q);
                                    $i = 1;

                                    if (mysqli_num_rows($data) == 0) {

                                        echo "
                                                        <tr>
                                                            <td colspan='7'>
                                                                <div class='empty-state'>
                                                                    <h5>No Queries Found</h5>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        ";
                                    } else {

                                        while ($row = mysqli_fetch_assoc($data)) {
                                            $seen = '';
                                            if ($row['seen'] != 1) {
                                                $seen = "<a href='?seen=$row[sr_no]' class='btn btn-sm rounded-pill btn-dark'>Mark As Read</a>";
                                            }
                                            $seen .= "<a href='?del=$row[sr_no]' class='btn btn-sm rounded-pill btn-danger ms-2'>Delete</a>";

                                            echo <<<query
                                        <tr>
                                        <td>$i</td>
                                         <td>$row[name]</td>
                                        <td>$row[email]</td>
                                        <td>$row[subject]</td>
                                        <td>$row[message]</td>
                                        <td>$row[date]</td>
                                        <td>$seen</td>

                                        </tr>
                                    

                                        query;
                                            $i++;
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php require('Inc/scripts.php'); ?>
</body>

</html>