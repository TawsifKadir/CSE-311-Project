<!DOCTYPE html>
<html>
    <head>
        <title> pet agency </title>
        <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100..700;1,100..700&family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap" rel="stylesheet">
  </head>

<body>
  
<nav class="navbar navbar-expand-md navbar-dark bg-dark">
 <a class="navbar-brand" href="#"></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
  <li class="nav-item active">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">About Us</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="pet.php">Our Pets</a>
      </li>
    <ul class="navbar-nav ml-auto">
      
    
      <li class="nav-item">
        <a class="nav-link" href="register.php">Register</a>
      </li>
      
</nav>
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