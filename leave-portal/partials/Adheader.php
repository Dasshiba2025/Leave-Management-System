<?php require_once __DIR__ . '/../core/auth.php';

?>< !doctype html><html lang="en"><head><meta charset="utf-8"><title>Employee leave Application System</title><meta name="viewport" content="width=device-width, initial-scale=1"><style>:root {
  --teal: #0f6b6d;
  --teal-2: #0c5a5b;
  --bg: #f2f6f9;
  --card: #fff;
}

* {
  box-sizing: border-box;
  font-family: system-ui, Segoe UI, Roboto, Arial, sans-serif
}

body {
  margin: 0;
  background: var(--bg);
  color: #111
}

.topbar {
  position: sticky;
  top: 0;
  z-index: 1000;
  background: var(--teal-2);
  color: #fff;
  padding: 14px 18px;
  font-weight: 700
}

.right-label {
  float: right;
  color: #d9f0f1
}

.layout {
  display: flex;
  min-height: 100vh
}

.sidebar {
  position: sticky;
  top: 0;
  height: 100vh;
  width: 220px;
  background: #0d7b7e;
  color: #fff;
  padding: 14px 0
}

.brand {
  padding: 0 18px 8px;
  font-size: 18px;
  font-weight: 800
}

.menu a {
  display: block;
  padding: 12px 18px;
  color: #e9feff;
  text-decoration: none
}

.menu a.active,
.menu a:hover {
  background: #0b6f71
}

.content {
  flex: 1;
  padding: 20px
}

.page-title {
  font-size: 22px;
  font-weight: 800;
  margin: 4px 0 16px
}

.card-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
  gap: 16px
}

.card {
  background: var(--card);
  border-radius: 10px;
  padding: 16px;
  box-shadow: 0 6px 16px rgba(0, 0, 0, .06)
}

.card h4 {
  margin: 0 0 6px
}

.card .num {
  font-size: 28px;
  font-weight: 800;
  color: var(--teal-2)
}

.footer {
  position: sticky;
  bottom: 0;
  background: var(--teal-2);
  color: #fff;
  text-align: center;
  padding: 10px
}

table {
  border-collapse: collapse;
  width: 100%;
  background: #fff
}

th,
td {
  border: 1px solid #e5e7eb;
  padding: 10px;
  text-align: left
}

th {
  background: #0f6b6d;
  color: #fff
}

.btn {
  display: inline-block;
  background: #0f6b6d;
  color: #fff;
  border: 0;
  border-radius: 8px;
  padding: 8px 12px;
  text-decoration: none;
  cursor: pointer
}

.btn.secondary {
  background: #0ea5e9
}

.btn.danger {
  background: #dc2626
}

.btn.success {
  background: #16a34a
}

.badges {
  display: flex;
  gap: 10px;
  margin: 6px 0 14px
}

.badges a {
  display: inline-block;
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  padding: 8px 10px;
  text-decoration: none;
  color: #111
}

.badges a.active {
  background: #0f6b6d;
  color: #fff;
  border-color: #0f6b6d
}

.form-card {
  background: #fff;
  border: 1px solid #e5e7eb;
  border-radius: 10px;
  padding: 16px;
  max-width: 760px
}

.form-card input,
.form-card select,
.form-card textarea {
  width: 100%;
  padding: 10px;
  margin: 8px 0;
  border: 1px solid #e5e7eb;
  border-radius: 8px
}

.tools {
  display: flex;
  gap: 8px;
  flex-wrap: wrap
}

.search {
  margin-left: auto
}

.search input {
  padding: 8px;
  border-radius: 8px;
  border: 1px solid #e5e7eb
}
</style>
<script defer src="assets/app.js"></script>
</head>
<body>
  <div class="topbar">Employee leave Application System 
    <span class="right-label">Admin: <?php echo htmlspecialchars($_SESSION['user']['name'] ?? '');?>| <a href="logout.php" style="color:#fff">Logout</a></span>
  </div>
  <div class="layout">