<?php      
    $servername = "localhost";
    $username = "root";
    $password = "Tamil@141101";
    $dbname = "rec_hostel";  
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo ("Database connected successfully <br>");
?>  