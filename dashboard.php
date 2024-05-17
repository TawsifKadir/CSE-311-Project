<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pet agency</title>
    <?php
        require('includes/dependencies.php');
    ?>
</head>
<body>
    <?php
        include('utils/navigationbarlogin.php');
    ?>

    <div class="container mt-5">
        <h1>News</h1>
        <div class="row" id="item-list">
            <?php
                $items = [
                    ['title' => 'Item 1', 'image' => 'path/to/image1.jpg', 'description' => 'Description for item 1', 'url' => '#'],
                    ['title' => 'Item 2', 'image' => 'path/to/image2.jpg', 'description' => 'Description for item 2', 'url' => '#'],
                    ['title' => 'Item 3', 'image' => 'path/to/image3.jpg', 'description' => 'Description for item 3', 'url' => '#'],
                ];
            
                foreach ($items as $item) {
                    echo '<div class="col-md-4">';
                    echo '  <div class="card mb-4">';
                    echo '    <a href="' . $item['url'] . '">';
                    echo '      <img src="' . $item['image'] . '" class="card-img-top" alt="' . $item['title'] . '">';
                    echo '      <div class="card-body">';
                    echo '        <h5 class="card-title">' . $item['title'] . '</h5>';
                    echo '        <p class="card-text">' . $item['description'] . '</p>';
                    echo '      </div>';
                    echo '    </a>';
                    echo '  </div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

    <div class="container mt-5">
        <h1>Articles</h1>
        <div class="row" id="item-list">
            <?php
                $items = [
                    ['title' => 'Item 1', 'image' => 'path/to/image1.jpg', 'description' => 'Description for item 1', 'url' => '#'],
                    ['title' => 'Item 2', 'image' => 'path/to/image2.jpg', 'description' => 'Description for item 2', 'url' => '#'],
                    ['title' => 'Item 3', 'image' => 'path/to/image3.jpg', 'description' => 'Description for item 3', 'url' => '#'],
                ];
            
                foreach ($items as $item) {
                    echo '<div class="col-md-4">';
                    echo '  <div class="card mb-4">';
                    echo '    <a href="' . $item['url'] . '">';
                    echo '      <img src="' . $item['image'] . '" class="card-img-top" alt="' . $item['title'] . '">';
                    echo '      <div class="card-body">';
                    echo '        <h5 class="card-title">' . $item['title'] . '</h5>';
                    echo '        <p class="card-text">' . $item['description'] . '</p>';
                    echo '      </div>';
                    echo '    </a>';
                    echo '  </div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

    <div class="container mt-5">
        <h1>Blogs</h1>
        <div class="row" id="item-list">
            <?php
                $items = [
                    ['title' => 'Item 1', 'image' => 'path/to/image1.jpg', 'description' => 'Description for item 1', 'url' => '#'],
                    ['title' => 'Item 2', 'image' => 'path/to/image2.jpg', 'description' => 'Description for item 2', 'url' => '#'],
                    ['title' => 'Item 3', 'image' => 'path/to/image3.jpg', 'description' => 'Description for item 3', 'url' => '#'],
                ];
            
                foreach ($items as $item) {
                    echo '<div class="col-md-4">';
                    echo '  <div class="card mb-4">';
                    echo '    <a href="' . $item['url'] . '">';
                    echo '      <img src="' . $item['image'] . '" class="card-img-top" alt="' . $item['title'] . '">';
                    echo '      <div class="card-body">';
                    echo '        <h5 class="card-title">' . $item['title'] . '</h5>';
                    echo '        <p class="card-text">' . $item['description'] . '</p>';
                    echo '      </div>';
                    echo '    </a>';
                    echo '  </div>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>
    

</body>
</html>