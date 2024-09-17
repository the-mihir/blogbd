<?php
  session_start();
?>

<!doctype html>
<html lang="en">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

  <title>Login Page</title>
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa;
    }
    .login-container {
      width: 100%;
      max-width: 400px;
      padding: 15px;
      background-color: white;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
    }
    .btn-primary {
      background: #434343 !important;
      color: #fff !important;
      border: none !important;
    }
    .black-text {
      color: #434343 !important;
    }
  </style>
</head>
<body>

  <div class="login-container">
    <?php if (isset($_SESSION['status'])): ?>
      <div class="alert alert-warning alert-dismissible fade show" role="alert" aria-live="assertive" aria-atomic="true">
        <?php echo $_SESSION['status']; ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <?php unset($_SESSION['status']); ?>
    <?php endif; ?>

    <h2 class="text-center mb-4">Login Form</h2>
    <form action="login_process.php" method="post">

     
      <div class="form-group">
        <label for="userEmail">Email Address</label>
        <input type="email" class="form-control" name="email" id="userEmail" placeholder="Enter Email Address" required aria-describedby="emailHelp">
        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Login</button>
      <div class="text-center mt-3">
        <a href="#" class="black-text">Forgot password?</a>
        <p>Don't have an account? <a href="register.php">Register</a></p>
      </div>
    </form>
    <hr>
    <p>Didn't receive your verification email? <a href="#">Resend</a></p>
  </div>

  <!-- jQuery and Bootstrap Bundle (includes Popper) -->
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</body>
</html>
