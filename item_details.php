<?php
// Include the database configuration file
require('includes/dependencies.php');
require('handlers/dbHandler.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $item = getPetByID($id);
} else {
    echo 'Invalid request.';
    exit();
}
    session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Item Details</title>
</head>

<body>
    <?php
    require('utils/navigationbarlogin.php');
    ?>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <?php if ($item['image']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image']); ?>" alt="Item Image" class="card-img-top">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Profile Image" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body text-center">
                        <h5 class="card-title" id="profile-name"><?php echo htmlspecialchars($item['name']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        About Pet
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text" id="profile-about"><?php echo htmlspecialchars($item['description']); ?></p>
                        
                    </div>

                </div>
                <div style="text-align: center;">
                    <a href="pet_list_user.php" class="btn btn-primary" style="margin-top: 20px; width:30%; ">Back</a>
                </div>

            </div>

        </div>
    </div>
</body>

</html>