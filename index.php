<?php
session_start();

$page = isset($_GET['page']) ? $_GET['page'] : 'home';

if($page == 'admin' && (!isset($_SESSION['role']) || $_SESSION['role'] != 'admin')){
  header("Location: index.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Keluhan Wisata Labuan Bajo</title>
  <link rel="stylesheet" href="style.css">
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar">
  <div class="logo">🌴 Keluhan Wisata</div>

  <?php if(isset($_SESSION['login'])){ ?>
    <div class="user-info">
      👤 <?php echo explode("@", $_SESSION['email'])[0]; ?>
    </div>
  <?php } ?>

  <div class="nav-right">
    <div class="menu-icon" onclick="toggleMenu()">☰</div>

    <div class="menu" id="menu">
      <a href="index.php?page=home">Beranda</a>
      <a href="index.php?page=lapor">Buat Laporan</a>
      <a href="index.php?page=daftar">Daftar Laporan</a>

      <?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){ ?>
      <a href="index.php?page=admin">Admin</a>
      <?php } ?>

      <?php if(!isset($_SESSION['login'])){ ?>
        <a href="login.php">Login</a>
        <a href="register.php">Register</a>
      <?php } else { ?>
        <a href="logout.php">Logout</a>
      <?php } ?>
    </div>
  </div>
</nav>

<!-- BERANDA -->
<section class="page <?php if($page != 'home') echo 'hidden'; ?>">

  <div class="hero">
    <h1>Sistem Laporan Keluhan Wisata Labuan Bajo</h1>
    <p>
      Platform digital untuk menyampaikan pengaduan mengenai fasilitas wisata,
      kebersihan, keamanan, dan pelayanan di kawasan wisata Labuan Bajo.
    </p>

    <!-- ✅ FIX TOMBOL -->
    <div class="hero-btn">
      <a href="index.php?page=lapor" class="btn-primary">Buat Laporan</a>
      <a href="index.php?page=daftar" class="btn-secondary">Lihat Laporan</a>
    </div>

  </div>

  <!-- CARA KERJA -->
  <div class="cara-kerja">
    <h2>Bagaimana Sistem Ini Bekerja?</h2>

    <div class="card-container">

      <div class="card">
        <div class="icon">📄</div>
        <h3>Laporkan Keluhan</h3>
        <p>Isi form laporan dengan detail keluhan.</p>
      </div>

      <div class="card">
        <div class="icon">🛡️</div>
        <h3>Ditindaklanjuti</h3>
        <p>Pengelola wisata akan memproses laporan.</p>
      </div>

      <div class="card">
        <div class="icon">✨</div>
        <h3>Wisata Lebih Baik</h3>
        <p>Meningkatkan kualitas pariwisata.</p>
      </div>

    </div>
  </div>

</section>
<!-- FORM -->
<section class="page <?php if($page != 'lapor') echo 'hidden'; ?>">
  <h2>Buat Laporan Keluhan</h2>

<form id="formKeluhan" method="POST" action="simpan_laporan.php">
    <div class="form-row">
      <div class="form-group">
        <label>Nama</label>
        <input type="text" id="nama" required>
      </div>

      <div class="form-group">
        <label>Email</label>
        <input type="email" id="email" required>
      </div>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label>Asal</label>
        <input type="text" id="asal">
      </div>

      <div class="form-group">
        <label>Lokasi</label>
        <select id="lokasi">
          <option>Pulau Komodo</option>
          <option>Pantai Pink</option>
          <option>Pulau Padar</option>
          <option>Gua Rangko</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label>Jenis</label>
      <select id="jenis">
        <option>Fasilitas</option>
        <option>Kebersihan</option>
        <option>Keamanan</option>
      </select>
    </div>

    <div class="form-group">
      <label>Deskripsi</label>
      <textarea id="deskripsi"></textarea>
    </div>

    <div class="form-group">
      <label>Tanggal</label>
      <input type="date" id="tanggal">
    </div>

    <button type="submit">Kirim</button>
  </form>
</section>

<!-- DAFTAR -->
<section class="page <?php if($page != 'daftar') echo 'hidden'; ?>">
  <h2>Daftar Laporan</h2>
  <div id="laporanContainer"></div>
</section>

<!-- ADMIN -->
<?php if(isset($_SESSION['role']) && $_SESSION['role'] == "admin"){ ?>
<section class="page <?php if($page != 'admin') echo 'hidden'; ?>">
  <h2>Admin</h2>

  <table>
    <thead>
      <tr>
        <th>Nama</th>
        <th>Lokasi</th>
        <th>Jenis</th>
        <th>Status</th>
        <th>Aksi</th>
      </tr>
    </thead>
    <tbody id="adminTable"></tbody>
  </table>
</section>
<?php } ?>

<footer>
  <p>Sistem Laporan Keluhan Wisata Labuan Bajo</p>
</footer>

<script src="script.js"></script>

</body>
</html>
