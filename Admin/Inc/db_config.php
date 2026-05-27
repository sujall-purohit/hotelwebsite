<?php
// MYSQL ERROR REPORTING
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// DATABASE CONFIGURATION
$hostname = 'localhost';
$username = 'root';
$password = '';
$database = 'hotelwebsite';

// DATABASE CONNECTION
$conn = mysqli_connect($hostname, $username, $password, $database);

// CONNECTION CHECK
if (!$conn) {
    die("Database Connection Failed : " . mysqli_connect_error());
}

// UTF-8 SUPPORT
if (!mysqli_set_charset($conn, "utf8mb4")) {
    die("Error Loading Character Set utf8mb4");
}

// INPUT FILTERATION
function filteration($data)
{
    foreach ($data as $key => $value) {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
        $data[$key] = $value;
    }
    return $data;
}

// SELECT ALL
function selectAll($table)
{
    $conn = $GLOBALS['conn'];
    $query = "SELECT * FROM `$table`";
    $res = mysqli_query($conn, $query);
    return $res;
}
//SELECT QUERY
function select($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);

        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query Cannot Be Executed - SELECT");
        }
    } else {
        die("Query Cannot Be Prepared - SELECT");
    }
}

// INSERT QUERY
function insert($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query Cannot Be Executed - INSERT");
        }
    } else {
        die("Query Cannot Be Prepared - INSERT");
    }
}

// UPDATE QUERY
function update($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query Cannot Be Executed - UPDATE");
        }
    } else {
        die("Query Cannot Be Prepared - UPDATE");
    }
}

// DELETE QUERY
function delete($sql, $values, $datatypes)
{
    $conn = $GLOBALS['conn'];
    if ($stmt = mysqli_prepare($conn, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatypes, ...$values);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_affected_rows($stmt);
            mysqli_stmt_close($stmt);
            return $res;
        } else {
            mysqli_stmt_close($stmt);
            die("Query Cannot Be Executed - DELETE");
        }
    } else {
        die("Query Cannot Be Prepared - DELETE");
    }
}
