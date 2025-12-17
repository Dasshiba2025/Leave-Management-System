<?php
require __DIR__.'/config/db.php';
require __DIR__.'/core/auth.php';

$id = (int)($_POST['id'] ?? 0);
if($id){ $stmt=$conn->prepare("DELETE FROM employees WHERE id=?"); $stmt->bind_param("i",$id); $stmt->execute(); }
header('Location: employees.php'); exit();
