<?php
// Include the database configuration file
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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="script.js"></script></head>

<body>
    <?php
    require('utils/navigationbarlogin.php');
    ?>
    <div class="container mt-5" style="padding-top: 60px;">
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
                            location.reload();
                        } else {
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
                            location.reload();
                        } else {
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>
</body>

</html>