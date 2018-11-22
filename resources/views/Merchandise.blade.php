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
                    <h3 class="mb-2">{{$item->name}}</h5>
					<img class="mb-2" src="{{file_exists(public_path('/storage/images/merchandise/' . $item->id . '.png')) ? '/storage/images/merchandise/' . $item->id . '.png' : '/storage/images/noImage.png'}}"
					width="200" max-height="100">
					<p><i>{{$item->tagline}}</i></p>
					<p>{{$item->desc}}</p>					
					<p class="align-bottom">$&nbsp;{{$item->price}}</p>
				</div>
            </div>
        </div>
        @endif
        @endforeach
    </div>
</div>
@endsection