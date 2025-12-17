<?php
 include "./config/db.php"; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        $error = "Passwords do not match!";
    } else {
        // Check if email exists
        $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
            $update = $conn->prepare("UPDATE users SET password=? WHERE email=?");
            $update->bind_param("ss", $hashed_password, $email);

            if ($update->execute()) {
                $success = "Password changed successfully! You can now <a href='login.php'>Login</a>";
            } else {
                $error = "Error updating password!";
            }
        } else {
            $error = "Email not found!";
        }
    }
}
?>

<?php include "./includes/header.php"; ?>

<div style="max-width:500px; margin:40px auto; padding:20px; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
  <h2 style="text-align:center;">Change Password</h2>

  <?php if (!empty($error)) echo "<p style='color:red; text-align:center;'>$error</p>"; ?>
  <?php if (!empty($success)) echo "<p style='color:green; text-align:center;'>$success</p>"; ?>

  <form method="POST" style="margin-top:20px;">
    <label>Email:</label><br>
    <input type="email" name="email" required style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>New Password:</label><br>
    <input type="password" name="new_password" required style="width:100%; padding:10px; margin-bottom:10px;"><br>

    <label>Confirm Password:</label><br>
    <input type="password" name="confirm_password" required style="width:100%; padding:10px; margin-bottom:20px;"><br>

    <button type="submit" style="background:#004d40; color:white; padding:10px 20px; border:none; border-radius:5px; cursor:pointer;">Change Password</button>
  </form>
</div>

<?php include "./includes/footer.php"; ?>
