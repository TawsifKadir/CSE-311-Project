<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>pet agency</title>
    <link rel="stylesheet" href="styles/content.css">
    <link rel="stylesheet" href="styles/animations.css">
    <?php
        session_start();
        if(!isset($_SESSION['user_id'])){
            header('location:login.php');
            exit();
        }
        require('handlers/dbHandler.php');

        $user = getUserByID($_SESSION['user_id']);

        require('includes/dependencies.php');
    ?>
    <style>
        .facts-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
            margin-top: 20px;
        }
        .fact {
            background-color: #96d2d4;
            text-size-adjust: 30px;
            padding: 15px;
            border-radius: 5px;
            font-size: 25px;
            font-family:'Times New Roman', Times, serif;
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
            height: 320px; /* Adjust height as needed */
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        .container-box {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin-bottom: 20px;
        }
        .box {
            background-color: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            flex: 1 1 calc(33.333% - 20px);
            box-sizing: border-box;
            height: 250px; /* Adjust height as needed */
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
        }
        @media (max-width: 768px) {
            .box {
                flex: 1 1 calc(50% - 20px);
            }
        }
        @media (max-width: 576px) {
            .box {
                flex: 1 1 100%;
            }
        }
        .box img {
            width: 100px;
            height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }
        .box .content {
            margin-top: 10px;
            width: 100%;
        }
        .box .content p {
            font-size: 14px; /* Adjust font size as needed */
            margin: 5px 0;
        }
        .news-article, .blog-post {
            margin-bottom: 20px;
        }
        .news-article img, .blog-post img {
            max-width: 100%;
            height: auto;
        }
    </style>
</head>
<body>
    <?php
        include('utils/navigationbarlogin.php');
    ?>

    <div class="content-for-footer">
    <div class="container mt-5" style="padding-top: 70px;">
        
        <h1 class="mb-5 fade-in">Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?></h1>
        
        <h2 class="mb-5 fade-in">Did you know</h2>
        <div id="facts" class="facts-container slide-in"></div>
        <h2 class="mb-5 fade-in">Dog breeds</h2>
        <div id="dogs" class="container-box slide-in"></div>
        <h2 class="mb-5 fade-in">Cat breeds</h2>
        <div id="cats" class="container-box slide-in"></div>
    </div>
    </div>
    <script>
        $(document).ready(function() {

            let dogLength = 3;
            let catLength = 3;

            fetchFacts();
            fetchFacts();
            fetchCatFact();

            for(let i=0; i<dogLength; i++){
                fetchDogInfo();
            }

            for(let j=0; j<catLength; j++){
                fetCatInto();
            }
            // Fetch blog posts

            function fetchFacts() {
                $.ajax({
                    url: 'https://dogapi.dog/api/v2/facts',
                    type: 'GET',
                    data: {
                        limit: 1
                    },
                    success: function(response) {
                        const facts = response.data;
                        facts.forEach(fact => {
                            const wordCount = fact.attributes.body.split(' ').length;
                            if(wordCount > 40){
                                fetchFacts();
                            }else{
                                const factElement = `
                                <div class="fact">
                                    <p>${fact.attributes.body}</p>
                                </div>
                            `;
                            $('#facts').append(factElement);
                            } 
                        });
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching facts:', error);
                        $('#facts').append('<p>Error fetching facts.</p>');
                    }
                });
            }

            function fetchCatFact(){
                $.ajax({
                    url: 'https://catfact.ninja/fact',
                    type: 'GET',
                    success: function(response) {
                        const wordCount = response.fact.split(' ').length;
                        if(wordCount > 40){
                            fetchCatFact();
                        }else{
                            console.log(response);
                            const factElement = `
                                <div class="fact">
                                    <p>${response.fact}</p>
                                </div>
                            `;
                            $('#facts').append(factElement);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching facts:', error);
                        $('#facts').append('<p>Error fetching facts.</p>');
                    }
                });
            }

            function fetchDogInfo() {
                $.ajax({
                    url: 'https://api.thedogapi.com/v1/images/search?api_key=live_nO3BYutr9QtwapNmqEzw4H1ThGdEi5MB4mscUUlQ4wi1T0YGuq7s21z4zpk8160Y&has_breeds=1&size=full',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        const image = response[0].url;
                        const breeds = response[0].breeds[0];
                        const name = breeds.name;
                        const text = breeds.temperament + ". Bred for " + breeds.bred_for;
                        console.log(text);
                        showImageBox(image,name,text,'#dogs');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching dog info:', error);
                        $('#dogs').append('<p>Error fetching blog posts.</p>');
                    }
                });
            }

            function fetCatInto(){
                $.ajax({
                    url: 'https://api.thecatapi.com/v1/images/search?api_key=live_qVDTKoMPSP6vDgWNfHEWOj9X1g3UGnHj0cVnEMqT2MQgUUyoBRbXnxcAoRBNfjfb&has_breeds=1&size=full',
                    type: 'GET',
                    success: function(response) {
                        console.log(response);
                        const image = response[0].url;
                        const breeds = response[0].breeds[0];
                        const name = breeds.name;
                        const text = breeds.temperament;
                        console.log(text);
                        showImageBox(image,name,text,'#cats');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching dog info:', error);
                        $('#dogs').append('<p>Error fetching blog posts.</p>');
                    }
                });
            }

            function showImageBox(imageUrl, name, desc, tag) {
                const imageBox = `
                    <div class="box">
                        <img src="${imageUrl}" alt="Image">
                        <div class="content">
                            <hr>
                            <h3>${name}</h3>
                            <p>${desc}</p>
                        </div>
                    </div>
                `;
                $(tag).append(imageBox); // Change to another container if necessary
            }

        });
    </script>   
    <?php
        require('utils/footer.php');
    ?>
</body>
</html>