<?php
// Include the database configuration file
require('handlers/dbHandler.php');
require('includes/dependencies.php');



if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $item = getPetByID($id);
} else {
    echo 'Invalid request.';
    exit();
}
    session_start();
    if(!isset($_SESSION['user_id'])){
        header('location:login.php');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Item Details</title>

    <script src="script.js"></script>
    <link rel="stylesheet" href="styles/content.css">
    <link rel="stylesheet" href="styles/animations.css">
</head>

<body>
    <div class="content-for-footer">
    <?php
    require('utils/navigationbarlogin.php');
    ?>
    <div class="container mt-5" style="padding-top: 60px;">
        <div class="row">
            <div class="col-md-4 slide-in">
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
            <div class="col-md-8 slide-in-right">
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
                    <?php if ($item['up_for_adoption']): ?>
                        <button id="cancelAdoptionButton" class="btn btn-danger" style="margin-top: 20px; width:30%;">Cancel Adoption</button>
                    <?php else: ?>
                        <button id="putUpForAdoptionButton" class="btn btn-success" style="margin-top: 20px; width:30%;">Put Up for Adoption</button>
                    <?php endif; ?>
                </div>

            </div>

        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#putUpForAdoptionButton').click(function() {
                $.ajax({
                    url: 'update_adoption_status.php',
                    type: 'POST',
                    data: { pet_id: <?php echo $id; ?>, action: 'put_up_for_adoption' },
                    success: function(response) {
                        if (response == 'success') {
                            alert('Pet was put up for adoption');
                            location.reload();
                        } else {
                            alert('Error putting pet for adoption');
                            location.reload();
                        }
                    }
                });
            });

            $('#cancelAdoptionButton').click(function() {
                $.ajax({
                    url: 'update_adoption_status.php',
                    type: 'POST',
                    data: { pet_id: <?php echo $id; ?>, action: 'cancel_adoption' },
                    success: function(response) {
                        if (response == 'success') {
                            alert("Cancelled adoption");
                            location.reload();
                        } else {
                            alert("Error canceling pet for adoption");
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
    </div>
    <?php
        require('utils/footer.php');
    ?>
</body>

</html>