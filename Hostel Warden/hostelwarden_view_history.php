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
  if (!isset($_GET['username'])) {
    header('Location: main.php');
    exit;
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

echo '<h1><center>Leave History</center></h1>';
    $sql = "SELECT * FROM student_leave_request WHERE hostelwarden_status='Accepted' OR hostelwarden_status='Rejected'";
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
        echo '<th style="vertical-align: middle;">Name</th>';
        echo '<th style="vertical-align: middle;">Register Number</th>';
        echo '<th style="vertical-align: middle;">Department & Section</th>';
        echo '<th style="vertical-align: middle;">Room Number</th>';
        echo '<th style="vertical-align: middle;">Leave Type (Emergency/Outing)</th>';
        echo '<th style="vertical-align: middle;">Reason for Leave</th>';
        echo '<th style="vertical-align: middle;">Applied Date & Time</th>';
        echo '<th style="vertical-align: middle;">Leave Start Date & End Date</th>';
        echo '<th style="vertical-align: middle;">Leave Start Time & End Time</th>';
        echo '<th style="vertical-align: middle;">Address</th>';
        echo '<th style="vertical-align: middle;">Parents Phone Number</th>';
        echo '<th style="vertical-align: middle;">Hostel Warden Status</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';

            while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['name'] . '</td>';
        echo '<td>' . $row['register_number'] . '</td>';
        echo '<td>' . $row['department'] . '</td>';
        echo '<td>' . $row['room_number'] . '</td>';
        echo '<td>' . $row['leave_type'] . '</td>';
        echo '<td>' . $row['reason'] . '</td>';
        echo '<td>' . $row['apply_date'] .'<br>' . $row['apply_time'] . '</td>';
        echo '<td>' . $row['start_date'] .'<br>' . $row['end_date'] . '</td>';
        echo '<td>' . $row['start_time'] .'<br>' . $row['end_time'] . '</td>';
        echo '<td>' . $row['address'] . '</td>';
        echo '<td>' .'Father - '. $row['fphone_number'] . '<br>' . 'Mother - ' . $row['mphone_number'] . '</td>';
        echo '<td>' . $row['hostelwarden_status'] . '</td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } 
    else {
        echo '<table class="table table-striped" border="1">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td><center>No history found</center></td>';
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
      <title>Hostel Warden View Leave History</title>
    </head>
    <body>
      
</body>
</html>
    