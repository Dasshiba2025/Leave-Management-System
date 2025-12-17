<?php
// Start session for login/logout control
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Employee Leave Portal</title>
  <link rel="stylesheet" href="style.css"> <!-- Optional external CSS -->
  <style>
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }
    body{
      background:radial-gradient(#6639e1, #fb8cee);
    }
    header {
      background-color: #004d40;
      color: #fff;
      padding: 15px 20px;
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 1000;
    }
    nav { display: flex; gap: 20px; }
    nav a { color: #fff; text-decoration: none; }
    nav a:hover { color: #ffc107; }

  </style>
</head>
<body>

<header>
  <h1>Employee Leave Portal</h1>
  <nav id="navbar">
    <a href="../employee/index.php">Home</a>
    <a href="../employee/apply_leave.php">Apply Leave</a>
    <a href="../employee/leave_status.php">Leave Status</a>
    <a href="../employee/leave_history.php">Leave History</a>
    <a href="../employee/profile.php">Profile</a>
    <!-- <a href="logout.php" onclick="return confirm('Are you sure you want to logout?');">Logout</a> -->
  </nav> 

</header>
