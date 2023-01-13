<?php
session_start();      
    $servername = "localhost";
    $username = "root";
    $password = "Tamil@141101";
    $dbname = "rec_hostel";  
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    alert("Connection failed: " . mysqli_connect_error());
  }

  // Extract the IV from the encrypted data
$iv_length = openssl_cipher_iv_length('aes-128-cbc');
$iv = substr($_GET['username'], 0, $iv_length);
$username_encrypted = substr($_GET['username'], $iv_length);

// Decode the encrypted data
$username_encrypted = urldecode($username_encrypted);

// Decrypt the username using the same secret key and IV
$key = 'secretkey';
$username = openssl_decrypt(base64_decode($username_encrypted), 'aes-128-cbc', $key, 0, $iv);

  if (!isset($_GET['username'])) {
    header('Location: main.php');
    exit;
  }

echo '<h1><center>Leave Status</center></h1>';
    $sql = "SELECT * FROM student_leave_request";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
    echo '<style>
    table {
    table-layout: fixed;
  }
  td, th {
    word-wrap: break-word;
  }
</style>';
        echo '<table class="table table-striped" border="5">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="vertical-align: middle;">Name with Reg no & Room no</th>';
        echo '<th style="vertical-align: middle;">Batch with Dpt & Sec</th>';
        echo '<th style="vertical-align: middle;">Leave Type (E/O)</th>';
        echo '<th style="vertical-align: middle;">Reason for Leave</th>';
        echo '<th style="vertical-align: middle;">Applied Date & Time</th>';
        echo '<th style="vertical-align: middle;">Leave Date</th>';
        echo '<th style="vertical-align: middle;">Leave Start & End Time</th>';
        echo '<th style="vertical-align: middle;">Address</th>';
        echo '<th style="vertical-align: middle;">Parents Phone Number</th>';
        echo '<th style="vertical-align: middle;">Class incharge Status</th>';
        echo '<th style="vertical-align: middle;">Hostel warden Status</th>';
        echo '<th style="vertical-align: middle;">HOD Status</th>';
        echo '<th style="vertical-align: middle;">Principal Status</th>';
        echo '<th style="vertical-align: middle;">Security Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

      while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['name'] .'<br>' . $row['register_number'] .'<br>' . $row['room_number'] . '</td>';
        echo '<td>' . $row['joining_year'] .'<br>' . $row['department'] . '</td>';
        echo '<td>' . $row['leave_type'] . '</td>';
        echo '<td>' . $row['reason'] . '</td>';
        echo '<td>' . $row['apply_date'] .'<br>' . $row['apply_time'] . '</td>';
        echo '<td>' . 'From - <br> ' . $row['start_date'] .'<br>' . 'To - <br> ' . $row['end_date'] . '</td>';
        echo '<td>' . $row['start_time'] .'<br>' . $row['end_time'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' .'Father - '. $row['fphone_number'] . '<br>' . 'Mother - ' . $row['mphone_number'] . '</td>';
        echo '<td>' . $row['classincharge_status'] . '</td>';
        echo '<td>' . $row['hostelwarden_status'] . '</td>';
        echo '<td>' . $row['hod_status'] . '</td>';
        echo '<td>' . $row['principal_status'] . '</td>';
        echo '<td>' . $row['security_status'] . '</td>';
        echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } 
    else {
        echo '<table class="table table-striped" border="1">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td><center>No Request found</center></td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
    }
    mysqli_close($conn);

?>
    
<!DOCTYPE html>
<html>
 <head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
      <title>Admin View Leave History</title>
    </head>
    <body>
      
</body>
</html>
    