<?php
session_start();
include("connection.php");

require_once 'connection.php';

// Ensure user is logged in
if (!isset($_SESSION['email'])) {
    header("Location: login.php");
    exit();
}

$email = $_SESSION['email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Leave Management System</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Header */
        header {
            background-color: #002244;
            color: white;
            padding: 15px 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

        /* Navigation Bar */
        nav {
            background-color: #002244;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: space-around;
        }

        nav img {
            height: 40px;
        }

        nav a {
            color: white;
            padding: 10px 15px;
            text-decoration: none;
            font-weight: bold;
        }

        nav a:hover {
            background-color: #ddd;
            color: black;
            border-radius: 5px;
        }

        /* Main Content */
        .container {
            padding: 30px;
            flex-grow: 1;
        }

        /* Personal Details Form */
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .form-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        /* Leave History Table */
        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
        }

        table th,
        table td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        table th {
            background-color: #002244;
            color: white;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        /* Footer */
        footer {
            background-color: #002244;
            color: white;
            text-align: center;
            padding: 10px;
            margin-top: auto;
        }
    </style>
</head>
<body>

    <!-- Header -->
    <header>
        Student Leave Management System
    </header>

    <!-- Navigation -->
    <nav>
        <img src="img.jpg" alt="Logo" style="height: 40px;">
        <a href="index.html">Home</a>
        <a href="about_us.html">About Us</a>
        <a href="apply_for_leave.php">Apply for Leave</a>
        <!-- <a href="dashboard.html">Dashboard</a> -->
        <a href="contact.html">Contact</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <?php 
        // Fetch student details
        $query = $conn->query("SELECT * FROM users WHERE email='$email'");
        $student = $query->fetch_assoc();
        ?>

        <!-- Personal Details -->
        <div class="form-container">
            <h3>Personal Details</h3>
            <form action="" method="POST">
                <label>Name:</label>
                <input type="text" value="<?php echo $student['username']; ?>" disabled>

                <label>Email:</label>
                <input type="email" value="<?php echo $student['email']; ?>" disabled>

                <label>Login as:</label>
                <input type="text" value="<?php echo $student['role']; ?>" disabled>
            </form>
        </div>

        <!-- Leave History -->
        <h3>Leave History</h3>
        <table>
            <thead>
                <tr>
                    <!-- <th>Leave Type</th> -->
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Faculty Remarks</th>
                    <th>HOD Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch leave requests for the logged-in student
                // $leave_query = $conn->query("SELECT * FROM leave_request WHERE email='$email' ORDER BY id DESC");
                $leave_query = $conn->query ("SELECT lr.* 
                FROM leave_request lr
                JOIN students s ON lr.student_id = s.id
                WHERE s.email = '$email'");
        
                // if ($leave_query->num_rows > 0) {
                    // if ($result && $result->num_rows > 0) {
                        if ($leave_query && $leave_query->num_rows > 0) {

                    while ($leave = $leave_query->fetch_assoc()) {
                        echo "<tr>";
                        // echo "<td>{$leave['leave_type']}</td>";
                        echo "<td>{$leave['start_date']}</td>";
                        echo "<td>{$leave['end_date']}</td>";

                        // Display status with colors
                        $status = $leave['status'];
                        $status_color = ($status == "Approved") ? "green" : (($status == "Rejected" || $status == "Rejected by HOD") ? "red" : "orange");
                        echo "<td style='color: $status_color; font-weight: bold;'>$status</td>";

                        // Display Faculty Remarks
                        echo "<td>";
                        echo !empty($leave['faculty_remarks']) ? $leave['faculty_remarks'] : "No remarks provided";
                        echo "</td>";

                        // Display HOD Remarks
                        echo "<td>";
                        echo !empty($leave['hod_remarks']) ? $leave['hod_remarks'] : "No remarks provided";
                        echo "</td>";

                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6' style='text-align:center;'>No leave requests found.</td></tr>";
                }
                ?>
            </tbody>
        </table>

    </div>

    <!-- Footer -->
    <footer>
        Student Leave Management System &copy; 2025
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>   