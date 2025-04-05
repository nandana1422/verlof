<?php
session_start();
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Leave Management</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #002244;
            color: white;
            padding: 15px 0;
            text-align: center;
            font-size: 24px;
            font-weight: bold;
        }

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

        .container {
            padding: 30px;
            flex-grow: 1;
        }

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

        .forward-btn {
            background-color: #28a745;
            color: white;
        }

        .remarks-btn {
            background-color: #17a2b8;
            color: white;
        }

        .reject-btn {
            background-color: #dc3545;
            color: white;
        }

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
        <h1>Student Leave Management</h1>
    </header>

    <nav>
        <img src="img.jpg" alt="Logo">
        <a href="index.html">Home</a>
        <a href="contact.html">Contact</a>
        <a href="logout.php">Logout</a>
    </nav>

    <div class="container">
        <section id="view-requests">
            <h2>Student Leave Requests</h2>

            <div class="leave-table">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Student Name</th>
                            <th>Leave Date</th>
                            <th>Reason for Leave</th>
                            <th>Remarks</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $result = $conn->query("SELECT * FROM leave_request WHERE status='pending'");
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<form method='POST' action='faculty_process.php'>";
                            echo "<td>{$row['student_name']}</td>";
                            echo "<td>{$row['start_date']} to {$row['end_date']}</td>";
                            echo "<td>{$row['leave_reason']}</td>";
                            echo "<td><textarea class='remarks' name='faculty_remarks' placeholder='Add remarks (if any)'></textarea></td>";
                            echo "<td class='action-buttons'>";
                            echo "<input type='hidden' name='leave_id' value='{$row['id']}'>";
                            echo "<button class='btn forward-btn' type='submit' name='action' value='forward'>Forward to HOD</button>";
                            echo "<button class='btn remarks-btn' type='submit' name='action' value='approve'>Approve</button>";
                            echo "<button class='btn reject-btn' type='submit' name='action' value='reject'>Reject</button>";
                            echo "</td>";
                            echo "</form>";
                            echo "</tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </section>
    </div>

    <footer>
        <p>Student Leave Management System &copy; 2025</p>
    </footer>

    <script>
        document.querySelectorAll('.forward-btn').forEach(button => {
            button.addEventListener('click', () => {
                alert('Request forwarded to HOD!');
            });
        });

        document.querySelectorAll('.remarks-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                const row = event.target.closest('tr');
                const remarksText = row.querySelector('.remarks').value;
                if (remarksText) {
                    alert('Remarks added: ' + remarksText);
                } else {
                    alert('Please add remarks.');
                }
            });
        });

        document.querySelectorAll('.reject-btn').forEach(button => {
            button.addEventListener('click', () => {
                if (confirm('Are you sure you want to reject this request?')) {
                    alert('Request rejected!');
                }
            });
        });
    </script>
</body>
</html>
