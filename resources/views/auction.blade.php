@extends('layouts.app')

@section('content')

    <div class="container my-5 px-5">

        <div class="heading-container push-down pt-5">
            <h1 class="text-white text-center">Auction Items - 2018</h1>
            <h5 class="text-white text-center">Click each image for more info</h5>
        </div>

        <section id="auction_items" class="auction-section">

            <div class="row">

                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" id="myImg" src="img/allblacks.PNG" alt="allblackstop" />

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

                    <img class="img-fluid item-img" id="myImg" src="img/boxinggloves.png" />
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

                    <img class="img-fluid item-img" src="img/boxinggloves2.png" />
                    <div class="item-details">
                        <h5 class="item-name">Ali's Glove</h5>
                        <p class="item-desc">Signed by the man himself.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/boxinggloves3.png" />

                    <div class="item-details">
                        <h5 class="item-name">Phoenix Shirt</h5>
                        <p class="item-desc">Signed by all of the team.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/golf.png" />
                    <div class="item-details">
                        <h5 class="item-name">Ali's Glove</h5>
                        <p class="item-desc">Signed by the man himself.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
                <div class="col-lg-4 auction-item-div">

                    <img class="img-fluid item-img" src="img/richiemacaw.png" />
                    <div class="item-details">
                        <h5 class="item-name">Warriors Shirt</h5>
                        <p class="item-desc">Signed by all of the team.</p>
                        <p class="item-link" id="view">View</p>
                    </div>
                </div>
            </div>

        </section>
    </div>

@endsection