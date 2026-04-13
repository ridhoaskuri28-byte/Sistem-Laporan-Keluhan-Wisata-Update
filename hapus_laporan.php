<?php
$conn = mysqli_connect("localhost", "root", "", "db_laporan");

$id = $_GET['id'];

mysqli_query($conn, "DELETE FROM laporan WHERE id=$id");
?>