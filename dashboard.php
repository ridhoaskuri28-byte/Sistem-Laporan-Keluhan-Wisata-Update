<?php
session_start();
if(!isset($_SESSION['login'])){
  header("Location: login.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard - Sistem Laporan</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>

body{
  background:#f5f6f8;
  font-family:Arial;
}

.navbar{
  background:#1f8ea7;
}

.navbar-brand{
  color:white;
  font-weight:bold;
}

.card{
  border:none;
  box-shadow:0 5px 15px rgba(0,0,0,0.08);
}

</style>

</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand">Dashboard Laporan Wisata</a>

    <div>
      <a href="index.php" class="btn btn-light">Halaman Laporan</a>
      <a href="logout.php" class="btn btn-outline-light">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-5">

<h3 class="mb-4">
  Selamat Datang, 
  <?php 
    echo $_SESSION['email']; 
  ?>
</h3>

<div class="row mb-4">

  <div class="col-md-4">
    <div class="card text-center p-3">
      <h5>📊 Total Laporan</h5>
      <h2 id="totalLaporan">0</h2>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card text-center p-3">
      <h5>⏳ Diproses</h5>
      <h2 id="laporanProses">0</h2>
    </div>
  </div>

  <div class="col-md-4">
    <div class="card text-center p-3">
      <h5>✅ Selesai</h5>
      <h2 id="laporanSelesai">0</h2>
    </div>
  </div>

</div>

<div class="row">

  <div class="col-md-4 mb-3">
    <div class="card p-4 text-center">
      <h4>📝</h4>
      <h5>Buat Laporan</h5>
      <p>Kirim keluhan wisata</p>
      <a href="index.php?page=lapor" class="btn btn-primary">Buka</a>
    </div>
  </div>

  <div class="col-md-4 mb-3">
    <div class="card p-4 text-center">
      <h4>📋</h4>
      <h5>Daftar Laporan</h5>
      <p>Lihat laporan yang ada</p>
      <a href="index.php?page=daftar" class="btn btn-primary">Lihat</a>
    </div>
  </div>

  <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){ ?>
  <div class="col-md-4 mb-3">
    <div class="card p-4 text-center">
      <h4>⚙</h4>
      <h5>Admin Panel</h5>
      <p>Kelola laporan</p>
      <a href="index.php?page=admin" class="btn btn-primary">Kelola</a>
    </div>
  </div>
  <?php } ?>

</div>

</div>

<script>

let data = JSON.parse(localStorage.getItem("laporan")) || [];

let total = data.length;
let proses = data.filter(l => l.status === "Diproses").length;
let selesai = data.filter(l => l.status === "Selesai").length;

document.getElementById("totalLaporan").innerText = total;
document.getElementById("laporanProses").innerText = proses;
document.getElementById("laporanSelesai").innerText = selesai;

</script>

</body>
</html>
