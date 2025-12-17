<?php require __DIR__.'./config/db.php';
include __DIR__.'/partials/header.php';
include __DIR__.'/partials/sidebar.php';

$all=$pending=$approved=$rejected=0;
$all  = (int)($conn->query("SELECT COUNT(*) c FROM leave_applications")->fetch_assoc()['c'] ?? 0);
$res  = $conn->query("SELECT status,COUNT(*) c FROM leave_applications GROUP BY status");
while($r=$res->fetch_assoc()){ ${$r['status']} = (int)$r['c']; }
?>
<div class="page-title">Welcome to online leave application system</div>
<div class="card-grid">
  <div class="card"><h4>All Applications</h4><div class="num"><?= $all ?></div></div>
  <div class="card"><h4>Pending Applications</h4><div class="num"><?= $pending ?></div></div>
  <div class="card"><h4>Approved Applications</h4><div class="num"><?= $approved ?></div></div>
  <div class="card"><h4>Rejected Applications</h4><div class="num"><?= $rejected ?></div></div>
</div>
<?php include __DIR__.'/partials/footer.php'; ?>
