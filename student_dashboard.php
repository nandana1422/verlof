<?php
  session_start();
  include("connection.php"); // Ensure this file connects to your MySQL database

  if (!isset($_SESSION['student_id'])) {
      header("Location: login.php"); // Redirect if not logged in
      exit();
  }

  $student_id = $_SESSION['student_id'];

  // Fetch student details
  $query = "SELECT student_name, email, contact_number FROM students WHERE student_id = ?";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("s", $student_id);
  $stmt->execute();
  $result = $stmt->get_result();
  $student = $result->fetch_assoc();

  // Fetch leave history
  $query_leave = "SELECT leave_type, start_date, end_date, status, remarks FROM leave_requests WHERE student_id = ? ORDER BY start_date DESC";
  $stmt_leave = $conn->prepare($query_leave);
  $stmt_leave->bind_param("s", $student_id);
  $stmt_leave->execute();
  $leave_result = $stmt_leave->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard - Leave Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Your existing CSS styles remain unchanged */
    </style>
</head>
<body>

    <header>
        Student Leave Management System
    </header>

    <nav>
        <img src="img.jpg" alt="Logo" style="height: 40px;">
        <a href="index.html">Home</a>
        <a href="about_us.html">About Us</a>
        <a href="apply_for_leave.php">Apply for Leave</a>
        <a href="dashboard.html">Dashboard</a>
        <a href="contact.html">Contact</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <div class="form-container">
            <h3>Personal Details</h3>
            <form>
                <label for="student-name">Name:</label>
                <input type="text" id="student-name" name="student-name" value="<?php echo htmlspecialchars($student['student_name']); ?>" disabled>

                <label for="student-email">Email:</label>
                <input type="email" id="student-email" name="student-email" value="<?php echo htmlspecialchars($student['email']); ?>" disabled>

                <label for="student-contact">Contact Number:</label>
                <input type="text" id="student-contact" name="student-contact" value="<?php echo htmlspecialchars($student['contact_number']); ?>" disabled>
            </form>
        </div>

        <h3>Leave History</h3>
        <table>
            <thead>
                <tr>
                    <th>Leave Type</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Status</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $leave_result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo htmlspecialchars($row['leave_type']); ?></td>
                    <td><?php echo htmlspecialchars($row['start_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['end_date']); ?></td>
                    <td><?php echo htmlspecialchars($row['status']); ?></td>
                    <td><?php echo htmlspecialchars($row['remarks']); ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <footer>
        Student Leave Management System &copy; 2025
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
