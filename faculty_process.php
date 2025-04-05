<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $leave_id = isset($_POST['leave_id']) ? intval($_POST['leave_id']) : 0;
    $faculty_remarks = isset($_POST['faculty_remarks']) ? trim($_POST['faculty_remarks']) : '';
    $action = isset($_POST['action']) ? $_POST['action'] : '';

    if ($leave_id <= 0 || empty($action)) {
        die("Missing or invalid leave request data.");
    }

    if ($action === "add_remarks") {
        // Only update remarks, leave status unchanged
        $sql = "UPDATE leave_request SET faculty_remarks=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("si", $faculty_remarks, $leave_id);
            if ($stmt->execute()) {
                header("Location: faculty.php?message=Remarks added successfully.");
                exit();
            } else {
                echo "Error executing query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    } else {
        // Handle approve, reject, forward
        switch ($action) {
            case "approve":
                $status = "approved";
                break;
            case "reject":
                $status = "rejected";
                break;
            case "forward":
                $status = "forwarded";
                break;
            default:
                die("Invalid action specified.");
        }

        $sql = "UPDATE leave_request SET status=?, faculty_remarks=? WHERE id=?";
        if ($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("ssi", $status, $faculty_remarks, $leave_id);
            if ($stmt->execute()) {
                header("Location: faculty.php?message=Leave request updated successfully.");
                exit();
            } else {
                echo "Error executing query: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Error preparing statement: " . $conn->error;
        }
    }

    $conn->close();
} else {
    header("Location: faculty.php");
    exit();
}
