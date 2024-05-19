<?php
// Include the database configuration file
require('includes/dependencies.php');
require('handlers/dbHandler.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $item = getPetByID($id);
    if($item != null){
        $user = getUserByID($item['owner_id']);
    }
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
    <div class="container mt-5" style="padding-top: 70px;">
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
                        <h5 class="card-title">Owner Information</h5>
                        <p class="card-text">
                            <strong>Name:</strong> <span id="profile-name"><?php echo htmlspecialchars($user['name']); ?></span><br>
                            <strong>Phone:</strong> <span id="profile-phone"><?php echo htmlspecialchars($user['phone_no']); ?></span><br>
                            <strong>Address:</strong> <span id="profile-address"><?php echo htmlspecialchars($user['address']); ?></span><br>
                            <strong>Email:</strong> <span id="profile-email"><?php echo htmlspecialchars($user['email']); ?></span><br>
                        </p>
                    </div>

                </div>
                <div style="text-align: center;">
                    <a href="pet_list.php" class="btn btn-primary" style="margin-top: 20px; width:30%; ">Back</a>
                    <a href="#" class="btn btn-secondary" style="margin-top: 20px; width:30%; ">Ask to adopt</a>
                    <a href="usercontact.php?id=<?php echo $user['id']; ?>" class="btn btn-success" style="margin-top: 20px; width:30%; ">Contact</a>
                </div>

            </div>

        </div>
    </div>
</body>

</html>