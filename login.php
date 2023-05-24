<?php
session_start();

// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "login_system";

// Establish database connection
$conn = mysqli_connect($host, $username, $password, $database);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the user is already logged in
if (isset($_SESSION["logged_inuser"])) {
    header("Location: mainmenu.php");
    exit;
}

if (isset($_POST["login"])) {
    $username = $_POST["username"];
    $password = md5($_POST["password"]);

    // Perform basic validation
    if (!empty($username) && !empty($password)) {
        // Fetch the user account from the database
        $sql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $user = mysqli_fetch_assoc($result);

            // Verify the password
            if ($password === $user['password']) {
                // Set the logged_inuser session variable
                $_SESSION["logged_inuser"] = $username;

                // Successful login, redirect to the main menu
                header("Location: mainmenu.php");
                exit();
            } else {
                // Invalid password, display an error message
                $error = "Invalid username or password";
            }
        } else {
            // Invalid username, display an error message
            $error = "Invalid username or password";
        }
    } else {
        // Empty username or password, display an error message
        $error = "Invalid username or password";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
  <title>Login</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="style.css" rel="stylesheet">
</head>
<body>
  <div class="login-box">
    <h2>Login</h2>
    <form method="POST" action="login.php">
      <div class="user-box">
        <input type="text" name="username" required="">
        <label>Username</label>
      </div>
      <div class="user-box">
        <input type="password" name="password" required="">
        <label>Password</label>
      </div>
      <button type="submit" name="login">Submit</button>
      <?php if (isset($error)) {
          echo '<p class="error">' . $error . '</p>';
      } ?>
    </form>
  </div>
</body>
</html>
