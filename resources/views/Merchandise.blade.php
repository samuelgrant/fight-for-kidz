@extends('layouts.app') 
@section('content')
<div id="merchandise" class="container mb-5 " style="background-color: rgba(0,0,0,0.7);">
    <div class="heading-container push-down pt-3">
        <h1 class="text-center ">Merchandise</h1>
    </div>

    <div class="row">
        @foreach($merch as $item)
        @if($item->item_visible)
        <div class="col-lg-4 merch-div">
            <div class="card">
                <div  class="mb-4 text-center"><img class="img-fluid" style="height: 250px;" src="" /></div>
                <div class="item-details-fixed">
                    <h5 class="">{{$item->name}}</h5>
                    <img src="">
                    <p class="">{{$item->tagline}}</p>
                    <p class="">{{$item->price}}</p>
                    <a href="#">
                        <p class="item-link">More Info</p>
                    </a>

                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection