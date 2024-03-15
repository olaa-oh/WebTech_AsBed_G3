<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login</title>
<link rel="stylesheet" href="../css/login.css">
<script>
  function validateForm() {
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;
    
    var emailRegex = /^[^\s@]+@ashesi\.edu\.gh$|^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    var passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/;
    
    if (!email.match(emailRegex)) {
      alert("Email must be in a valid format.");
      return false;
    }
    
    if (!password.match(passwordRegex)) {
      alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, and be at least 8 characters long.");
      return false;
    }
  
    window.location.href = "..view/student_portal.php";
    //return true;
    
  }
</script>
</head>
<body>
  <div class="navbar">
    <div class="logo"><a href="../view/landing.php">ASBED</a></div>
  </div>
  <div class="login-container">
    <h2>Login</h2>
    <!-- <form action="#" method="post" onsubmit="validateForm()">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit"><a href="../view/student_portal.php"></a>Login</button>
      <div class="bottom-links">
        <a href="#" class="forgot-password">Forgot Password</a>
      </div>
    </form> -->

    <form action="#" method="post" onsubmit="goToStudentPortal()">
      <div class="input-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" required>
      </div>
      <div class="input-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>
      <button type="submit"><a href="../view/student_portal.php"></a>Login</button>
      <div class="bottom-links">
        <a href="#" class="forgot-password">Forgot Password</a>
      </div>
    </form>
    <hr class="divider">
    <button type="button" class="register-btn">Register</button>
  </div>

  <script>
    function goToStudentPortal() {
      window.location.href = "../view/student_portal.php";
    }
  </script>

  
</body>
</html>
