<?php
$conn = mysqli_connect("localhost", "root", "", "db_laporan");

$id = $_GET['id'];

mysqli_query($conn, "UPDATE laporan SET status='Selesai' WHERE id=$id");
?>
