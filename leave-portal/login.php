<?php
 require "./config/db.php"; 
session_start();

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'];  // role selected from dropdown

    $stmt = $conn->prepare("SELECT * FROM users WHERE email=? AND role=?");
    $stmt->bind_param("ss", $email, $role);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if ($password === $user['password']) {
            // Store login info in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['role']    = $user['role'];
            $_SESSION['name']    = $user['name'];

            if ($user['role'] == 'admin') {
                header("Location:admin_dashboard.php");
            } else {
                header("Location:./employee/index.php");
            }
            exit;
        } else {
            $message = "❌ Invalid password!";
        }
    } else {
        $message = "❌ No account found for that role!";
    }
}
?>

<?php include "./includes/header.php"; ?>

<div style="max-width:400px; margin:40px auto; padding:20px; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
  <h2 style="text-align:center;">Login</h2>
  <form method="POST">
    <label>Email</label>
    <input type="email" name="email" required style="width:100%; padding:10px; margin:8px 0;">

    <label>Password</label>
    <input type="password" name="password" required style="width:100%; padding:10px; margin:8px 0;">

    <p style="margin-top:10px;"><a href="change_password.php" style="color:#004d40; text-decoration:none;">Change Password</a></p>

    <label>Login As</label>
    <select name="role" required style="width:100%; padding:10px; margin:8px 0;">
      <option value="employee">Employee</option>
      <option value="admin">Admin</option>
    </select>

    <button type="submit" style="width:100%; background:#004d40; color:white; padding:10px; border:none; border-radius:5px; margin-top:10px;">Login</button>
  </form>
  <p style="color:red; text-align:center;"><?= $message ?></p>
</div>

<!-- <?php include "./includes/footer.php"; ?>/     -->