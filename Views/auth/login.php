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
    <link rel="stylesheet" href="../../Public/css/login.css">
    <title>login</title>
</head>
<body>


<div class="container">
    <h2 class="login-title">Log in</h2>
    <form class="login-form" method='post' action='../../App/Controllers/AuthController.php'>
  <!-- Email input -->
  <div class="form-outline mb-4">
        <label class="form-label" for="email">Email </label>
    <input type="email" id="email" name='email' class="form-control" />
  </div>

  <!-- Password input -->
  <div class="form-outline mb-4">
        <label class="form-label" for="password">Password</label>
    <input type="password" id="password"  name='password' class="form-control" />
  </div>
   <div>
   <span class='text-danger'><?= isset($_SESSION['error']) ? $_SESSION['error']  : '' ; $_SESSION['eroor'] = ''; ?></span>
   </div>

      <button name='login' class="btn btn--form">log in</button>

      <div>
        <p>Not a member <a href="../auth/register.php">Register</a></p>
      </div>
    </form>
</div>
</body>
</html>
