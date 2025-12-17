<?php
 include "../config/db.php"; 
session_start();

// Only employees can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch employee details
$stmt = $conn->prepare("SELECT name, email, phone, designation FROM users WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();


?>
<?php include "../includes/header.php"; ?>
<html>
    <head>
        <title>Logout page</title>
    </head>
    <body>
        <div style="max-width:600px; margin:40px auto; padding:20px; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
        <h2 style="text-align:center;">My Profile</h2>

        <?php if (!empty($success)) echo "<p style='color:green; text-align:center;'>$success</p>"; ?>
        <?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>

        <table style="margin-left : 13rem;font-size:20px;">
            <tr>
                <td><b>Name </b><td>
                <td><?= $user['name'] ?></td>
            </tr>
            <tr>
                <td><b>Email </b><td>
                <td><?= $user['email'] ?></td>
            </tr>
            <tr>
                <td><b>Phone </b><td>
                <td><?= $user['phone'] ?></td>
            </tr>
            <tr>
                <td><b>Designation </b><td>
                <td><?= $user['designation'] ?></td>
            </tr>
        </table>
        <form method="POST" action="logout.php" onsubmit="return confirm('Are you sure you want to logout?');">
            <button type="submit" style="padding: 10px 20px; margin-left : 16rem; background:#004d40; color:white; border:none; border-radius:5px; curser:pointer;">Logout</button>

        </form>
  </body>
</html>
<?php include "../includes/footer.php"; ?>