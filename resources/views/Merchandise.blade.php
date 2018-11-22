@extends('layouts.app') 
@section('content')
<<<<<<< HEAD
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
=======
<div id="merchandise" class="container" style="background-color: rgba(0,0,0,0.7);">
	<div class="heading-container push-down pt-3">
		<h1 class="text-center ">Merchandise</h1>
	</div>

	<div class="row">
		<div class="col-lg-4 merch-div">
			<div class="card">
				<div class="mb-4 text-center"><img class="img-fluid" style="height: 250px;" src="/img/merch/F4Kcap.png" /></div>
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
				<div class="mb-4"><img class="img-fluid" style="vertical-align: middle;height: 250px; " src="/img/merch/F4KTechCrewBW.png" /></div>
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
				<div class="mb-4"><img class="img-fluid" style="height: 250px;" src="/img/merch/F4KTshirtGrey.png" /></div>
				<div class="item-details-fixed">
					<h5 class="">F4K Sweater</h5>
					<p class="">Keep warm this winter!</p>
					<p class="">$34.99</p>
					<a href="#">
						<p class="item-link">Buy</p>
					</a>
				</div>
			</div>
		</div>
	</div>
>>>>>>> 332d89fc6b11438e780930bad1da4c50c5157028
</div>
@endsection