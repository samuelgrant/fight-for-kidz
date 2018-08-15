<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Fight For Kidz 2018</title>

    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template -->
    <link href="https://fonts.googleapis.com/css?family=Varela+Round" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template -->
    
    <link href="css/custom.css" rel="stylesheet">
    <link href="css/auction-hover.css" rel="stylesheet">
    <link href="css/grayscale.css" rel="stylesheet">

</head>

<body class="ring-bg">

@include('nav')

    <div class="container my-5 px-5">

        <div class="heading-container push-down pt-5">
            <h1 class="text-white text-center">Auction Items - 2018</h1>
            <h5 class="text-white text-center">Click each image for more info</h5>
        </div>

        <section id="auction_items" class="auction-section">

            <div class="row">

                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" id="myImg" src="img/Phoenix_shirt.jpg" alt="Phoenix Shirt" />

                    <div class="item-details">
                        <h5 class="item-name">Phoenix Shirt</h5>
                        <p class="item-desc">Signed by all of the team.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                    <div id="myModal" class="modal">
                        <span id="close">&times;</span>
                        <img class="modal-content" id="img01" />
                        <div id="caption"></div>
                    </div>
                </div>
                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" id="myImg" src="img/warriors.jpg" />
                    <div class="item-details">
                        <h5 class="item-name">Warriors Shirt</h5>
                        <p class="item-desc">Signed by all of the team.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                    <div id="myModal" class="modal">
                        <span id="close">&times;</span>
                        <img class="modal-content" id="img01" />
                        <div id="caption"></div>
                    </div>
                </div>
                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/ali_glove.jpg" />
                    <div class="item-details">
                        <h5 class="item-name">Ali's Glove</h5>
                        <p class="item-desc">Signed by the man himself.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/Phoenix_shirt.jpg" />

                    <div class="item-details">
                        <h5 class="item-name">Phoenix Shirt</h5>
                        <p class="item-desc">Signed by all of the team.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/ali_glove.jpg" />
                    <div class="item-details">
                        <h5 class="item-name">Ali's Glove</h5>
                        <p class="item-desc">Signed by the man himself.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/warriors.jpg" />
                    <div class="item-details">
                        <h5 class="item-name">Warriors Shirt</h5>
                        <p class="item-desc">Signed by all of the team.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
            </div>

        </section>

        <div id="merchandise">
            <div class="heading-container push-down">
                <h1 class="text-center pt-5">Merchandise</h1>
            </div>

            <div class="row">
                <div class="col-lg-4 merch-div">
                    <div class="card">
                        <div style="height: 320px"><img class="img-fluid" src="/img/cap.png" /></div>
                        <div class="item-details-fixed">
                            <h5 class="">F4K Cap</h5>
                            <p class="">Great for outdoors!</p>
                            <p class="">$14.99</p>
                            <a href="#">
                                <p class="item-link">Buy</p>
                            </a>
    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 merch-div">
                    <div class="card">
                        <div style="height:320px;"><img class="img-fluid" style="vertical-align: middle;" src="/img/merch-shirt.png" /></div>
                        <div class="item-details-fixed">
                            <h5 class="">F4K Shirt</h5>
                            <p class="">Show your support for the cause!</p>
                            <p class="">$24.99</p>
                            <a href="#">
                                <p class="item-link">Buy</p>
                            </a>
    
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 merch-div">
                    <div class="card">
                        <div style="height:320px"><img class="img-fluid" src="/img/merch-shirt2.png" /></div>
                        <div class="item-details-fixed">
                            <h5 class="">F4K Sweater</h5>
                            <p class="">Keep warm during the warmer months!</p>
                            <p class="">$34.99</p>
                            <a href="#">
                                <p class="item-link">Buy</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-black small text-center text-white-50">
        <div class="container">
            Copyright &copy; Fight For Kidz 2018
        </div>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="vendor/font-awesome/js/all.js"></script>
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for this template -->
    <script src="js/grayscale.js"></script>

    <!-- Custom script for image modals -->
    <script src="js/modal.js"></script>

</body>

</html>
