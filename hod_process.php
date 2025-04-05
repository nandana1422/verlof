<?php
session_start();
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['leave_id']) && isset($_POST['action'])) {
        $leave_id = intval($_POST['leave_id']); // Ensure it's an integer
        $hod_remarks = isset($_POST['hod_remarks']) ? trim($_POST['hod_remarks']) : '';
        $action = $_POST['action'];

        // Determine the status based on the action
        switch ($action) {
            case "approve":
                $status = "Approved";
                break;
            case "reject":
                $status = "Rejected by HOD";
                break;
            default:
                die("Invalid action specified.");
        }

        // Prepare and execute the SQL statement to update the leave request
        $sql = "UPDATE leave_request SET status=?, hod_remarks=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssi", $status, $hod_remarks, $leave_id);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Leave request has been $status successfully.";
                header("Location: hod.php?message=Leave request updated successfully.");
                exit();
            } else {
                $_SESSION['error'] = "Error updating leave request.";
            }
            $stmt->close();
        } else {
            $_SESSION['error'] = "Error preparing statement.";
        }
    }
}

header("Location: hod.php");
exit();
