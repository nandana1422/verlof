<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != 'student') {
    header("Location: login.php");
    exit();
}

// Fetch the student's details and leave history from the database
include('config.php');
$username = $_SESSION['username'];
$query = "SELECT * FROM students WHERE username = '$username'";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile - Leave Management System</title>
    <!-- Include Bootstrap and other CSS -->
</head>
<body>
    <!-- Profile content, leave history, etc. -->
</body>
</html>
