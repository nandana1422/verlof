<?php
include 'connection.php';

if (isset($_POST['signUp'])) {
    $userName = $_POST['username'];
    $email = $_POST['email'];
    $password = md5($_POST['pass']);
    $role = $_POST['role'];

    // Check for existing email or username
    $checkEmail = "SELECT * FROM users WHERE email = '$email' OR username = '$userName'";
    $result = $conn->query($checkEmail);
    if ($result->num_rows > 0) {
        echo "Email or Username already exists!";
    } else {
        // Role-based limits
        if ($role === 'faculty') {
            $checkFaculty = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='faculty'");
            $row = $checkFaculty->fetch_assoc();
            if ($row['total'] >= 2) {
                echo "Only 2 faculty accounts are allowed.";
                exit();
            }
        }

        if ($role === 'hod') {
            $checkHod = $conn->query("SELECT COUNT(*) as total FROM users WHERE role='hod'");
            $row = $checkHod->fetch_assoc();
            if ($row['total'] >= 1) {
                echo "Only 1 HOD account is allowed.";
                exit();
            }
        }

        // Insert into users table
        $insertQuery = "INSERT INTO users(username, email, password_hash, role)
                        VALUES ('$userName', '$email', '$password', '$role')";
        if ($conn->query($insertQuery) === TRUE) {
            $user_id = $conn->insert_id;

            // If student, insert into students table
            if ($role === 'student') {
                $department = 'Not Set'; // You can replace this with actual department input if needed
                $insertStudent = $conn->prepare("INSERT INTO students (user_id, name, department, email) VALUES (?, ?, ?, ?)");
                $insertStudent->bind_param("isss", $user_id, $userName, $department, $email);
                if (!$insertStudent->execute()) {
                    echo "Error inserting student: " . $insertStudent->error;
                }
            }

            header("location: login.php");
        } else {
            echo "Error: " . $conn->error;
        }
    }
}

if (isset($_POST['signIn'])) {
    $role = $_POST['role'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM users WHERE username='$username' AND password_hash='$password' AND role='$role'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        session_start();
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['email'];

        if ($role == 'student') {
            header("location: student_profile.php");
        } elseif ($role == 'hod') {
            header("location: hod.php");
        } elseif ($role == 'faculty') {
            header("location: faculty.php");
        }
        exit();
    } else {
        echo "Not Found, Incorrect Email or Password";
    }
}
?>
