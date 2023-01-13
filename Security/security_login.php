<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <style>
    .form-container {
      border: 1px solid #ccc;
      box-shadow: 5px 10px 18px #888888;
      border-radius: 5px;
      margin-top: 20px;
      margin-bottom: 20px;
      padding: 30px;
    }
    #error-message {
    color: red;
    font-size: 14px;
}

  </style>
</head>
<body>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="form-container">
          <h2>REC Hostel Portal Login</h2>
          <form action="login.php" onsubmit="return validateForm()" method="post">
          <div id="error-message"></div>
          <div class="form-group">
          <label for="user_type">Login as</label>
          <select class="form-control" id="user_type" name="user_type"> 
            <option value="Security">Security</option>
          </select>

        </div>
            <div class="form-group">
              <label for="student_id">Username:</label>
              <input type="text" class="form-control" id="username" placeholder="Enter username" name="username">
            </div>
            <div class="form-group">
              <label for="password">Password:</label>
              <input type="password" class="form-control" id="password" placeholder="Enter password" name="password">
            </div>
            <button type="submit" name="submit"  class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</body>
<script>
function validateForm() {
  // Get the value of the username field
  var username = document.getElementById("username").value;

  // Get the value of the password field
  var password = document.getElementById("password").value;

  // Validate that the username and password are not empty
  if (username == "" && password == "") {
    document.getElementById("error-message").innerHTML = "Please enter your username and password";
    return false;
  }
  if (username == "") {
    document.getElementById("error-message").innerHTML = "Please enter your username";
    return false;
  }
  if (password == "") {
    document.getElementById("error-message").innerHTML = "Please enter your password";
    return false;
  }
  return true;
}
</script>
</html>