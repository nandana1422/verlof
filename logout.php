<?php
// session_start();
// session_destroy();
// header("Location: login.php");
// // logout.php
session_start();
include 'connection.php';

$username = $_SESSION['username'];
$deleteLoginQuery = "DELETE FROM active_logins WHERE username = ?";
$stmt = $conn->prepare($deleteLoginQuery);
$stmt->bind_param("s", $username);
$stmt->execute();

session_destroy();
header("Location: login.php");
exit();
?>