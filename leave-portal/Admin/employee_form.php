<?php require __DIR__.'/config/db.php';
include __DIR__.'/partials/header.php';
include __DIR__.'/partials/sidebar.php';

$id = (int)($_GET['id'] ?? 0);
$data = ['emp_code'=>'','name'=>'','email'=>'','gender'=>'male','phone'=>'','department'=>'','designation'=>'','joining_date'=>'','role'=>'faculty','status'=>'Active'];
if($id){
  $st=$conn->prepare("SELECT * FROM employees WHERE id=?"); $st->bind_param("i",$id); $st->execute();
  $row=$st->get_result()->fetch_assoc(); if($row) $data=$row;
}
?>
<div class="page-title"><?= $id? 'Edit Employee' : 'Add Employee' ?></div>

<form class="form-card" method="post" action="employee_save.php">
  <input type="hidden" name="id" value="<?= $id ?>">
  <label>Employee ID</label>
  <input name="emp_code" required value="<?= htmlspecialchars($data['emp_code']) ?>">
  <label>Name</label>
  <input name="name" required value="<?= htmlspecialchars($data['name']) ?>">
  <label>Email</label>
  <input type="email" name="email" required value="<?= htmlspecialchars($data['email']) ?>">
  <label>Gender</label>
  <select name="gender">
    <?php foreach(['male','female','other'] as $g): ?>
      <option value="<?= $g ?>" <?= $data['gender']===$g?'selected':'' ?>><?= ucfirst($g) ?></option>
    <?php endforeach; ?>
  </select>
  <label>Phone</label>
  <input name="phone" value="<?= htmlspecialchars($data['phone']) ?>">
  <label>Department</label>
  <input name="department" value="<?= htmlspecialchars($data['department']) ?>">
  <label>Designation</label>
  <input name="designation" value="<?= htmlspecialchars($data['designation']) ?>">
  <label>Joining Date</label>
  <input type="date" name="joining_date" value="<?= htmlspecialchars($data['joining_date']) ?>">
  <label>Role</label>
  <select name="role">
    <?php foreach(['faculty','staff','admin'] as $r): ?>
      <option value="<?= $r ?>" <?= $data['role']===$r?'selected':'' ?>><?= ucfirst($r) ?></option>
    <?php endforeach; ?>
  </select>
  <label>Status</label>
  <select name="status">
    <?php foreach(['Active','Inactive'] as $s): ?>
      <option value="<?= $s ?>" <?= $data['status']===$s?'selected':'' ?>><?= $s ?></option>
    <?php endforeach; ?>
  </select>
  <div style="display:flex;gap:8px;flex-wrap:wrap;margin-top:6px">
    <button class="btn" type="submit">Save</button>
    <a class="btn secondary" href="employees.php" type="button">Back</a>
  </div>
</form>
<?php include __DIR__.'/partials/footer.php'; ?>
