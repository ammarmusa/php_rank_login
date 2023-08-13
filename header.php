<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<a href="index.php">Index</a>
<a href="dashboard.php">Dashboard</a>
<a href="signup.php">Signup</a>
<a href="login.php">Login</a>
<a href="logout.php">Logout</a>

<body>
    <span><?php
            if (isset($_SESSION['myname'])) {
                echo "<br><br>Hi, " . $_SESSION['myname'];
            }
            ?></span>