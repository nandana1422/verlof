<?php
session_start();

// Database connection
$host = "localhost";
$user = "root";
$password = "";
$database = "verloff";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$student_id = "";
$student_name = "";
$class = "";
$debug_message = "";

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    // DEBUG: Output current session email
    // echo "Session email: " . $email . "<br>";

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
        $debug_message = "⚠️ Student not found in the database. Please make sure your email exists in the `students` table.";
    }
} else {
    $debug_message = "⚠️ You are not logged in. Please log in first.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Leave Application</title>
    <link rel="stylesheet" href="apply.css">
</head>
<body>

<h2>Student Leave Application</h2>

<?php
if (!empty($debug_message)) {
    echo "<p style='color:red;'>$debug_message</p>";
}

if (isset($_SESSION['message'])) {
    echo "<p>{$_SESSION['message']}</p>";
    unset($_SESSION['message']);
}
?>

<form action="process_leave.php" method="POST">
    <label for="student_id">Student ID:</label>
    <input type="text" name="student_id" value="<?php echo htmlspecialchars($student_id); ?>" readonly>

    <label for="student_name">Student Name:</label>
    <input type="text" name="student_name" value="<?php echo htmlspecialchars($student_name); ?>" readonly>

    <label for="class">Class:</label>
    <input type="text" name="class" required>

    <label for="leave_reason">Reason for Leave:</label>
    <textarea name="leave_reason" required></textarea>

    <label for="start_date">Start Date:</label>
    <input type="date" name="start_date" required>

    <label for="end_date">End Date:</label>
    <input type="date" name="end_date" required>

    <button type="submit">Submit Request</button>
</form>

</body>
</html>
