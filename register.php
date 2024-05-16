<!DOCTYPE html>
<html>
    <head>
        <title> pet agency </title>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php
    require('includes/dependencies.php');
  ?>
  </head>

<body>

<?php
  include('utils/navigationbar.php')
?>

<div>
<input class="form-control" type="text" placeholder=" Provide your information to register ...." readonly>
</div>
<section class="my-5">
<div class= "py-5">
  <h1 class = text-center > Application Form</h1>
</div>
<div class = "w-50 m-auto">
    <form action="userinfo.php" method="POST">
        <div class = "form-group">
            <level> Username</level>
            <input type="text" name="name" autocomplete="off" class="form-control">

</div>
<div class = "form-group">
            <level> Email</level>
            <input type="text" name="email" autocomplete="off" class="form-control">

</div>
<div class = "form-group">
            <level> Phone number</level>
            <input type="text" name="mobile" autocomplete="off" class="form-control">

</div>
<div class = "form-group">
            <level> Address</level>
            <input type="text" name="address" autocomplete="off" class="form-control">

</div>
<div class = "form-group">
            <level> City</level>
            <input type="text" name="city" autocomplete="off" class="form-control">

</div>
<div class="form-group">
<label for="breed">Species</label>
<div>
<label for="Dog" class="radio-inline" ><input type="radio" name="species" value="Dog" id="Dog" />Dog
</label>
<label for="Cat" class="radio-inline"><input type="radio" name="species" value="Cat" id ="Cat" />Cat
</label>
</div>           
                  
                  
                  
                  
<div class ="py-5">
<button type="submit" class="btn btn-primary">Register</button>
</div>
</form>
</section>
<div class ="py-5">
<footer>
    <p class="p-3 bg-dark text-white text-center"> fk@gamil.com</p>
</footer>
</div>