<?php
 include "../config/db.php"; 
session_start();

// Only employees can access
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Fetch leave applications for this employee
$stmt = $conn->prepare("SELECT * FROM leaves WHERE user_id = ? ORDER BY created_at DESC");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<?php include "../includes/header.php"; ?>

<div style="max-width:800px; margin:40px auto; padding:20px; background:#fff; border-radius:10px; box-shadow:0 4px 10px rgba(0,0,0,0.1);">
  <h2 style="text-align:center;">My Leave Applications</h2>

  <table border="1" cellpadding="10" cellspacing="0" style="width:100%; margin-top:20px; border-collapse:collapse; text-align:center;">
    <tr style="background:#004d40; color:white;">
      <th>ID</th>
      <th>Leave Type</th>
      <th>Start Date</th>
      <th>End Date</th>
      <th>Reason</th>
      <th>Status</th>
      <th>Applied On</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
      <td><?= $row['id'] ?></td>
      <td><?= $row['leave_type'] ?></td>
      <td><?= $row['start_date'] ?></td>
      <td><?= $row['end_date'] ?></td>
      <td><?= $row['reason'] ?></td>
      <td>
        <?php if ($row['status'] == "Pending"): ?>
          <span style="color:orange; font-weight:bold;"><?= $row['status'] ?></span>
        <?php elseif ($row['status'] == "Approved"): ?>
          <span style="color:green; font-weight:bold;"><?= $row['status'] ?></span>
        <?php else: ?>
          <span style="color:red; font-weight:bold;"><?= $row['status'] ?></span>
        <?php endif; ?>
      </td>
      <td><?= $row['created_at'] ?></td>
    </tr>
    <?php endwhile; ?>
  </table>
</div>

<?php include "../includes/footer.php"; ?>
