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

if (isset($_POST['submit'])) {
  
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $register_number = mysqli_real_escape_string($conn, $_POST['register-number']);
  $batch = mysqli_real_escape_string($conn, $_POST['batch-type']);
  $department = mysqli_real_escape_string($conn, $_POST['department-type']);
  $section = mysqli_real_escape_string($conn, $_POST['section']);
  $room_number = mysqli_real_escape_string($conn, $_POST['room-number']);
  $leave_type = mysqli_real_escape_string($conn, $_POST['leave-type']);
  $reason = mysqli_real_escape_string($conn, $_POST['reason']);
  $start_date = mysqli_real_escape_string($conn, $_POST['start-date']);
  $start_time = mysqli_real_escape_string($conn, $_POST['start-time']);
  $end_date = mysqli_real_escape_string($conn, $_POST['end-date']);
  $end_time = mysqli_real_escape_string($conn, $_POST['end-time']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $fphone_number = mysqli_real_escape_string($conn, $_POST['fphone-number']);
  $mphone_number = mysqli_real_escape_string($conn, $_POST['mphone-number']);
  if ($leave_type == "Emergency") {
    $classincharge_status = "Pending";
    $hostelwarden_status = "Pending";
    $hod_status = "Pending";
    $principal_status = "Pending";
    $security_status = "Pending";
  }
  if($leave_type == "Outing") {
    $classincharge_status = "Not need";
    $hostelwarden_status = "Pending";
    $hod_status = "Not need";
    $principal_status = "Not need";
    $security_status = "Pending";
  }
  
  if ($register_number == $username) {
    $sql = "INSERT INTO student_leave_request (name, register_number, batch, department, section, room_number, leave_type, reason, apply_date, apply_time, start_date, start_time, end_date, end_time, address, fphone_number, mphone_number, classincharge_status, hostelwarden_status, hod_status, principal_status, security_status) VALUES 
    ('$name', '$register_number', '$batch', '$department', '$section', '$room_number', '$leave_type', '$reason', CURDATE(), NOW(), '$start_date', '$start_time', '$end_date', '$end_time', '$address', '$mphone_number', '$fphone_number', '$classincharge_status','$hostelwarden_status','$hod_status','$principal_status', '$security_status')";
    
    if (mysqli_query($conn, $sql)) {

    // Generate a random IV
$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-128-cbc'));

// Encrypt the username using a secret key and the IV
$key = 'secretkey';
$username_encrypted = base64_encode(openssl_encrypt($username, 'aes-128-cbc', $key, 0, $iv));

// Append the IV to the encrypted data
$data_encrypted = $iv . $username_encrypted;

// Encode the encrypted data for use in the URL
$data_encrypted_url = urlencode($data_encrypted);
header("Location: student_view_response.php?username=$data_encrypted_url");
    } 
    else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  else {
    echo '<script>
    alert("It is not your register number");
    </script>';
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
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <title>Hostel Leave Form</title>
  <style>
    body {
      background-color: lightblue;  
  font-family: Arial, sans-serif;
}

.container {
  max-width: 550px;
  margin: 0 auto;
  background-color: lightcyan;
  padding: 15px;
  border-radius: 5px;
}

form {
  margin-bottom: 20px;
}

label {
  display: block;
  margin-bottom: 8px;
  font-weight: bold;
}

input, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
  resize: vertical;
}

button[type="submit"] {
  background-color: #4caf50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

button[type="submit"]:hover {
  background-color: #45a049;
}

</style>
<script>
      $(document).ready(function() {
        // An object containing the mapping of year of joining to department options
        var departmentOptions = {
          '2019': ['AERO', 'BME', 'BT', 'CHEM', 'CIVIL', 'CSBS', 'CSE', 'ECE', 'EEE', 'FT', 'IT', 'MCT', 'MECH', 'MECH'],
          '2020': [],
          '2021': [],
          '2022': []
        };

        // Listen for changes in the year of joining dropdown menu
        $('#batch-type').change(function() {
          // Get the selected year of joining
          var year = $(this).val();

          // Update the options in the department dropdown menu
          var departmentSelect = $('#department-type');
          departmentSelect.empty(); // Clear the current options
          departmentSelect.append($('<option>', {
            value: '',
            text: 'Choose your department'
          }));
          departmentOptions[year].forEach(function(department) {
            departmentSelect.append($('<option>', {
              value: department,
              text: department
            }));
          });
        });
      });
    </script>
</head>
<body>

  <div class="container mt-5">
    <h4 class="text-center">Student Leave Form</h4>
    <form onsubmit="return validateForm()" method="post">
      <div class="form-group">
        <label for="name">Name :</label>
        <input type="text" class="form-control" id="name" name="name">
      </div>
      <div class="form-group">
        <label for="name">Register Number :</label>
        <input type="text" class="form-control" id="register-number" name="register-number">
      </div>
      <div class="form-group">
          <label for="batch">Batch :</label>
          <select class="form-control" id="batch-type" name="batch-type">
          <option value="">Choose your year of joining</option>
          <option value="2019">2019</option>
          <option value="2020">2020</option>
          <option value="2021">2021</option>
          <option value="2022">2022</option>
          </select>
        </div>
      <div class="form-group">
          <label for="department_type">Department :</label>
          <select class="form-control" id="department-type" name="department-type">
          <option value="">Choose your department</option>
          </select>
        </div>
        <div class="form-group">
          <label for="section">Section :</label>
          <select class="form-control" id="section" name="section">
          <option value="">Choose your section</option>
          <option value="A">A</option>
          <option value="B">B</option>
          <option value="C">C</option>
          <option value="D">D</option>
          <option value="E">E</option>
          </select>
        </div>
      <div class="form-group">
        <label for="room-number">Room Number :</label>
        <input type="text" class="form-control" id="room-number" name="room-number">
      </div>
      <div class="form-group">
          <label for="leave_type">Purpose for leave</label>
          <select class="form-control" id="leave-type" name="leave-type">
          <option value="">Choose your purpose for leave</option>
          <option value="Emergency">Emergency</option>
          <option value="Outing">Outing</option>
          </select>
        </div>
      <div class="form-group">
        <label for="reason">Reason for Leave:</label>
        <textarea class="form-control" id="reason" rows="3" name="reason"></textarea>
      </div>
      <div class="form-group">
        <label for="start-date">Start Date:</label>
        <input type="date" class="form-control" id="start-date" name="start-date">
      </div>
      <div class="form-group">
        <label for="start-time">Start Time:</label>
        <input type="time" class="form-control" id="start-time" name="start-time">
      </div>
      <div class="form-group">
        <label for="end-date">End Date:</label>
        <input type="date" class="form-control" id="end-date" name="end-date">
      </div>
      <div class="form-group">
        <label for="end-time">End Time:</label>
        <input type="time" class="form-control" id="end-time" name="end-time">
      </div>
      <div class="form-group">
        <label for="reason">Address:</label>
        <textarea class="form-control" id="address" rows="3" name="address" placeholder="Incase of going to home, provide your home address or incase of outing, provide the address where you go."></textarea>
      </div>
      <div class="form-group">
        <label for="phone-number">Father Phone Number:</label>
        <input type="text" class="form-control" id="fphone-number" name="fphone-number">
      </div>
      <div class="form-group">
        <label for="phone-number">Mother Phone Number:</label>
        <input type="text" class="form-control" id="mphone-number" name="mphone-number">
      </div>
      <button type="submit" class="btn btn-primary" name="submit">Submit</button>
    </form>
  </div>
  <script>
    function validateForm() {
  // Get form values
  var name = document.getElementById('name').value;
  var registerNumber = document.getElementById('register-number').value;
  var batch = document.getElementById('batch-type').value;
  var department = document.getElementById('department-type').value;
  var section = document.getElementById('section').value;
  var roomNumber = document.getElementById('room-number').value;
  var leaveType = document.getElementById('leave-type').value;
  var reason = document.getElementById('reason').value;
  var startDate = document.getElementById('start-date').value;
  var startTime = document.getElementById('start-time').value;
  var endDate = document.getElementById('end-date').value;
  var endTime = document.getElementById('end-time').value;
  var address = document.getElementById('address').value;
  var fphoneNumber = document.getElementById('fphone-number').value;
  var mphoneNumber = document.getElementById('mphone-number').value;
  var re = /^\d{10}$/;
  // Validate form values
  if (name == "") {
    alert("Enter your name");
    return false;
  }
  if (registerNumber == "") {
    alert("Enter your register number");
    return false;
  }
  if (batch == "") {
    alert("Select your year of joining");
    return false;
  }
  if (department == "") {
    alert("Select your department");
    return false;
  }
  if (section == "") {
    alert("Select your section");
    return false;
  }
  if (roomNumber == "") {
    alert("Enter your room number");
    return false;
  }
  if (leaveType == "") {
    alert("Select your purpose for leave");
    return false;
  }
  if (reason == "") {
    alert("Enter the reason for your leave");
    return false;
  }
  if (startDate == "") {
    alert("Enter the start date");
    return false;
  }
  if (startTime == "") {
    alert("Enter the start time");
    return false;
  }
  if (endDate == "") {
    alert("Enter the end date");
    return false;
  }
  if (endTime == "") {
    alert("Enter the end time");
    return false;
  }
  if (address == "") {
    alert("Enter the address");
    return false;
  }
  if (fphoneNumber == "") {
    alert("Enter your father phone number");
    return false;
  }
  if (!re.test(fphoneNumber)) {
    alert("Enter your valid father phone number");
    return false;
  }
  if (mphoneNumber == "") {
    alert("Enter your mother phone number");
    return false;
  }
  if (!re.test(mphoneNumber)) {
    alert("Enter your valid mother phone number");
    return false;
  }


  // If form is valid, submit form
  return true;
}

    </script>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.16.6/dist/umd/popper.min.js" integrity="sha384-QM6oUf9XU+v6pmCCfW8dYtfGwZcKgv6uG7V8e5p5K7V5JIo/ed7R8lKl+D7ZlLdK" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.min.js" integrity="sha384-w1Q4orYjBQndcko6MimVbzY0tgp4pWB4lZ7lr30WKz0vr/aWKhXdBNmNb5D92v7s" crossorigin="anonymous"></script>
</body>
</html>
