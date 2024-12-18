<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="Sign-in.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body>
  <div class="wrapper">
    <header>Login Form</header>
    <form action="LoginAccount.php" method="POST">
      <div class="field email">
        <div class="input-area">
          <input type="text" name="email" placeholder="Email Address" required>
          <i class="icon fas fa-envelope"></i>
        </div>
      </div>
      <div class="field password">
        <div class="input-area">
          <input type="password" name="password" placeholder="Password" required>
          <i class="icon fas fa-lock"></i>
        </div>
      </div>
      <div class="pass-txt"><a href="#">Forgot password?</a></div>
      <input type="submit" value="Login">
    </form>
    <div class="sign-txt">Not yet member? <a href="Register.php">Signup now</a></div>
  </div>
</body>
</html>
