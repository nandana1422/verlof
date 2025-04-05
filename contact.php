<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Student Leave Management System</title>
    
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

        /* Contact Form */
        .contact-form {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .contact-form input, .contact-form textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .contact-form input[type="submit"] {
            background-color: #002244;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            border-radius: 5px;
        }

        .contact-form input[type="submit"]:hover {
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

        /* Contact Section */
        .contact-section {
            padding: 30px;
            background-color: #f1f1f1;
            border-radius: 10px;
            margin-top: 30px;
        }

        .contact-info {
            margin-top: 30px;
        }
    </style>
</head>
<body>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- Header -->
<header>
    <h1>Student Leave Management System</h1>
</header>

<!-- Navigation -->
<nav>
    <img src="img.jpg" alt="Logo" style="height: 50px;">
    <a href="index.html">Home</a>
    <a href="login.html">Login</a>
    <a href="about us.html">About Us</a>
    <a href="apply for leave.html">Apply for Leave</a>
    <a href="contact.html">Contact</a>
</nav>

<!-- Main Content -->
<div class="container">
    <!-- Contact Section -->
    <section id="contact">
        <h2>Contact Us</h2>
        <p>If you have any questions or need assistance, feel free to reach out to us using the form below:</p>

        <!-- Contact Form -->
        <div class="contact-form">
            <form action="submit_contact_request.php" method="POST">
                <label for="name">Your Name:</label>
                <input type="text" id="name" name="name" required>

                <label for="email">Your Email:</label>
                <input type="email" id="email" name="email" required>

                <label for="subject">Subject:</label>
                <input type="text" id="subject" name="subject" required>

                <label for="message">Message:</label>
                <textarea id="message" name="message" rows="6" required></textarea>

                <input type="submit" value="Send Message">
            </form>
        </div>

        <!-- Contact Info Section -->
        <div class="contact-info">
            <h3>Our Contact Information</h3>
            <p>Email: <a href="mailto:support@leave-management.com">support@leave-management.com</a></p>
            <p>Phone:+91 9947907730/p>
            <p>Address:sngist,manjaly</p>
        </div>
    </section>
</div>

<!-- Footer -->
<footer>
    Student Leave Management System &copy; 2025
</footer>
</body>
</html>
