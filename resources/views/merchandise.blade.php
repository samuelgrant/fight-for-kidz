@extends('layouts.app') 
@section('content')
<div id="merchandise" class="container mb-5 " style="background-color: rgba(0,0,0,0.7);">
    <div class="heading-container push-down pt-3">
        <h1 class="text-center mb-2">Merchandise</h1>
        <p class="text-center">Our merchandise is available for purchase on the day of the event.</p>
    </div>

    <div class="row">
        @foreach($merch as $item)
        @if($item->item_visible)
        <div class="col-lg-4 merch-div">
            <div class="card">
                <div class="item-details-fixed">
                    <h3 class="mb-5">{{$item->name}}</h5>
					<img class="mb-2" src="{{file_exists(public_path('/storage/images/merchandise/' . $item->id . '.png')) ? '/storage/images/merchandise/' . $item->id . '.png' : '/storage/images/merchandise/0.png'}}"
					width="200" max-height="100">
					<p><i>{{$item->tagline}}</i></p>
					<p>{{$item->desc}}</p>					
					<h4><b>${{$item->price}}</b></h4>
				</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection 