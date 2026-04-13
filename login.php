<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_laporan");

if(isset($_POST['login'])){
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $query = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
  $data = mysqli_fetch_assoc($query);

  if($data){
    if($data['password'] == $password){

      $_SESSION['login'] = true;
      $_SESSION['email'] = $email;

      if($email == "admin@gmail.com"){
        $_SESSION['role'] = "admin";
      } else {
        $_SESSION['role'] = "user";
      }

      header("Location: dashboard.php");
      exit;

    } else {
      echo "<script>alert('Password salah!');</script>";
    }

  } else {
    echo "<script>alert('Email tidak ditemukan!');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login - Sistem Laporan Wisata</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{
background:#f5f6f8;
display:flex;
justify-content:center;
align-items:center;
height:100vh;
font-family:Arial;
}
.login-box{
background:white;
padding:40px;
border-radius:10px;
width:100%;
max-width:400px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}
.btn-login{
background:#1f8ea7;
color:white;
}
</style>

</head>

<body>

<div class="login-box">

<h3 class="text-center mb-3">Login Sistem Laporan</h3>

<form method="POST">
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <button type="submit" name="login" class="btn btn-login w-100">
    Login
  </button>
</form>

<div class="text-center mt-3">
<p>Belum punya akun? <a href="register.php">Register</a></p>
</div>

</div>

</body>
</html>
