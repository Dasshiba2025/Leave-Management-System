<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'employee') {
    header("Location: ../login.php");
    exit;
}
?>
<?php include "../config/db.php"; ?>
<?php include "../includes/header.php"; ?>


<section class="banner" style="background:url('https://images.unsplash.com/photo-1581092795360-9cbf2f1f4c64') no-repeat center/cover; height:300px; display:flex; align-items:center; justify-content:center; color:white; text-shadow:2px 2px 4px #000;">
  <h2>Welcome to the Employee Leave Application System</h2>
</section>

<section class="actions" style="margin:40px auto; max-width:800px; display:flex; flex-wrap:wrap; gap:20px; justify-content:center;">
  <div class="action-card" style="background:#fff; border-radius:10px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center; width:240px;">
    <h3>Apply for Leave</h3>
    <p>Submit a new leave request easily.</p>
    <a href="apply_leave.php"><button>Apply Now</button></a>
  </div>
  <div class="action-card" style="background:#fff; border-radius:10px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center; width:240px;">
    <h3>View Leave Status</h3>
    <p>Track the progress of your requests.</p>
    <a href="leave_status.php"><button>Check Status</button></a>
  </div>
  <div class="action-card" style="background:#fff; border-radius:10px; padding:25px; box-shadow:0 4px 10px rgba(0,0,0,0.1); text-align:center; width:240px;">
    <h3>Leave History</h3>
    <p>Review your past leave records.</p>
    <a href="leave_history.php"><button>View History</button></a>
  </div>
</section>

<?php include "../includes/footer.php"; ?>
