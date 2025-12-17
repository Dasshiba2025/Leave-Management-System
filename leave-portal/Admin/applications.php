<?php require __DIR__.'/config/db.php';
include __DIR__.'/partials/header.php';
include __DIR__.'/partials/sidebar.php';

$status = $_GET['status'] ?? 'all';
$valid = ['all','pending','approved','rejected'];
if(!in_array($status,$valid)) $status='all';

$counts = ['all'=>0,'pending'=>0,'approved'=>0,'rejected'=>0];
$counts['all'] = (int)($conn->query("SELECT COUNT(*) c FROM leave_applications")->fetch_assoc()['c'] ?? 0);
$res = $conn->query("SELECT status,COUNT(*) c FROM leave_applications GROUP BY status");
while($r=$res->fetch_assoc()) $counts[$r['status']] = (int)$r['c'];

$sql = "SELECT la.*, e.emp_code, e.name FROM leave_applications la JOIN employees e ON e.id=la.employee_id";
if($status!=='all'){
  $stmt=$conn->prepare($sql." WHERE la.status=? ORDER BY la.id DESC");
  $stmt->bind_param("s",$status); $stmt->execute(); $rows=$stmt->get_result();
} else { $rows = $conn->query($sql." ORDER BY la.id DESC"); }
?>
<div class="page-title">Application List
  <a class="btn" href="add_application.php">+ Add Application</a>
</div>
<div class="badges">
  <?php foreach(['all','pending','approved','rejected'] as $s): ?>
    <a class="<?= $status===$s?'active':'' ?>" href="?status=<?= $s ?>"><?= ucfirst($s) ?> (<?= $counts[$s] ?>)</a>
  <?php endforeach; ?>
</div>

<table>
  <tr>
    <th>ID</th><th>Emp Code</th><th>Name</th><th>Leave Type</th>
    <th>From</th><th>To</th><th>Reason</th><th>Status</th><th>Applied</th><th>Actions</th>
  </tr>
  <?php while($r=$rows->fetch_assoc()): ?>
  <tr>
    <td><?= (int)$r['id'] ?></td>
    <td><?= htmlspecialchars($r['emp_code']) ?></td>
    <td><?= htmlspecialchars($r['name']) ?></td>
    <td><?= htmlspecialchars($r['leave_type']) ?></td>
    <td><?= htmlspecialchars($r['start_date']) ?></td>
    <td><?= htmlspecialchars($r['end_date']) ?></td>
    <td><?= htmlspecialchars(mb_strimwidth($r['reason']??'',0,40,'…')) ?></td>
    <td><?= htmlspecialchars($r['status']) ?></td>
    <td><?= htmlspecialchars($r['applied_at']) ?></td>
    <td class="tools">
      <form method="post" action="app_action.php" style="display:inline">
        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
        <input type="hidden" name="do" value="approve">
        <button class="btn success" <?php if($r['status']==='approved') echo 'disabled'; ?>>Approve</button>
      </form>
      <form method="post" action="app_action.php" style="display:inline">
        <input type="hidden" name="id" value="<?= (int)$r['id'] ?>">
        <input type="hidden" name="do" value="reject">
        <button class="btn danger" <?php if($r['status']==='rejected') echo 'disabled'; ?>>Reject</button>
      </form>
      <a class="btn secondary" href="view_application.php?id=<?= (int)$r['id'] ?>">View</a>
    </td>
  </tr>
  <?php endwhile; ?>
</table>
<?php include __DIR__.'/partials/footer.php'; ?>
