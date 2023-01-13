<?php      
    $servername = "localhost";
    $username = "root";
    $password = "Tamil@141101";
    $dbname = "rec_hostel";  
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
    alert("Connection failed: " . mysqli_connect_error());
  }

if (isset($_POST['submit'])) {
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);

  if ($user_type == "Admin") {
    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: admin_dashboard.php');
    } 
    else {
    echo '<script>
    alert("Username and Password do not match");
    window.location.href = "main.php";
    </script>';
    }
  }

  if ($user_type == "Student") {
    $sql = "SELECT * FROM student WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: student_dashboard.php');
    } 
    else {
    echo '<script>
    alert("Username and Password do not match");
    window.location.href = "main.php";
    </script>';
    }
  }
  
  if($user_type =="Class Incharge") {
    $sql = "SELECT * FROM classincharge  WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: classincharge_dashboard.php');
    }
    else {
      echo '<script>
    alert("Username and Password do not match");
    window.location.href = "main.php";
    </script>';
    }
    
  }
  if($user_type == "Hostel Warden") {
    $sql = "SELECT * FROM hostelwarden WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: hostelwarden_dashboard.php');
    }
    else {
      echo '<script>
    alert("Username and Password do not match");
    window.location.href = "main.php";
    </script>';
    }
  }

  if($user_type == "HOD") {
    $sql = "SELECT * FROM hod WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: hod_dashboard.php');
    }
    else {
      echo '<script>
    alert("Username and Password do not match");
    window.location.href = "main.php";
    </script>';
    }
  }

  if($user_type == "Principal") {
    $sql = "SELECT * FROM principal WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: principal_dashboard.php');
    }
    else {
      echo '<script>
    alert("Username and Password do not match");
    window.location.href = "main.php";
    </script>';
    }
  }

  if($user_type == "Security") {
    $sql = "SELECT * FROM security WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
      session_start();
      $_SESSION['username'] = $username;
      $_SESSION['user_type'] = $user_type;
      header('Location: security_dashboard.php');
    }
    else {
      echo '<script>
    alert("Username and Password do not match");
    window.location.href = "security_login.php";
    </script>';
    }
  }
}
?>