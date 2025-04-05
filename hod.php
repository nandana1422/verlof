<?php
session_start();
include("connection.php");

require_once 'connection.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>student Leave Management</title>

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

        /* Leave Request Table */
        .leave-table {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        .leave-table th, .leave-table td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .remarks {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .action-buttons button {
            padding: 8px 12px;
            margin: 5px;
            cursor: pointer;
        }

        .approve-btn {
            background-color: #28a745;
            color: white;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
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
    <header>
        <h1>student Leave Management</h1>
    </header>

    <!-- Navigation Menu -->
    <nav>
        <img src="img.jpg" alt="Logo">
        <a href="index.html">Home</a>
        <a href="contact.html">Contact</a>
        <a href="logout.php">Logout</a>
    </nav>

    <!-- Main Content Area -->
    <div class="container">
        <section id="view-requests">
            <h2>Student Leave Requests</h2>

            <div class="leave-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Leave Date</th>
                            <th>Reason</th>
                            <th>Faculty Remarks</th>
                            <th>HOD Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM leave_request WHERE status='Forwarded'");

                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['student_name']}</td>";
                            echo "<td>{$row['start_date']} to {$row['end_date']}</td>";
                            echo "<td>{$row['leave_reason']}</td>";
                            echo "<td>";
                            echo !empty($row['faculty_remarks']) ? $row['faculty_remarks'] : "No remarks provided";
                            echo "</td>";
                            echo "<td><textarea class='remarks' name='hod_remarks' form='leaveForm{$row['id']}' placeholder='Add remarks'></textarea></td>";
                            echo "<td class='action-buttons'>";
                            echo "<form id='leaveForm{$row['id']}' method='POST' action='hod_process.php'>";
                            echo "<input type='hidden' name='leave_id' value='{$row['id']}'>";
                            echo "<button class='btn approve-btn' type='submit' name='action' value='approve'>Approve</button>";
                            echo "<button class='btn reject-btn' type='submit' name='action' value='reject'>Reject</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        <p>student Leave Management System &copy; 2025</p>
    </footer>
</body>
</html>
