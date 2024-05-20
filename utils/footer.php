<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        footer {
            background-color: #343a40;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
        }
        .footer-left, .footer-middle, .footer-right {
            display: flex;
            align-items: center;
        }
        .footer-left {
            flex: 1;
            justify-content: flex-start;
            gap: 20px;
        }
        .footer-middle {
            flex: 1;
            justify-content: center;
        }
        .footer-right {
            flex: 1;
            justify-content: flex-end;
            gap: 15px;
        }
        .footer-right a {
            color: #fff;
        }
        .footer-divider {
            height: 20px;
            width: 1px;
            background-color: #fff;
        }
        @media (max-width: 768px) {
            .footer-left, .footer-middle, .footer-right {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
        }
        @keyframes grow {
            from {
                transform: scale(1);
            }
            to {
                transform: scale(1.2);
            }
        }

        .grow:hover {
            animation: grow 0.2s forwards;
        }
    </style>
</head>
<body>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 footer-left">
                    <div>Farjana Akhi</div>
                    <div class="footer-divider"></div>
                    <div>Tawsif Abdul Kadir</div>
                    <div class="footer-divider"></div>
                    <div>Adriya Keya</div>
                </div>
                <div class="col-12 col-md-4 footer-middle">
                    <div>FA Pet Agency</div>
                </div>
                <div class="col-12 col-md-4 footer-right">
                    <a href="https://www.facebook.com/tawsif.abdulkadir"><i class="fab fa-facebook grow"></i></a>
                    <a href="#"><i class="fab fa-instagram grow"></i></a>
                    <a href="https://x.com/tawsif_kadir18"><i class="fab fa-twitter grow"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>

</body>
</html>