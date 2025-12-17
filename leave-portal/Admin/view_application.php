<?php require __DIR__.'/config/db.php';
include __DIR__.'/partials/header.php';
include __DIR__.'/partials/sidebar.php';

$id = (int)($_GET['id'] ?? 0);
$stmt=$conn->prepare("SELECT la.*, e.emp_code, e.name, e.email, e.department, e.designation
                      FROM leave_applications la JOIN employees e ON e.id=la.employee_id
                      WHERE la.id=? LIMIT 1");
$stmt->bind_param("i",$id); $stmt->execute();
$app=$stmt->get_result()->fetch_assoc();
if(!$app){ echo "<p>Not found.</p>"; include __DIR__.'/partials/footer.php'; exit; }
?>
<div class="page-title">Application #<?= (int)$app['id'] ?></div>
<div class="card">
  <h4>Employee</h4>
  <p><b><?= htmlspecialchars($app['name']) ?></b> (<?= htmlspecialchars($app['emp_code']) ?>) — <?= htmlspecialchars($app['email']) ?></p>
  <p><?= htmlspecialchars($app['department']) ?> • <?= htmlspecialchars($app['designation']) ?></p>
  <h4>Leave</h4>
  <p>Type: <b><?= htmlspecialchars($app['leave_type']) ?></b></p>
  <p>From: <b><?= htmlspecialchars($app['start_date']) ?></b> &nbsp; To: <b><?= htmlspecialchars($app['end_date']) ?></b></p>
  <p>Status: <b><?= htmlspecialchars($app['status']) ?></b></p>
  <p>Reason:</p>
  <div class="form-card" style="max-width:none"><?= nl2br(htmlspecialchars($app['reason'])) ?></div>
</div>
<?php include __DIR__.'/partials/footer.php'; ?>
