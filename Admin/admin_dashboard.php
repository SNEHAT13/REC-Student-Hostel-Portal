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
if (!isset($_SESSION['username'])) {
  header('Location: main.php');
  exit;
}
if (isset($_POST['logout'])) {
  session_destroy();
  unset($_SESSION['logout']);
  header("Location: main.php");
  exit;
}
$username = $_SESSION['username'];
$sql = "SELECT * FROM admin WHERE username='$username'";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
while ($row = mysqli_fetch_assoc($result)) {
  $profile = $row['name'];
}
}

// Generate a random IV
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));

// Encrypt the username using a secret key and the IV
$key = 'secretkey';
$username_encrypted = base64_encode(openssl_encrypt($username, 'aes-128-cbc', $key, 0, $iv));

// Append the IV to the encrypted data
$data_encrypted = $iv . $username_encrypted;

// Encode the encrypted data for use in the URL
$data_encrypted_url = urlencode($data_encrypted);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <!-- <script>
    window.onunload = function() {
      <?php session_destroy(); ?>
      window.location.href = "login.php";
    }

  </script> -->
  <style>
  </style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="#">Welcome!!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="admin_view_history.php?username=<?php echo $data_encrypted_url;?>" target="_blank">Track Leave Request</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
      <div class="btn-group">
        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <?php echo $profile; ?>
        </button>
        <div class="dropdown-menu dropdown-menu-right">
        <button class="dropdown-item" type="button" onclick="alert('You clicked on your profile')">Profile</button>
        <div class="dropdown-divider"></div>
        <form  method="post">
        <button type="submit" name="logout" class="dropdown-item">Logout</button>
        </form>
        </div>
      </div>
    </div>
  </nav>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-QM6oUf9XU+v6pmCCfW8dYtfGwZcKgv6uG7V8e5p5K7V5JIo/ed7R8lKl+D7ZlLdK" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>