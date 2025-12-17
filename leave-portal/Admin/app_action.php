<?php
require __DIR__.'/config/db.php';
require __DIR__.'/core/auth.php';

if($_SERVER['REQUEST_METHOD']==='POST'){
  $id=(int)($_POST['id']??0);
  $do=$_POST['do']??'';
  if($id && in_array($do,['approve','reject'])){
    $new=$do==='approve'?'approved':'rejected';
    $stmt=$conn->prepare("UPDATE leave_applications SET status=? WHERE id=?");
    $stmt->bind_param("si",$new,$id);
    $stmt->execute();
  }
}
header('Location: '.$_SERVER['HTTP_REFERER']); exit();
