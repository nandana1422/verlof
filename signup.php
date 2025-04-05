<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="signup.css"> 
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
  </head>
  <body>
    <div id="form" class="container mt-5">
        <h1 id="heading" class="text-center">Sign Up</h1><br>
        <form name="form" action="register.php" method="POST">
            <div class="mb-3">
                <label class="form-label">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password:</label>
                <input type="password" class="form-control" id="password" name="pass" required>
            </div>
            <div class="mb-3">
                <label class="form-label" for="role">Sign up as:</label>
                <select class="form-control" id="role" name="role" required>
                    <option value="student">Student</option>
                    <option value="faculty">Faculty</option>
                    <option value="hod">HOD</option>
                    <!-- <option value="admin">Admin</option> -->
                </select>
            </div>
            <div class="text-center">
                <input type="submit" class="btn btn-primary" id="btn" value="Sign Up" name="signUp"/>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
  </body>
</html>
