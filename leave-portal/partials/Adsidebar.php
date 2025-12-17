<?php $current = basename($_SERVER['PHP_SELF']); ?>
<aside class="sidebar">
  <div class="brand">Dashboard</div>
  <nav class="menu">
    <a href="index.php" class="<?= $current==='index.php'?'active':'' ?>">Dashboard</a>
    <a href="employees.php" class="<?= $current==='employees.php'?'active':'' ?>">Employee List</a>
    <a href="applications.php" class="<?= $current==='applications.php'?'active':'' ?>">Application List</a>
  </nav>
</aside>
<div class="content">
