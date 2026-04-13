<?php
$conn = mysqli_connect("localhost", "root", "", "db_laporan");

$nama = $_POST['nama'];
$email = $_POST['email'];
$asal = $_POST['asal'];
$lokasi = $_POST['lokasi'];
$jenis = $_POST['jenis'];
$deskripsi = $_POST['deskripsi'];
$tanggal = $_POST['tanggal'];

mysqli_query($conn, "INSERT INTO laporan 
(nama, email, asal, lokasi, jenis, deskripsi, tanggal) 
VALUES 
('$nama','$email','$asal','$lokasi','$jenis','$deskripsi','$tanggal')");

echo "sukses";
?>