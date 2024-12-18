<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Register.css">
    <title>User Registration</title>
  </head>
<body>
  <div class="wrapper">
    <h2>Registration</h2>
    <form action="RegisterAccount.php" method="POST">
      <!-- Input for Name -->
      <div class="input-box">
        <input type="text" name="name" placeholder="Enter your name" required>
      </div>
      <!-- Input for Email -->
      <div class="input-box">
        <input type="email" name="email" placeholder="Enter your email" required>
      </div>
      <!-- Input for Password -->
      <div class="input-box">
        <input type="password" name="password" placeholder="Create password" required>
      </div>
      <!-- Input for Confirm Password -->
      <div class="input-box">
        <input type="password" name="confirm_password" placeholder="Confirm password" required>
      </div>
      <!-- Terms and Conditions -->
      <div class="policy">
        <input type="checkbox" name="terms" required>
        <h3>I accept all terms & conditions</h3>
      </div>
      <!-- Submit Button -->
      <div class="input-box button">
        <input type="submit" value="Register Now">
      </div>
      <!-- Link to Login -->
      <div class="text">
        <h3>Already have an account? <a href="Sign-in.php">Login now</a></h3>
      </div>
    </form>
  </div>
</body>
</html>
