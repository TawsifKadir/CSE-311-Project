<!DOCTYPE html>
<html>
<head>
    <title>pet agency</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php
        require('includes/dependencies.php');
    ?>
    <link rel="stylesheet" href = "styles/carousel.css">
    
</head>

<body>

    <?php
        include('utils/navigationbar.php');
    ?>

    <div>
        <div class="jumbotron jumbotron-fluid">
            <div class = "carousel-container">
                <div class="container">
                    <h1  class ="text-center" class="display-1"> WELCOME </h1>
                    <p class="lead"> YOU HAVE THE OPPORTUNITY TO GIVE A LOVING PET A
                                NEW HOME & SHOW THEM THE LOVE THEY DESERVE </p> 

                    <div id="carouselExampleIndicators" class="carousel slide parent" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner child">
            
                            <div class="carousel-item active">
                                <img class="d-block w-100" src="images/pic1.jpeg" alt="First slide">
                            </div>

                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/pic2.jpeg" alt="Second slide">
                            </div>
    
                            <div class="carousel-item">
                                <img class="d-block w-100" src="images/pic3.jpg" alt="Third slide">
                            </div>
                        </div>

                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>

                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>

                    </div>

                 
                    <div class="carousel-captions">
                        <div class="caption active" id="caption1">
                            <h3>ADOPT A PET AND GAIN A FRIEND FOR LIFE!</h3>
                            <p>We are here to help you to find a adorable pet</p>
                        </div>

                        <div class="caption d-none" id="caption2">
                            <h3>FIND A FOREVER FRIEND</h3>
                            <p>We are here to ensure you the most suitable pet</p>
                        </div>

                        <div class="caption d-none" id="caption3">
                            <h3>WE CAN GIVE YOUR PET A NEW HOME</h3>
                            <p>You can have confidence that you have chosen the right animal shelter</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
            
    <section class="my-5">
        <div class="py-5">
            <h3 class=text-center>About Us</h3>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-12">
                    <img src="images/pic7.jpg" class=img-fluid>
                </div>

                <div class="col-lg-6 col-md-6 col-12">
                    <h1>FA PET AGENCY</h1>
                    <p>This Pet Agency of our creative teams offer unique and impactful operations, adapted to YOUR objectives (notoriety, image, commitment, traffic, recruitment, content creation, conversion…).</p>
                    <a href="about.php" class=btn btn-success>check more</a>
                </div>
            </div>
        </div>
    </section>

    <section class="my-5">
        <div class=py-5>
            <h3 class=text-center></h3>
        </div>
        <div class=container-fluid>
            <div class=row>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="images/pic4.jpeg" class=img-fluid>
                            <h5 class=card-title>Kitten Adoption</h5>
                            <p class=card-text>Make people happy, gain customers, engage your communities</p>
                            <a href="register.php" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="images/pic5.jpeg" class=img-fluid>
                            <h5 class=card-title>Cat Adoption</h5>
                            <p class=card-text>The interaction with animals allows the secretion of oxytocin, the hormone of happiness.</p>
                            <a href="register.php" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-4 col-12">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <img src="images/pic6.jpeg" class=img-fluid>
                            <h5 class=card-title>Dog adoption</h5>
                            <p class=card-text>Building trust leads to purchasing decisions. Today’s communities are your customers of tomorrow…</p>
                            <a href="register.php" class="btn btn-primary">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="py-5">
            <p class="p-3 bg-dark text-white text-center">fk@gmail.com</p>
        </div>
    </footer>


    <script>
        $('#carouselExampleIndicators').on('slide.bs.carousel', function (e) {
        var index = $(e.relatedTarget).index();
        $('.caption').removeClass('active');
        $('#caption' + (index + 1)).removeClass('d-none');
        $('#caption' + (index + 1)).addClass('active');
        });
    </script>
</body>
</html>

