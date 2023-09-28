<?php

$conn = mysqli_connect("localhost", "root", "", "ev");
if ($conn->connect_error) {
  echo "Connection Error" . (mysqli_connect_error());
  die($conn);
}
