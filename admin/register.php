<?php

  include_once '../classes/Register.php';

  $register = new Register();

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $addUser = $register->addUser($_POST);

  }
  
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Register Page</title>
    <style>
 
      .register-container {
        margin-top: 150px;
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
      <div class="d-flex justify-content-center align-items-center ">
    <div class="register-container">
    <span>
        <?php
        if (isset($addUser)) {
        
            ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <?php echo $addUser; ?> 
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php
        }
        ?>
    </span>
        <h2 class="text-center mb-4">Registration Form</h2>
      <form action="" method="POST">
        <div class="form-group">
          <label for="fullName">Full Name</label>
          <input type="text" class="form-control" name="fullName" id="fullName" placeholder="Enter full name" required>
        </div>
        <div class="form-group">
          <label for="email">Email Address</label>
          <input type="email" class="form-control" name="email" id="email" placeholder="Enter email" required>
        </div>
       
        <div class="form-group">
          <label for="mobileNumber">Mobile Number</label>
          <input type="tel" class="form-control" name="mobileNumber" id="mobileNumber" placeholder="Enter mobile number" required>
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" id="password" placeholder="Enter password" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Register</button>
        <div class="text-center mt-3">
          <p>Already have an account? <a href="login.php" class="black-text">Login</a></p>
        </div>
      </form>
    </div>

    </div>

    <!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>
