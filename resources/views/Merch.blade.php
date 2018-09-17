@extends('layouts.app')

@section('content')
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
    @endsection