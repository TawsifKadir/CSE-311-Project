<!DOCTYPE html>
<html>

<head>
  <title> pet agency </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <?php 
    session_start();
    require('includes/dependencies.php');
    if(!isset($_SESSION['user_id'])){
      header('location:login.php');
      exit();
    }
  ?>
  <link rel="stylesheet" href="styles/placeholder.css">
  <link rel="stylesheet" href="styles/content.css">
  <link rel="stylesheet" href="styles/animations.css">
</head>

<body>

  <div class="content-for-footer">
  <?php
  include('utils/navigationbarlogin.php')
  ?>

  <section class="my-5">
    <div class="py-5">
      <h1 class="text-center fade-in"> Post your pet</h1>
    </div>
    <div class="w-50 m-auto">
      <form action="petInsertHandler.php" method="POST" enctype="multipart/form-data">

        <div class="row justify-content-center align-items-center min-vh-100">
          <div class="col-md-4 text-center shrink-image">
            <div id="placeholder" class="rounded-circle">
              <img src="images/placeholder.jpg" alt="Click to upload" id="placeholderImage" class="rounded-circle">
            </div>
            <input type="file" name="imageInput" id="imageInput" accept="image/*" class="form-control-file" required>
          </div>
        </div>

        <div class="form-group">
          <level> Full Name</level>
          <input type="text" name="name" autocomplete="off" class="form-control">

        </div>
        
        <div class="form-group">
          <label for="profileTextarea">Profile Description</label>
          <textarea class="form-control" id="profileTextarea" name = "description" rows="10" placeholder="Enter your pet's description"></textarea>
        </div>

        <div class="py-5">
          <button type="submit" class="btn btn-primary">Post Pet</button>
        </div>
      </form>
  </section>
  
  <script>
    document.getElementById('placeholder').addEventListener('click', function() {
      document.getElementById('imageInput').click();
    });

    document.getElementById('imageInput').addEventListener('change', function(event) {
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          document.getElementById('placeholderImage').src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    });
  </script>
  </div>
  <?php
        require('utils/footer.php');
    ?>

</body>

</html>