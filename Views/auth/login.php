<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <title>login</title>
</head>
<body>
    
<form method='post' action='../../App/Controllers/AuthController.php'>
  <!-- Email input -->
  <div class="form-outline mb-4">
    <input type="email" id="form2Example1"  name='email' class="form-control" />
    <label class="form-label" for="form2Example1">Email address</label>
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
    <input type="password" id="form2Example2"  name='password' class="form-control" />
    <label class="form-label" for="form2Example2">Password</label>
  </div>
   <div>
   <span class='text-danger'><?= isset($_SESSION['error']) ? $_SESSION['error']  : '' ; $_SESSION['eroor'] = ''; ?></span>
   </div>
  

  <!-- Submit button -->
  <button name='login' class="btn btn-primary btn-block mb-4">Sign in</button>

  <!-- Register buttons -->
  <div class="text-center">
    <p>Not a member? <a href="register.php">Register</a></p>
    
  </div>
</form>
</body>
</html>
