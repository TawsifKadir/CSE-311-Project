<?php
session_start();
require('handlers/dbHandler.php');
global $petTable,$userTable,$notifications;

if(!isset($_SESSION['user_id'])){
    header('location:login.php');
    exit();
}

$pet_id = $_GET['pet_id'];
$notification_id = $_GET['notification_id'];

$pdo = getPDOConnection();

// Fetch pet details
$pet_query = $pdo->prepare("SELECT $petTable.*, $userTable.username AS owner_name, adopter.username AS adopter_name FROM $petTable 
    JOIN $userTable ON $petTable.owner_id = $userTable.id 
    LEFT JOIN $userTable AS adopter ON $petTable.adopter_id = adopter.id 
    WHERE $petTable.id = ?");
$pet_query->execute([$pet_id]);
$pet = $pet_query->fetch(PDO::FETCH_ASSOC);

if (!$pet) {
    echo 'Pet not found';
}

$owner_id = $pet['owner_id'];
$adopter_id = $pet['adopter_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['confirm'])) {
        // Confirm adoption
        $confirm_adoption_query = $pdo->prepare("UPDATE $petTable SET owner_id = adopter_id, adopter_id = NULL, up_for_adoption = FALSE WHERE id = ?");
        $confirm_adoption_query->execute([$pet_id]);
        
        // Mark notification as read
        $mark_as_read_query = $pdo->prepare("UPDATE $notifications SET read_status = TRUE WHERE id = ?");
        $mark_as_read_query->execute([$notification_id]);
        $delete_notification_query = $pdo->prepare("DELETE FROM $notifications WHERE pet_id = ?");
        $delete_notification_query->execute([$pet_id]);

        header('location:pet_list_user.php');
    } elseif (isset($_POST['decline'])) {
        // Decline adoption
        $decline_adoption_query = $pdo->prepare("UPDATE $petTable SET adopter_id = NULL WHERE id = ?");
        $decline_adoption_query->execute([$pet_id]);
        
        // Mark notification as read
        $mark_as_read_query = $pdo->prepare("UPDATE $notifications SET read_status = TRUE WHERE id = ?");
        $mark_as_read_query->execute([$notification_id]);

        echo "Adoption declined.";
    }
} else {
    // Display confirmation form
    ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Confirm Adoption</title>
    <link rel="stylesheet" href="styles/animations.css">
</head>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Adoption</title>
    <?php
        require('includes/dependencies.php');
    ?>
    <link rel="stylesheet" type="text/css" href="styles/content.css">
    <style>
        .back-button {
            margin-bottom: 20px;
            width: 150px;
        }
        .card-img-top {
            object-fit: cover;
            height: 300px;
            width: 100%;
        }
        .info-section {
            padding-left: 30px;
        }
        .info-section h4 {
            margin-bottom: 20px;
        }
        .info-section .line {
            border-top: 1px solid #ccc;
            margin: 10px 0;
        }
        .buttons {
            margin-top: 20px;
        }
        .buttons .btn {
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="content-for-footer" style="padding-bottom: 20px;">
    <?php
    include('utils/navigationbarlogin.php');
    ?>
    <div class="container mt-5 slide-in" style="padding-top: 70px;">
    <a href="javascript:history.back()" class="btn btn-secondary back-button">
            <i class="fas fa-arrow-left"></i> Back
        </a>
        <div class="row">
            <div class="col-md-4 slide-in">
                <div class="card">
                    <?php if ($pet['image']) : ?>
                        <img src="data:image/jpeg;base64,<?php echo base64_encode($pet['image']); ?>" alt="Profile Image" class="card-img-top">
                    <?php else : ?>
                        <img src="images/placeholder.jpg" alt="Profile Image" class="card-img-top">
                    <?php endif; ?>
                    <div class="card-body text-center">
                        <h5 class="card-title" id="profile-name"><?php echo htmlspecialchars($pet['name']); ?></h5>
                    </div>
                </div>
            </div>
            <div class="col-md-8 slide-in-right">
                <div class="card">
                    <div class="card-header">
                        Pet Information
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text" id="profile-about"><?php echo htmlspecialchars($pet['description']); ?></p>
                        <h5 class="card-title">Additional Information</h5>
                        <p class="card-text">
                            <strong>Requester:</strong> <?php echo htmlspecialchars($pet['adopter_name']); ?></span><br>
                        </p>
                        <div class="buttons">
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="confirm" class="btn btn-success">Confirm</button>
                        </form>
                        <form method="POST" style="display:inline;">
                            <button type="submit" name="decline" class="btn btn-danger">Decline</button>
                        </form>
                        <a href="usercontact.php?id=<?php echo htmlspecialchars($adopter_id); ?>" class="btn btn-primary">See profile</a>
                    </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    
        <?php
            require('utils/footer.php');
        ?>
    
</body>
</html>
    <?php
}
?>
