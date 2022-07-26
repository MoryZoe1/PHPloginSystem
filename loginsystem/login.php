<?php

include 'partials/dbconnect.php';
$showAlert = false;
$showerror = false;
$userexist = false;
$login = false;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
  
    $user = $_POST['username'];
    $password = $_POST['password'];



    // $sql = "SELECT * FROM `users` WHERE username = '$user' AND password = '$password'";
    $sql = "SELECT * FROM `users` WHERE username = '$user'";
  
    $result = mysqli_query($conn,$sql);
    $num =  mysqli_num_rows($result);

    if ($num == 1) {
while ($row=mysqli_fetch_assoc($result)) {
if (password_verify($password,$row['password'])) {
  $login = true;
  session_start();
  $_SESSION['loggedin'] = true;
  $_SESSION['username'] = $user;
   header("location: welcome.php"); 
}  
else {
  $showAlert = "Invalid Credentials";
}


}
    }
else {
  $showAlert = "Invalid Credentials";
}





}
?>



<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
  </head>
  <body>
    <?php
require 'partials/_nav.php';


if ($login) {
    echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>Success</strong> You are loggedin
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}

if ($showAlert) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> ' . $showAlert . '
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



if ($userexist) {
    echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Error!</strong> Sorry please chooses another user name because user exists of that username
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
}



?>

<div class="container my-4">
<h1 class="text-center">Login for website</h1>
<form action="/loginsystem/login.php"  method="post">
  <div class="mb-3">
    <label for="username" class="form-label">Username</label>
    <input type="text" class="form-control" id="username" aria-describedby="emailHelp" name="username">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>

  <button type="submit" class="btn btn-primary">Signup</button>
</form>
</div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
  </body>
</html>
