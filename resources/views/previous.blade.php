@extends('layouts.app')

@section('content')
    <div class="container push-down">
        <h1 class="text-white text-center mb-5">Previous Events</h1>
        <div class="dropdown" style="display: block !important; margin:auto !important; width:fit-content;">
            <button class="btn btn-primary dropdown-toggle" type="button" id="yearSelectionButton" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false">
                Select Year
            </button>
            <div class="dropdown-menu" aria-labelledby="yearSelectionButton">
                <a class="dropdown-item" href="#">2017</a>
                <a class="dropdown-item" href="#">2016</a>
                <a class="dropdown-item" href="#">2015</a>
                <a class="dropdown-item" href="#">2014</a>
            </div>
        </div>

        <div id="fightCarousel" class="carousel slide mt-5" data-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="fight-div">
                        <div class="row">
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/1.jpg" />
                                </div>
                                <h4>Miller VS Rogerson</h4>
                            </div>
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/2.jpg" />
                                </div>
                                <h4>Jackson VS Quarrie</h4>
                            </div>
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/3.jpg" />
                                </div>
                                <h4>Grant VS Little</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="fight-div">
                        <div class="row">
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/4.jpg" />
                                </div>
                                <h4>Miller VS Rogerson</h4>
                            </div>
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/5.jpg" />
                                </div>
                                <h4>Jackson VS Quarrie</h4>
                            </div>
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/1.jpg" />
                                </div>
                                <h4>Grant VS Little</h4>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="fight-div">
                        <div class="row">
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/2.jpg" />
                                </div>
                                <h4>Miller VS Rogerson</h4>
                            </div>
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/4.jpg" />
                                </div>
                                <h4>Jackson VS Quarrie</h4>
                            </div>
                            <div class="col-lg-4 fight-thumb">
                                <div>
                                    <img class="fight-img img-fluid" src="/img/boxing-snaps/3.jpg" />
                                </div>
                                <h4>Grant VS Little</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a class="carousel-control-prev" href="#fightCarousel" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#fightCarousel" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>

    </div>
@endsection

