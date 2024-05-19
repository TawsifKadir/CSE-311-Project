<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <?php
            session_start();
            require('includes/dependencies.php');
            require('handlers/dbHandler.php');
            if(isset($_SESSION['user_id'])){
                $items = getAllPetsOfUser($_SESSION['user_id']);
            }else{
                header('location: login.php');
                exit();
            }
            
        ?>
        <link rel="stylesheet" href="styles/list_item.css">

    </head>

    <body>
        <?php
            require('utils/navigationbarlogin.php');
        ?>
        
        <div class="container mt-5 mb-5" style="padding-top: 70px;">
            <h1 class="mb-5">Your Pets</h1>
            <?php if (!empty($items)) : ?>
                <div class="row">
                    <?php foreach ($items as $item) : ?>
                        <div class="col-md-4">
                            <a href="item_details.php?id=<?php echo $item['id']; ?>" class="item-link">
                                <div class="card item-card">
                                    <?php if ($item['image']) : ?>
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($item['image']); ?>" alt="Item Image" class="card-img-top item-image">
                                    <?php else : ?>
                                        <img src="default_image.png" alt="Default Image" class="card-img-top item-image">
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($item['name']); ?></h5>
                                        <p class="card-text"><?php echo htmlspecialchars($item['description']); ?></p>
                                    </div>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <p>No items found.</p>
            <?php endif; ?>
        </div>
    </body>

</html>