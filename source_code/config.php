<?php

$host = "YOUR_HOST";
$user = "YOUR_DATABASE_USERNAME";
$pass = "YOUR_DATABASE_PASSWORD";
$db   = "YOUR_DATABASE_NAME";

mysqli_report(MYSQLI_REPORT_OFF);

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_errno) {
    error_log("Database connection failed: " . $conn->connect_error);
    http_response_code(500);
    exit("Database connection failed.");
}

$conn->set_charset("utf8mb4");
?>
