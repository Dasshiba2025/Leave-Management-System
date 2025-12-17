<?php require __DIR__.'/config/db.php';
include __DIR__.'/partials/header.php';
include __DIR__.'/partials/sidebar.php';

$q = trim($_GET['q'] ?? '');
$sql = "SELECT * FROM employees";
if($q!==''){
  $like = "%$q%";
  $stmt=$conn->prepare("$sql WHERE name LIKE ? OR emp_code LIKE ? OR email LIKE ? ORDER BY id DESC");
  $stmt->bind_param("sss",$like,$like,$like);
  $stmt->execute(); $rows=$stmt->get_result();
} else {
  $rows = $conn->query("$sql ORDER BY id DESC");
}
?>
<div class="page-title">Employee List
  <a class="btn" href="employee_form.php">+ Add Employee</a>
  <span class="search"><form method="get"><input name="q" value="<?= htmlspecialchars($q) ?>" placeholder="Search..."></form></span>
</div>

<table id="empTable">
  <tr>
    <th>Employee Id</th><th>Name</th><th>Email</th><th>Gender</th>
    <th>Phone Number</th><th>Department</th><th>Designation</th>
    <th>Joining Date</th><th>Role</th><th>Status</th><th>Actions</th>
  </tr>
  <?php while($r=$rows->fetch_assoc()): ?>
  <tr>
    <td><?= htmlspecialchars($r['emp_code']) ?></td>
    <td><?= htmlspecialchars($r['name']) ?></td>
    <td><?= htmlspecialchars($r['email']) ?></td>
    <td><?= htmlspecialchars($r['gender']) ?></td>
    <td><?= htmlspecialchars($r['phone']) ?></td>
    <td><?= htmlspecialchars($r['department']) ?></td>
    <td><?= htmlspecialchars($r['designation']) ?></td>
    <td><?= htmlspecialchars($r['joining_date']) ?></td>
    <td><?= htmlspecialchars($r['role']) ?></td>
    <td><?= htmlspecialchars($r['status']) ?></td>
    <td class="tools">
      <a class="btn secondary" href="employee_form.php?id=<?= (int)$r['id'] ?>">Edit</a>
      <button class="btn danger" onclick="confirmDelete(<?= (int)$r['id'] ?>)">Delete</button>
    </td>
  </tr>
  <?php endwhile; ?>
</table>

<form id="delForm" method="post" action="employee_delete.php"><input type="hidden" name="id" id="delId"></form>
<?php include __DIR__.'/partials/footer.php'; ?>
