@extends('layouts.app') 
@section('content')

<div style="background-color: black; overflow-x:hidden;">
	<section class="upcoming-section">
		<div class="container">
			<div class="row pb-5">
				<div class="col-lg-8 col-md-6 col-col-sm-12 pt-5 px-4">
					<h1 class="text-white underline bar">{{$event->name}}</h1>
					<p class="text-left my-4">{{$event->desc_1}}</p>
					@if(App\Document::where('display_location', 'Event')->get()->count() > 0)
					<div class="mb-3">
						<h5>Related files:</h5>
						@foreach(App\Document::where('display_location', 'Event')->get() as $doc)
						<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>						@endforeach
					</div>
          @endif
          @if($event->event_sponsor)
          <div class="">
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
					<p class="stat">{{\Carbon\Carbon::parse($event->datetime)->format('D d M Y h:i a')}}{{--->toDayDateTimeString()--}}</p>
					<p class="all-caps sidebar-heading">Location</p>
					<p class="stat">{{$event->venue_name}}</p>
					<p class="all-caps sidebar-heading">Supporting</p>          
            @if($event->charity_url)
                @if(file_exists(public_path('storage/images/charity/'. $event->id . '.png')))
                  <p class="stat"><a href="{{$event->charity_url}}" target="_blank"><img id="charityLogo" src="{{'/storage/images/charity/' .  $event->id . '.png'}}" title="{{$event->charity}}" style="width: 150px;"></a></p>
                @else
                  <a href="{{$event->charity_url}}" target="_blank" class="stat"><h4><u>{{$event->charity}}</u></h4></a>
                @endif
            @else
              @if(file_exists(public_path('storage/images/charity/'. $event->id . '.png')))
                <p class="stat"><img id="charityLogo" src="{{'/storage/images/charity/' .  $event->id . '.png'}}" style="width: 150px;" title="{{$event->charity}}"></p>
              @else
                <h4 class="text-white stat">{{$event->charity}}</h4>
              @endif
            @endif
				</div>
			</div>
		</div>
		@if(App\Event::current() == $event && $event->isFutureEvent())
		<div class="row">
			<div class="col-lg-12 col-md-12 col-col-sm-12">
				<div id="map" style="width:100%; height: 450px; border:0"></div>
				<script>
					function initMap() {
            var uluru = { {{ $event-> venue_gps
          }} };
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

				<script async defer src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&callback=initMap">

				</script>
			</div>
		</div>
		@endif
	</section>

	<!-- Sponsors Section -->
	@if(count($event->sponsors) > 3)
		<section id="sponsors-section" style="border-top: 2px solid black;">
			<h2 class="text-center text-dark">Event Sponsors</h2>
			<div class="slick-sponsors">
				@foreach($event->sponsors as $sponsor) 
					{{-- only show logo in sponsors bar if the image file for it exists --}} 
					@if(file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')))
						<div>
							@if($sponsor->url)
								<a href="{{$sponsor->url}}" target="_blank">
									<img class="img-fluid" style="max-width:400px;" src="/storage/images/sponsors/{{$sponsor->id}}.png" title="{{$sponsor->company_name}}">
								</a>
							@else
								{{-- Div surrounding img is required for vertical alignment to function --}}
								<div><img class="img-fluid" style="max-width:400px;" src="/storage/images/sponsors/{{$sponsor->id}}.png" title="{{$sponsor->company_name}}"></div>
							@endif
						</div>  
					@endif
				@endforeach
			</div>
		</section>
	@endif

<!-- Bouts Section - show if bouts are switched on-->
@if($event->show_bouts)
<div class="container pt-5">

  <!-- All bouts will be contained within single row -->
  <div class="row bouts-row">

    <?php global $i ?>
    <!-- counter used to name bouts -->
    @foreach($event->bouts as $bout)
    @if($bout->contendersSet()) {{-- Only use bouts that have contenders set, this prevents crash --}}

    @if($event->isFutureEvent()) {{--Sets the bout cards of an upcoming event --}}
    <!-- Each bout will create one column -->
    <div class="col-lg-6 bout-column">

      <!-- Each bout has a bout header -->
      <div class="bout-card">
        <div class="bout-header">
			<h2>BOUT {{++$i}}</h2>
			{{-- <p class="sponsored-by">sponsored by</p> --}}
			@if($bout->sponsor)
				<div class="sponsor-badge">
					<div class="vertical-aligner"></div>
					<a href="{{$bout->sponsor->url}}" target="_blank">
						<img style="max-height:60px;" src="{{'/storage/images/sponsors/' . $bout->sponsor->id . '.png'}}" class="img-fluid bout-sponsor"
						title="{{$bout->sponsor->company_name}}">
					</a>
				</div>
			@endif
        </div>

        <!-- Each bout card will contain two contender-cards -->
        <div class="contender-card contender-card-red">
          <div class="contender-card-inner">
            <img src="{{file_exists(public_path('/storage/images/contenders/' . $bout->red_contender->id . '.jpg')) ? '/storage/images/contenders/' . $bout->red_contender->id . '.jpg' : '/storage/images/contenders/0.png'}}"
              class="mx-auto contender-img">
            <div class="contender-name">
              <h5>{{$bout->red_contender->first_name}}</h5>
              <div class="nickname-wrapper"><h4 class="nickname-cell">{{$bout->red_contender->nickname}}</h4></div>
              <h5>{{$bout->red_contender->last_name}}</h5>
            </div>

            {{-- Sponsor Logo --}}
			  <label for="red-sponsor" style="font-size:14px;">Sponsored by</label>
			  <div class="contender-sponsor-section">
				@if(App\Contender::find($bout->red_contender_id)->sponsor_id)
					@if(App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->url)              						                
						<a href="{{App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->url}}" target="blank" class="contender-sponsor-logo-wrapper">
							<img id="red-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png')) ?
							'/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
							class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->company_name}}">
						</a>
					@else
						<div class="contender-sponsor-logo-wrapper">
							<img id="red-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png')) ?
							'/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
							class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->company_name}}">
						</div>
					@endif
				@endif
			</div>
              <div class="bout-btn bout-btn-red bio-view-button" data-toggle="modal" data-target="#bio-modal"
                data-contenderId="{{$bout->red_contender->id}}">View Bio</div>
              <div class="bout-btn bout-btn-red" onclick="window.open('{{$bout->red_contender->donate_url ?? 'https://givealittle.co.nz'}}', '_blank')">Donate</div>
            
          </div>
        </div>

        <div class="contender-card contender-card-blue">
          <div class="contender-card-inner">
            <img src="{{file_exists(public_path('/storage/images/contenders/' . $bout->blue_contender->id . '.jpg')) ? '/storage/images/contenders/' . $bout->blue_contender->id . '.jpg' : '/storage/images/contenders/0.png'}}"
              class="mx-auto contender-img">
            <div class="contender-name">
              <h5>{{$bout->blue_contender->first_name}}</h5>
              <div class="nickname-wrapper"><h4 class="nickname-cell">{{$bout->blue_contender->nickname}}</h4></div>
              <h5>{{$bout->blue_contender->last_name}}</h5>
            </div>

            {{-- Sponsor Logo --}}
			  <label for="blue-sponsor" style="font-size:14px;">Sponsored by</label>
			  <div class="contender-sponsor-section">					 
			  @if(App\Contender::find($bout->blue_contender_id)->sponsor_id)   
				@if(App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->url)
					<a href="{{App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->url}}" target="blank" class="contender-sponsor-logo-wrapper">
						<img id="blue-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png')) ?
						'/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
						class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->company_name}}">
					</a>
				@else
					<div class="contender-sponsor-logo-wrapper">
						<img id="blue-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png')) ?
						'/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
						class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->company_name}}">
					</div>
				@endif
			@endif
			</div>
              <div class="bout-btn bout-btn-blue bio-view-button" data-toggle="modal" data-target="#bio-modal"
                data-contenderId="{{$bout->blue_contender->id}}">View Bio</div>
              <div class="bout-btn bout-btn-blue" onclick="window.open('{{$bout->blue_contender->donate_url ?? 'https://givealittle.co.nz'}}', '_blank')">Donate</div>
            
          </div>
        </div>
      </div>
    </div> <!-- end each bout -->
    @elseif(!$event->isFutureEvent())
    <!-- Each bout will create one column -->
    <div class="col-lg-6 bout-column">

      <!-- Each bout has a bout header -->
      <div class="bout-card">
		<div class="bout-header">
			<h2>BOUT {{++$i}}</h2>
			{{-- <p class="sponsored-by">sponsored by</p> --}}
			@if($bout->sponsor)
				<div class="sponsor-badge">
					<div class="vertical-aligner"></div>
					@if($bout->sponsor->url)
					<a href="{{$bout->sponsor->url}}" target="_blank">
						<img style="max-height:60px;" src="{{'/storage/images/sponsors/' . $bout->sponsor->id . '.png'}}" class="img-fluid bout-sponsor" 
						title="{{$bout->sponsor->company_name}}">
					</a>
					@else
						<img style="max-height:60px;" src="{{'/storage/images/sponsors/' . $bout->sponsor->id . '.png'}}" class="img-fluid bout-sponsor" 
						title="{{$bout->sponsor->company_name}}">
					@endif
				</div>
			@endif
        </div>

        <!-- Each bout card will contain two contender-cards -->
        <div class="row">
          <div class="contender-card contender-card-red">
            <div class="contender-card-inner h-100">
              <img src="{{file_exists(public_path('/storage/images/contenders/' . $bout->red_contender->id . '.jpg')) ? '/storage/images/contenders/' . $bout->red_contender->id . '.jpg' : '/storage/images/contenders/0.png'}}"
                class="mx-auto contender-img">
              <div class="contender-name">
                <h5>{{$bout->red_contender->first_name}}</h5>
                <div class="nickname-wrapper"><h4 class="nickname-cell">{{$bout->red_contender->nickname}}</h4></div>
                <h5>{{$bout->red_contender->last_name}}</h5>
              </div>
  
			  {{-- Sponsor Logo --}}
			  <label for="red-sponsor" style="font-size:14px;">Sponsored by</label>
			  <div class="contender-sponsor-section">
				@if(App\Contender::find($bout->red_contender_id)->sponsor_id)
					@if(App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->url)              						                
						<a href="{{App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->url}}" target="blank" class="contender-sponsor-logo-wrapper">
							<img id="red-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png')) ?
							'/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
							class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->company_name}}">
						</a>
					@else
						<div class="contender-sponsor-logo-wrapper">
							<img id="red-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png')) ?
							'/storage/images/sponsors/' . App\Contender::find($bout->red_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
							class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->red_contender_id)->sponsor_id)->company_name}}">
						</div>
					@endif
				@endif
			</div>
    
                <div class="bout-btn bout-btn-red bio-view-button" data-toggle="modal" data-target="#bio-modal"
                  data-contenderId="{{$bout->red_contender->id}}">View Bio</div>              
            </div>
          </div>
  
    	<div class="contender-card contender-card-blue">
        	<div class="contender-card-inner h-100">
              <img src="{{file_exists(public_path('/storage/images/contenders/' . $bout->blue_contender->id . '.jpg')) ? '/storage/images/contenders/' . $bout->blue_contender->id . '.jpg' : '/storage/images/contenders/0.png'}}"
                class="mx-auto contender-img">
              <div class="contender-name">
                <h5>{{$bout->blue_contender->first_name}}</h5>
                <div class="nickname-wrapper"><h4 class="nickname-cell">{{$bout->blue_contender->nickname}}</h4></div>
                <h5>{{$bout->blue_contender->last_name}}</h5>
              </div>
  
			  {{-- Sponsor Logo --}}
			  <label for="blue-sponsor" style="font-size:14px;">Sponsored by</label>
			  <div class="contender-sponsor-section">					 
			  @if(App\Contender::find($bout->blue_contender_id)->sponsor_id)   
				@if(App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->url)
					<a href="{{App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->url}}" target="blank" class="contender-sponsor-logo-wrapper">
						<img id="blue-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png')) ?
						'/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
						class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->company_name}}">
					</a>
				@else
					<div class="contender-sponsor-logo-wrapper">
						<img id="blue-sponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png')) ?
						'/storage/images/sponsors/' . App\Contender::find($bout->blue_contender_id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}"
						class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($bout->blue_contender_id)->sponsor_id)->company_name}}">
					</div>
				@endif
			@endif
			</div>
            <div class="bout-btn bout-btn-blue bio-view-button" data-toggle="modal" data-target="#bio-modal"
	           	data-contenderId="{{$bout->blue_contender->id}}">View Bio
            </div>              
            </div>
          </div>
          
          @if($bout->video_url != null)
          <div class="bout-footer mx-auto">
              <div class="bout-btn bout-btn-fight fight-view-btn"  data-toggle="modal" data-target="#fight-video-modal"
              data-bout-id="{{$bout->id}}">Watch the Fight!</div>
          </div>
          @endif
        </div>
      </div>
    </div> <!-- end each bout -->
    @endif
    @endif
    @endforeach

  </div> <!-- end all bouts -->


<!-- Dynamic bio modal -->
<div id="bio-modal" class="modal fade pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none; z-index:4005;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body contender-modal-body pl-0">

        {{-- Dynamic content will load here --}}
        <div class="dynamic-content" style="color:black;">


          <div class="text-center text-white">
            <h3 id=first-name class="d-inline mx-2"></h3>
            <h2 id="nickname" class="d-inline"></h2>
            <h3 id="last-name" class="d-inline mx-2"></h3>
            <iframe width="638" height="315" id="bio-vid" src="" frameborder="0" allow="autoplay; encrypted-media;"
              allowfullscreen style="border-bottom: 1px solid white; border-top: 1px solid white;">
          </iframe>

            {{-- Sponsor logo --}}
            <div id="bio-sponsor-div" class="col-lg-6 pt-2 mx-auto text-center d-none">
              <label for="bio-sponsor" style="width:100%;">Sponsored by...</label>
              <a id="sponsorLink" target="blank">
                <img id="bio-sponsor" class="img-fluid" style="height: 100px;">
              </a>  
            </div>

            <div class=" px-4 py-3 text-white text-justify">
              <h3 class="bio-label"></h3>
              <p id="bio-text"></p>
            </div>

            <div class="row pl-3">
              <div class="col-lg-4"><img id="bio-image" class="img-fluid"></div>
              <div class="col-lg-6">
                <h5 class="text-center text-white">My Stats:</h5>
                <table id="contenderTable" class="table table-sm text-center">
                  <tbody>
                    <tr>
                      <td> Age: <span id="contenderAge"></span></td>
                    </tr>
                    <tr>
                      <td> Weight (kg): <span id="contenderWeight"></span></td>
                    </tr>
                    <tr>
                      <td> Height (cm): <span id="contenderHeight"></span></td>
                    </tr>
                    <tr>
                      <td> Reach (cm): <span id="contenderReach"></span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="modal-footer contender-modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> {{-- close bio-modal --}}
@endif
</div>

<!-- Auction section - show if auctions switched on -->
@if($event->show_auctions)
  <section id="auction-secton">
    <div class="container pt-5">
  
      <!-- All auctions will be contained within single row -->
      <div class="row auctions-row">
    
        <?php global $a?>
        <!-- counter used to name auctions -->
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
                <img src="{{file_exists(public_path('/storage/images/auction/' . $auction->id . '.png')) ? '/storage/images/auction/' . $auction->id . '.png' : '/storage/images/auction/0.png'}}"
                  class="mx-auto auctionItem-img">
                <div class="auctionItem-name">
                  <h5>{{$auction->name}}</h5>
                </div>
                <div class="auction-btn auction-btn-red" onclick="auctionItemModal({{$auction->id}})">More Info</div>
              </div>
            </div>
            @elseif($a % 2 == 0)
            <div class="auctionItem-card auctionItem-card-blue ">
              <div class="auctionItem-card-inner">
                <img src="{{file_exists(public_path('/storage/images/auction/' . $auction->id . '.png')) ? '/storage/images/auction/' . $auction->id . '.png' : '/storage/images/auction/0.png'}}"
                  class="mx-auto auctionItem-img">
                <div class="auctionItem-name">
                  <h5>{{$auction->name}}</h5>
                </div>
                <div class="auction-btn auction-btn" onclick="auctionItemModal({{$auction->id}})">More Info</div>
              </div>
            </div>
            @endif
          </div>
        </div> <!-- end each auction -->
        @endforeach
    
      </div> <!-- end all auctions -->
  </section>
  
  <!-- Dynamic modal for displaying auction item info -->
  <div id="auctionItemModal" class="modal fade pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none; z-index:4005;">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
  
        <div class="modal-body auction-modal-body pt-2">
  
          {{-- Dynamic content will load here --}}
          <div class="dynamic-content" style="color:black;">
            <div class="text-center mt-2">
              <h2 id=auctionItemName class="d-inline"></h2>
              <hr>
  
              <div class="row px-3 pb-2">
                <div class="col-lg-6 mx-auto image-frame"style="height:333px;"><img id="auctionItemImage" src="" class="img-fluid"></div>
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
                          <td><span><a href="" id="auctionItemDonorUrlSpan"></span></td>
                        </tr>
                      </tbody>
                    </table>
              </div>
              <hr>

              <div class="text-justify px-4 py-3">
                <p id="auctionItemDescription"></p>
              </div>

              <div class="modal-footer auction-modal-footer">
                <button id="auctionBtn" type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div> {{-- End of auction-info-modal --}}
@endif

<!-- Dynamic fight video modal -->
<div id="fight-video-modal" class="modal fade pt-3" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none; z-index:4005;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body contender-modal-body pl-0">

        {{-- Dynamic content will load here --}}
        <div class="dynamic-content" style="color:black;">


          <div class="text-center text-white">
            <h3 id="red-corner" class="d-inline mx-2"></h3>
            <h5 class="d-inline">V.</h5>
            <h3 id="blue-corner" class="d-inline mx-2"></h3>
            <hr class="ml-3">
            <iframe width="638" height="315" id="fight-vid" src="" frameborder="0" allow="autoplay; encrypted-media;"
              allowfullscreen></iframe>

          </div>
          <div class="modal-footer contender-modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div> {{-- close bio-modal --}}
</div>
@endsection
