<?php
$conn = mysqli_connect("localhost", "root", "", "db_laporan");

$data = mysqli_query($conn, "SELECT * FROM laporan");

$result = [];

while($row = mysqli_fetch_assoc($data)){
  $result[] = $row;
}

echo json_encode($result);
?>