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

  // $username = $_GET['username'];
  if (!isset($_GET['username'])) {
    header('Location: security_login.php');
    exit;
  }

echo '<h1><center>Leave Request</center></h1>';
    $sql = "SELECT * FROM student_leave_request WHERE (classincharge_status='Accepted' || classincharge_status='Not Need') AND hostelwarden_status='Accepted' AND (hod_status='Accepted'|| hod_status='Not Need') AND (principal_status='Accepted' || principal_status='Not Need') AND security_status='Pending'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        echo '<style>
  table {
    table-layout: fixed;
  }
  td {
    word-wrap: break-word;
  }
</style>';
        echo '<table class="table table-striped" border="5">';
        echo '<thead>';
        echo '<tr>';
        echo '<th style="vertical-align: middle;">Name</th>';
        echo '<th style="vertical-align: middle;">Register Number</th>';
        echo '<th style="vertical-align: middle;">Applied Date</th>';
        echo '<th style="vertical-align: middle;">Applied Time</th>';
        echo '<th style="vertical-align: middle;">Leave Start Date</th>';
        echo '<th style="vertical-align: middle;">Leave End Date</th>';
        echo '<th style="vertical-align: middle;">Security Status</th>';
        echo '<th style="vertical-align: middle;">Action</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        while ($row = mysqli_fetch_assoc($result)) {
            echo '<tr>';
            echo '<td>' . $row['name'] . '</td>';
            echo '<td>' . $row['register_number'] . '</td>';
            echo '<td>' . $row['apply_date'] . '</td>';
            echo '<td>' . $row['apply_time'] . '</td>';
            echo '<td>' . $row['start_date'] . '</td>';
            echo '<td>' . $row['end_date'] . '</td>';
            echo '<td>' . $row['security_status'] . '</td>';
            echo '<td>
             <form action="" method="post">
              <input type="hidden" name="id" value="' . $row['id'] . '">
              <button type="submit" name="accept" class="btn btn-success" style="padding: 5px 5px;">Verify</button>
              <button type="submit" name="reject" class="btn btn-danger" style="padding: 5px 5px;">Reject</button>
              </form>
            </td>';
            echo '</tr>';
        }
        echo '</tbody>';
        echo '</table>';
    } else {
        echo '<table class="table table-striped" border="1">';
        echo '<tbody>';
        echo '<tr>';
        echo '<td><center>No Request found</center></td>';
        echo '</tr>';
        echo '</tbody>';
        echo '</table>';
    }

if (isset($_POST['accept'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "UPDATE student_leave_request SET security_status='Verified' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_affected_rows($conn) > 0) {
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;
  }
} 
elseif (isset($_POST['reject'])) {
  $id = mysqli_real_escape_string($conn, $_POST['id']);
  $sql = "UPDATE student_leave_request SET security_status='Not Verified' WHERE id='$id'";
  $result = mysqli_query($conn, $sql);

  if (mysqli_affected_rows($conn) > 0) {
    header("Location: {$_SERVER['REQUEST_URI']}");
    exit;
  }
}

mysqli_close($conn);

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <title>Principal View Leave Request</title>
</head>
<body>
  
</body>
</html>
