<?php
require __DIR__.'/config/db.php';
require __DIR__.'/core/auth.php';

$id = (int)($_POST['id'] ?? 0);
$emp_code = trim($_POST['emp_code'] ?? '');
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$gender = $_POST['gender'] ?? 'other';
$phone = trim($_POST['phone'] ?? '');
$department = trim($_POST['department'] ?? '');
$designation = trim($_POST['designation'] ?? '');
$joining_date = $_POST['joining_date'] ?? null;
$role = $_POST['role'] ?? 'staff';
$status = $_POST['status'] ?? 'Active';

if($id){
  $sql="UPDATE employees SET emp_code=?,name=?,email=?,gender=?,phone=?,department=?,designation=?,joining_date=?,role=?,status=? WHERE id=?";
  $stmt=$conn->prepare($sql);
  $stmt->bind_param("ssssssssssi",$emp_code,$name,$email,$gender,$phone,$department,$designation,$joining_date,$role,$status,$id);
  $stmt->execute();
} else {
  $sql="INSERT INTO employees (emp_code,name,email,gender,phone,department,designation,joining_date,role,status) VALUES (?,?,?,?,?,?,?,?,?,?)";
  $stmt=$conn->prepare($sql);
  $stmt->bind_param("ssssssssss",$emp_code,$name,$email,$gender,$phone,$department,$designation,$joining_date,$role,$status);
  $stmt->execute();
}
header('Location: employees.php'); exit();
