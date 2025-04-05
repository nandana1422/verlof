<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/login.css">
    <title>Login - Student Leave Management System</title>

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

/* Login Form */
.login-form {
    background-color: white;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

.login-form h2 {
    margin-bottom: 20px;
    text-align: center;
}

.login-form input {
    width: 100%;
    padding: 10px;
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 5px;
}

.login-form input[type="submit"] {
    background-color:#002244;
    color: white;
    border: none;
    padding: 10px 20px;
    cursor: pointer;
    border-radius: 5px;
}

.login-form input[type="submit"]:hover {
    background-color: #002244;
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
    <!-- Navigation -->
    <nav>
        <img src="img.jpg" alt="Logo" style="height: 50px;">
        <a href="index.html">Home</a>
        <!-- <a href="login.html">Login</a> -->
        <a href="about us.html">About Us</a>
        <!-- <a href="apply_for_leave.php">Apply for Leave</a> -->
        <a href="contact.html">Contact</a>
    </nav>

    <!-- Main Content -->
    <div class="container">
        <section id="login-section">
            <div class="login-form">
                <h2>Login to Your Account</h2>
                <form action="register.php" method="POST">
                    <div class="form-group">
                        <label for="role">Login as:</label>
                        <select class="form-control" id="role" name="role" required>
                            <option value="student">Student</option>
                            <option value="faculty">Faculty</option>
                            <option value="hod">HOD</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="username">Username:</label>
                        <input type="text" id="username" name="username" class="form-control" placeholder="Enter your username" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password:</label>
                        <input type="password" id="password" name="password" class="form-control" placeholder="Enter your password" required>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Login" name="signIn">
                    </div>
                </form>
            </div>
        </section>
    </div>

    <!-- Footer -->
    <footer>
        Student Leave Management System &copy; 2025
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
