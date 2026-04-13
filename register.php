<?php
$conn = mysqli_connect("localhost", "root", "", "db_laporan");

if(isset($_POST['register'])){
  $email = trim($_POST['email']);
  $password = trim($_POST['password']);

  $cek = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");

  if(mysqli_num_rows($cek) > 0){
    echo "<script>alert('Email sudah terdaftar!');</script>";
  } else {
    mysqli_query($conn, "INSERT INTO users (email, password) VALUES ('$email', '$password')");
    echo "<script>alert('Registrasi berhasil!'); window.location='login.php';</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Register</title>

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
.box{
background:white;
padding:40px;
border-radius:10px;
width:100%;
max-width:400px;
box-shadow:0 5px 20px rgba(0,0,0,0.1);
}
</style>

</head>

<body>

<div class="box">

<h3 class="text-center mb-3">Register</h3>

<form method="POST">
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>

  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>

  <button type="submit" name="register" class="btn btn-primary w-100">
    Register
  </button>
</form>

<div class="text-center mt-3">
<p>Sudah punya akun? <a href="login.php">Login</a></p>
</div>

</div>

</body>
</html>
