<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";        // Your DB username
$password = "";        // Your DB password
$database = "verloff"; // Your DB name

$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // ✅ Step 1: Fetch student info from session email
    if (isset($_SESSION['email'])) {
        $email = $_SESSION['email'];
        $stmt = $conn->prepare("SELECT id, name, department FROM students WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result && $result->num_rows > 0) {
            $student = $result->fetch_assoc();
            $student_id = $student['id'];
            $student_name = $student['name'];
            $class = $student['department'];
        } else {
            $_SESSION['message'] = "Student record not found.";
            header("Location: apply_for_leave.php");
            exit();
        }
    } else {
        $_SESSION['message'] = "You must be logged in as a student to apply for leave.";
        header("Location: apply_for_leave.php");
        exit();
    }

    // ✅ Step 2: Get leave fields from the form
    $leave_reason = trim($_POST["leave_reason"]);
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];

    // ✅ Step 3: Validate input
    if (empty($leave_reason) || empty($start_date) || empty($end_date)) {
        $_SESSION['message'] = "All fields are required.";
        header("Location: apply_for_leave.php");
        exit();
    }

    if ($start_date > $end_date) {
        $_SESSION['message'] = "Start date cannot be later than end date.";
        header("Location: apply_for_leave.php");
        exit();
    }

    // ✅ Step 4: Insert leave request into DB
    $sql = "INSERT INTO leave_request (student_id, student_name, class, leave_reason, start_date, end_date, status)
            VALUES (?, ?, ?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("isssss", $student_id, $student_name, $class, $leave_reason, $start_date, $end_date);
        if ($stmt->execute()) {
            $_SESSION['message'] = "Leave request submitted successfully.";
        } else {
            $_SESSION['message'] = "Database error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        $_SESSION['message'] = "Preparation error: " . $conn->error;
    }

    $conn->close();
    header("Location: student_profile.php");
    exit();
} else {
    $_SESSION['message'] = "Invalid request method.";
    header("Location: apply_for_leave.php");
    exit();
}
?>
