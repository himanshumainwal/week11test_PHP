<?php
  $conn = mysqli_connect("localhost","root","", "procedural") or die("Connection failed to connect");
  $sql = "SELECT * FROM test_info";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));

?>