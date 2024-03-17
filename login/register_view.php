<?php
session_start();
include '../functions/select_role_fxn.php';

// if (isset($_SESSION['role_id']) && $_SESSION['role_id'] !== 1) {
//   echo '<script type="text/javascript">alert("You have been logged out."); window.location.href = "../login/logout_view.php";</script>';
//   exit();
// }



if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $role_id = $_POST['role_id'];
  $email = $_POST['email'];
  $passwd = $_POST['password'];
  $_SESSION['email'] = $email;
  $_SESSION['role_id'] = $role_id;
  $_SESSION['username'] = $username;

  echo "Role ID: " . $role_id;

  // Check if the role is admin or manager
  if ($role_id == 1) {
    // Admin
    $query = "SELECT * FROM Admin WHERE email = '$email'";
  } elseif ($role_id == 2) {
    // Manager
    $query = "SELECT * FROM Manager WHERE email = '$email'";
  }

  if($role_id==3){
    echo 'I am a student';
    // Encrypt password
  $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);
  $_SESSION['hashed_password'] = $hashed_password;

  // Check if the email already exists
  $emailCheckQuery = "SELECT COUNT(*) as count FROM Users WHERE email = '$email'";
  $emailCheckResult = $con->query($emailCheckQuery);
  $emailCheckData = $emailCheckResult->fetch_assoc();

  if ($emailCheckData['count'] > 0) {
    echo "An account with this email already exists.";
  } else {
    // Generate a random 6-digit pin
    $pin = mt_rand(100000, 999999);

    // Prepare the SQL query to insert the pin into the verificationPin table
    $insertPinQuery = "INSERT INTO VerifiablePins (pin, email) VALUES ('$pin', '$email')";
    $_SESSION['pin'] = $pin;

    // Execute the query to insert the pin
    if ($con->query($insertPinQuery) === TRUE) {
      // Send email using EmailJS
      echo '
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
        <script type="text/javascript">
          (function(){
              emailjs.init({
                  publicKey: "oyhKpuE8pEN_nUEBp",
              });
          })();
          function sendEmail() {
              var templateParams = {
                  message: "Your verification pin is: ' . $pin . '",
                  "email": "' . $email . '",
                  "uername": "' . $username . '",
              };
              emailjs.send("service_67r5b8d", "template_v2z8je9", templateParams, "oyhKpuE8pEN_nUEBp")
                  .then(function(response) {
                      console.log("Email sent successfully:", response);
                      // Redirect to the verification_view page
                      window.location.href = "../login/verify_pin_view.php";
                      
                  }, function(error) {
                      console.error("Error sending email:", error);
                  });
          }
          sendEmail(); // Call the sendEmail function immediately
        </script>';
    } else {
      echo "<script type='text/javascript'>console.log('Error: " . $con->error . "');</script>";
      echo "Error: " . $con->error;
    }
    return;
  }
}

  $result = $con->query($query);
  if ($result->num_rows > 0) {
    // Optionally, you may want to commit the changes
    $con->commit();
    // Email exists
    echo "Verification successful!";
    
  // Encrypt password
  $hashed_password = password_hash($passwd, PASSWORD_DEFAULT);
  $_SESSION['hashed_password'] = $hashed_password;

  // Check if the email already exists
  $emailCheckQuery = "SELECT COUNT(*) as count FROM Users WHERE email = '$email'";
  $emailCheckResult = $con->query($emailCheckQuery);
  $emailCheckData = $emailCheckResult->fetch_assoc();

  if ($emailCheckData['count'] > 0) {
    echo "An account with this email already exists.";
  } else {
    // Generate a random 6-digit pin
    $pin = mt_rand(100000, 999999);

    // Prepare the SQL query to insert the pin into the verificationPin table
    $insertPinQuery = "INSERT INTO VerifiablePins (pin, email) VALUES ('$pin', '$email')";
    $_SESSION['pin'] = $pin;

    // Execute the query to insert the pin
    if ($con->query($insertPinQuery) === TRUE) {
      // Send email using EmailJS
      echo '
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/@emailjs/browser@4/dist/email.min.js"></script>
        <script type="text/javascript">
          (function(){
              emailjs.init({
                  publicKey: "oyhKpuE8pEN_nUEBp",
              });
          })();
          function sendEmail() {
              var templateParams = {
                  message: "Your verification pin is: ' . $pin . '",
                  "email": "' . $email . '",
                  "uername": "' . $username . '",
              };
              emailjs.send("service_67r5b8d", "template_v2z8je9", templateParams, "oyhKpuE8pEN_nUEBp")
                  .then(function(response) {
                      console.log("Email sent successfully:", response);
                      // Redirect to the verification_view page
                      window.location.href = "../login/verify_pin_view.php";
                      
                  }, function(error) {
                      console.error("Error sending email:", error);
                  });
          }
          sendEmail(); // Call the sendEmail function immediately
        </script>';
    } else {
      echo "<script type='text/javascript'>console.log('Error: " . $con->error . "');</script>";
      echo "Error: " . $con->error;
    }
  }
  } else {
    // Email does not exist
    echo '<script type="text/javascript">alert("Your info does not exist as an admin/manager.\nPlease contact the System Administrator"); window.location.href = "register_view.php";</script>';
  }



}
$con->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Sign Up</title>
<link rel="stylesheet" href="../css/signup.css">
<!-- Include Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
<script>
  function validateForm(e) {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    var role = document.getElementById("role").value;
    e.preventDefault();
    var usernameRegex = /^[a-zA-Z0-9_ ]{3,20}$/;
    var emailRegex = /^[a-zA-Z0-9._%+-]+@ashesi\.edu\.gh$/;
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&])[A-Za-z\d$@$!%*?&]{8,}$/;
    
    if (!username.match(usernameRegex)) {
      alert("Username must be alphanumeric and between 3 to 20 characters.");
      return false;
    }
    
    if (!email.match(emailRegex)) {
      alert("Email must be in the format example@ashesi.edu.gh");
      return false;
    }
    
    if (!password.match(passwordRegex)) {
      alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 8 characters long.");
      return false;
    }
    
    return true;
  }
  
  function togglePassword() {
    var passwordInput = document.getElementById("password");
    var icon = document.getElementById("password-toggle-icon");
    if (passwordInput.type === "password") {
      passwordInput.type = "text";
      icon.classList.remove("fa-eye-slash");
      icon.classList.add("fa-eye");
    } else {
      passwordInput.type = "password";
      icon.classList.remove("fa-eye");
      icon.classList.add("fa-eye-slash");
    }
  }

  document.getElementById("send_mail").addEventListener("submit", function() {
    document.getElementById("submitBtn").disabled = true;
  });

</script>
</head>
<body>
  <div class="navbar">
    <div class="logo">ASBED</div>
  </div>
  <div class="signup-container">
    <h2>Sign Up</h2>
    <form id='send_mail' action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return validateForm()" required>
      <div class="input-group">
        <label for="username">Username</label>
        <input type="text" id="username" name="username"  required>
      </div>
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" pattern="^[a-zA-Z0-9._%+-]+@ashesi\.edu\.gh$" required>
      </div>
      <div class="input-group">
        <label for="role">Role</label>
        <select id="role" name="role_id" required>
    <?php foreach ($roles as $role): ?>
        <?php if (strtolower($_SESSION['role_id']) == 1): ?>
                <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
        <?php elseif (strtolower($role['role_name']) !== 'admin'): ?>
                <option value="<?php echo $role['role_id']; ?>"><?php echo $role['role_name']; ?></option>
        <?php endif; ?>
    <?php endforeach; ?>
</select>

      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
        <i id="password-toggle-icon" class="fas fa-eye-slash" onclick="togglePassword()"></i>
      </div>
      <button type="submit" name="submit" id="submitBtn">Submit</button>

    </form>
    <hr class="divider">
    <button type="button" class="login-btn"><a href="login_view.php"> I have an account</a></button>
  </div>
</body>
</html>