@extends('layouts.app')

@section('content')
<div class="container-fluid push-down">
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

        <div class="fight-div mt-5">
            <div class="row">
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/1.jpg" />
                        <h4>Miller VS Rogerson</h4>
                    </div>

                </div>
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/2.jpg" />
                        <h4>Jackson VS Quarrie</h4>
                    </div>

                </div>
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/4.jpg" />
                        <h4>Grant VS Little</h4>
                    </div>

                </div>
            </div>
        </div>
        <div class="fight-div">
            <div class="row">
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/2.jpg" />
                        <h4>Miller VS Rogerson</h4>
                    </div>

                </div>
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/5.jpg" />
                        <h4>Jackson VS Quarrie</h4>
                    </div>

                </div>
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/3.jpg" />
                        <h4>Grant VS Little</h4>
                    </div>

                </div>
            </div>
        </div>
        <div class="fight-div">
            <div class="row">
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/3.jpg" />
                        <h4>Miller VS Rogerson</h4>
                    </div>

                </div>
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/1.jpg" />
                        <h4>Jackson VS Quarrie</h4>
                    </div>

                </div>
                <div class="col-lg-4 fight-thumb">
                    <div>
                        <img class="fight-img img-fluid" src="/img/boxing-snaps/2.jpg" />
                        <h4>Grant VS Little</h4>
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

