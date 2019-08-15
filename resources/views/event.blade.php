@extends('layouts.app') 
@section('content')

<div style="background-color: black; overflow-x:hidden;">
	<section class="upcoming-section">

		@include('layouts.messages')
		<div class="container">
			<div class="row pb-5">
				<div class="col-lg-8 col-md-6 col-col-sm-12 pt-5 px-4">
					<h1 class="text-white underline bar">{{$event->name}}</h1>
					<p class="text-left my-4">{{$event->desc_1}}</p>
					
					@if(App\Document::where('display_location', 'Event')->get()->count() > 0)
					<div class="mb-3">
						<h5>Related files:</h5>
						@foreach(App\Document::where('display_location', 'Event')->get() as $doc)
						<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>
						@endforeach
					</div>
					@endif

					@if($event->event_sponsor)
					<div>
						<h3 class="mb-3">Proudly sponsored by</h3>
						@if(App\Sponsor::find($event->event_sponsor)->url)
							<a href="{{App\Sponsor::find($event->event_sponsor)->url}}" target="blank">
							<img src="/storage/images/sponsors/{{$event->event_sponsor}}.png" style="max-width:400px;" title="{{App\Sponsor::find($event->event_sponsor)->company_name}}">
						</a>
						@else
							<img src="/storage/images/sponsors/{{$event->event_sponsor}}.png" style="max-width:400px;" title="{{App\Sponsor::find($event->event_sponsor)->company_name}}">
						@endif
					</div>
					@endif
				</div>

				<div class="col-lg-4 col-md-6 col-sm-12 text-white text-right results mt-5">
					<p class="all-caps sidebar-heading">Date/Time</p>
					<p class="stat">
						{{\Carbon\Carbon::parse($event->datetime)->format('D d M Y h:i a')}}{{--->toDayDateTimeString()--}}
					</p>
					<p class="all-caps sidebar-heading">Location</p>
					<p class="stat">{{$event->venue_name}}</p>
					<p class="all-caps sidebar-heading">Supporting</p>          
					@if($event->charity_url)
						@if(file_exists(public_path('storage/images/charity/'. $event->id . '.png')))
							<p class="stat">
								<a href="{{$event->charity_url}}" target="_blank">
									<img id="charityLogo" src="{{'/storage/images/charity/' .  $event->id . '.png'}}" title="{{$event->charity}}" style="width: 150px;">
								</a>
							</p>
						@else
						<a href="{{$event->charity_url}}" target="_blank" class="stat">
							<h4 class="text-underline">{{$event->charity}}</h4>
						</a>
						@endif
					@else
						@if(file_exists(public_path('storage/images/charity/'. $event->id . '.png')))
							<p class="stat">
								<img id="charityLogo" src="{{'/storage/images/charity/' .  $event->id . '.png'}}" style="width: 150px;" title="{{$event->charity}}"></p>
						@else
							<h4 class="text-white stat">{{$event->charity}}</h4>
						@endif
					@endif
				</div>
			</div>
		</div>


		<div class="w-100 text-center py-0 mb-5">
			@if($event->show_auctions)
			<a href="#auction-section" class="btn py-1">See Auctions <br> <i class="fas fa-chevron-down mx-auto"></i></a>
			@endif
			@if($event->show_bouts)
			<a href="#bouts-section" class="btn py-1">See Bouts<br> <i class="fas fa-chevron-down mx-auto"></i></a>	
			@endif
		</div>		


		@if(App\Event::current() == $event && $event->isFutureEvent())
		<div class="row">
			<div class="col-lg-12 col-md-12 col-col-sm-12">
				<div id="map" style="width:100%; height: 450px; border:0"></div>
				<script>
					function initMap() {
						var uluru = { {{ $event-> venue_gps }} };
						var map = new google.maps.Map(document.getElementById('map'), {
							zoom: 15,
							center: uluru
						});
						
						var marker = new google.maps.Marker({
							position: uluru,
							map: map
						});
					}
				</script>

				<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_BROWSER_KEY')}}&callback=initMap"> </script>
			</div>
		</div>
		@endif
	</section>

	<!-- Sponsors Section -->
	@if(count($event->sponsors) > 3)
	<section id="sponsors-section" style="border-top: 2px solid black;">
		<h2 class="text-center text-dark">Event Sponsors</h2>
		<div class="slick-sponsors slick-sponsors-hide">
			@foreach($event->sponsorsShuffled() as $sponsor) 
				{{-- only show logo in sponsors bar if the image file for it exists --}} 
				@if(file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')))
				<div>

					@if($sponsor->url)
						<a href="{{$sponsor->url}}" target="_blank">
							<img class="img-fluid" style="width:300px; max-height:300px; margin-left: 50px; margin-right: 50px;" src="/storage/images/sponsors/{{$sponsor->id}}.png" title="{{$sponsor->company_name}}">
						</a>
					@else
						{{-- Div surrounding img is required for vertical alignment to function --}}
						<div>
							<img class="img-fluid" style="width:300px; max-height:300px; margin-left: 50px; margin-right: 50px;" src="/storage/images/sponsors/{{$sponsor->id}}.png" title="{{$sponsor->company_name}}">
						</div>
						@endif
					</div>  
				@endif
			@endforeach
			</div>
	</section>
	@endif

	<!-- Bouts Section - show if bouts are switched on-->
	@if($event->show_bouts)
		{{-- @include('eventPartials.old-bouts') --}}
		@include('eventPartials.bouts')
		@include('eventPartials.bioModal')
		
	@endif
</div>

<!-- Auction section - show if auctions switched on -->
@if($event->show_auctions)
<section id="auction-section">
	<hr class="text-white mb-5" style="border: 2px solid white">
	
	<h1 class="text-center mb-5">
		{{$event->name}} Auctions
	</h1>

	<p class="text-center px-3">
		The following items {{$event->isFutureEvent() ? 'will be' : 'were'}} available for auction on the night of the event. We thank all donors for their generous contributions.
	</p>

	<div class="container pt-5">

		<!-- All auctions will be contained within single row -->
		<div class="row auctions-row">

		<!-- counter used to name auctions -->				
		<?php global $a?>
		
			@foreach($event->auctions as $auction)
			<!-- Each auction will create one column -->
			<div class="col-lg-6 auction-column">

			<!-- Each auction has a auction header -->
				<div class="auction-card">
					<div class="auction-header">
						<h2>AUCTION {{++$a}}</h2>
					</div>

					<!-- Each auction card will contain one auction-card either blue or red -->
					@if($a % 2 != 0)
						<div class="auctionItem-card auctionItem-card-red">
							<div class="auctionItem-card-inner">
								<img src="{{file_exists(public_path('/storage/images/auction/' . $auction->id . '.png')) ? '/storage/images/auction/' . $auction->id . '.png' : '/storage/images/auction/0.png'}}" class="mx-auto auctionItem-img">
								<div class="auctionItem-name">
									<h5>{{$auction->name}}</h5>
								</div>
								<div class="auction-btn auction-btn-red" onclick="auctionItemModal({{$auction->id}})">
									More Info
								</div>
							</div>
						</div>
					@elseif($a % 2 == 0)
						<div class="auctionItem-card auctionItem-card-blue ">
							<div class="auctionItem-card-inner">
								<img src="{{file_exists(public_path('/storage/images/auction/' . $auction->id . '.png')) ? '/storage/images/auction/' . $auction->id . '.png' : '/storage/images/auction/0.png'}}" class="mx-auto auctionItem-img">
								<div class="auctionItem-name">
									<h5>{{$auction->name}}</h5>
								</div>
								<div class="auction-btn auction-btn" onclick="auctionItemModal({{$auction->id}})">
									More Info
								</div>
							</div>
						</div>
					@endif
				</div>
			</div> <!-- end each auction -->
		@endforeach		
	</div> <!-- end all auctions -->
</section>

<!-- Dynamic modal for displaying auction item info -->
<div id="auctionItemModal" class="modal fade pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:4005;">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-body auction-modal-body pt-2">
				{{-- Dynamic content will load here --}}
				<div class="dynamic-content" style="color:black;">
					<div class="text-center mt-2">
						<h2 id=auctionItemName class="d-inline"></h2>
						<hr>

						<div class="row px-3 pb-2">
							<div class="col-lg-6 mx-auto image-frame mb-3">
								<img id="auctionItemImage" src="" class="img-fluid">
							</div>
						</div>

						<div class="row">
							<table id="auctionTable" class="tabletable-sm text-center mx-auto">
								<tbody>
									<tr id="auctionTableDonor">
										<td>
											<p class="pt-2 mb-0">Donated by</p>
											<span id="auctionItemDonorSpan"></span>
										</td>
									</tr>
									<tr id="auctionTableDonorUrl">
										<td>
											<span>
												<a href="" id="auctionItemDonorUrlSpan" target="_blank">
											</span>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
						<hr>

						<div class="text-justify px-4 py-3">
							<p id="auctionItemDescription"></p>
						</div>

						<div class="modal-footer auction-modal-footer">
							<button id="auctionBtn" type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- End of auction-info-modal --}}
@endif

<!-- Dynamic fight video modal -->
<div id="fight-video-modal" class="modal fade pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:4005;">
	<div class="modal-dialog modal-lg modal-iframe">
		<div class="modal-content">
			<div class="modal-body contender-modal-body pl-0">

				{{-- Dynamic content will load here --}}
				<div class="dynamic-content" style="color:black;">

					<div class="text-center text-white">
						<h3 id="red-corner" class="d-inline mx-2"></h3>
						<h5 class="d-inline">V.</h5>
						<h3 id="blue-corner" class="d-inline mx-2"></h3>
						<hr class="ml-3">

						<iframe class="iframe-video" id="fight-vid" src="" frameborder="0" allow="autoplay; encrypted-media;" allowfullscreen></iframe>
					</div>
					<div class="modal-footer contender-modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">
							Close
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> {{-- close fight-modal --}}
</div>
@endsection
