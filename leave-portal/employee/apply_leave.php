<?php
include "../config/db.php"; 
session_start();

// Only employees can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    header("Location: ../login.php");
    exit;
}

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = $_SESSION['user_id'];
    $leave_type = $_POST['leave_type'];
    $start_date = $_POST['start_date'];
    $end_date   = $_POST['end_date'];
    $reason     = $_POST['reason'];

    $stmt = $conn->prepare("INSERT INTO leaves (user_id, leave_type, start_date, end_date, reason) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("issss", $user_id, $leave_type, $start_date, $end_date, $reason);

    if ($stmt->execute()) {
        $message = "✅ Leave application submitted successfully!";
    } else {
        $message = "❌ Error: " . $stmt->error;
    }
}
?>

<?php include "../includes/header.php"; ?>

<div style="max-width:500px; margin:40px auto; padding:20px; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
  <h2 style="text-align:center;">Apply for Leave</h2>
  <form method="POST">
    <label>Leave Type</label>
    <select name="leave_type" required style="width:100%; padding:10px; margin:8px 0;">
      <option value="Casual Leave">Casual Leave</option>
      <option value="Sick Leave">Sick Leave</option>
      <option value="Earned Leave">Earned Leave</option>
    </select>

    <label>Start Date</label>
    <input type="date" name="start_date" required style="width:100%; padding:10px; margin:8px 0;">

    <label>End Date</label>
    <input type="date" name="end_date" required style="width:100%; padding:10px; margin:8px 0;">

    <label>Reason</label>
    <textarea name="reason" rows="4" required style="width:100%; padding:10px; margin:8px 0;"></textarea>

    <button type="submit" style="width:100%; background:#004d40; color:white; padding:10px; border:none; border-radius:5px; margin-top:10px;">Submit</button>
  </form>

  <p style="color:green; text-align:center; margin-top:10px;"><?= $message ?></p>
</div>

<?php include "../includes/footer.php"; ?>
