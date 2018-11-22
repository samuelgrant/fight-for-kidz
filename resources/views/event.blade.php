@extends('layouts.app')

@section('content')

<div style="background-color: black;">
  <section class="upcoming-section">
    <div class="container">
      <div class="row pb-5">
        <div class="col-lg-8 col-md-6 col-col-sm-12 pt-5">
          <h1 class="text-white underline bar">{{$event->name}}</h1>
          <p class="text-justify">{{$event->desc_1}}</p>
          	@if(App\Document::where('display_location', 'Event')->get()->count() > 0)
			<div class="mb-3">
				<h5>Related files:</h5>
				@foreach(App\Document::where('display_location', 'Event')->get() as $doc)
				<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>
				@endforeach
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
          <a class="stat-link" href="{{$event->charity_url}}" target="blank" style="color: white!important;">
            <i class="fas fa-link"></i> {{$event->charity}}
          </a>
          @else
          <p class="stat">{{$event->charity}}</p>
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
</div>
</div>
</section>

<!-- Sponsors Section -->
@if(count($event->sponsors) > 3)
<section id="sponsors-section">
  <h2 class="text-center text-dark">Event Sponsors</h2>
  <div class="slick-sponsors">
    @foreach($event->sponsors as $sponsor)
      {{-- only show logo in sponsors bar if the image file for it exists --}}
      @if(file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')))
        <div>
            <a href="{{$sponsor->url}}" target="_blank">
            <img class="img-fluid" style="max-width:250px;" src="{{'/storage/images/sponsors/' . $sponsor->id . '.png'}}">
          </a>
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
    <!-- Each bout will create one column -->
    <div class="col-lg-6 bout-column">

      <!-- Each bout has a bout header -->
      <div class="bout-card">
        <div class="bout-header">
          <h2>BOUT {{++$i}}</h2>
          {{-- <p class="sponsored-by">sponsored by</p> --}}
          @if($bout->sponsor)
            <div class="sponsor-badge">
              <div class="vertical-aligner"></div><a href="{{$bout->sponsor->url}}" target="_blank"><img style="max-height:60px;" src="{{'/storage/images/sponsors/' . $bout->sponsor->id . '.png'}}" class="img-fluid bout-sponsor"></a>
            </div>
          @endif
        </div>

        <!-- Each bout card will contain two contender-cards -->
        <div class="contender-card contender-card-red">
          <div class="contender-card-inner">
            <img src="{{file_exists(public_path('/storage/images/contenders/' . $bout->red_contender->id . '.png')) ? '/storage/images/contenders/' . $bout->red_contender->id . '.png' : '/storage/images/contenders/0.png'}}"
              class="mx-auto contender-img">
            <div class="contender-name">
              <h5>{{$bout->red_contender->first_name}}</h5>
              <h4>{{$bout->red_contender->nickname}}</h4>
              <h5>{{$bout->red_contender->last_name}}</h5>
            </div>
            <div class="bout-btn bout-btn-red bio-view-button" data-toggle="modal" data-target="#bio-modal"
              data-contenderId="{{$bout->red_contender->id}}">View Bio</div>
            <div class="bout-btn bout-btn-red" onclick="window.open('{{$bout->red_contender->donate_url ?? 'https://givealittle.co.nz'}}', '_blank')">Donate</div>
          </div>
        </div>

        <div class="contender-card contender-card-blue">
          <div class="contender-card-inner">
            <img src="{{file_exists(public_path('/storage/images/contenders/' . $bout->blue_contender->id . '.png')) ? '/storage/images/contenders/' . $bout->blue_contender->id . '.png' : '/storage/images/contenders/0.png'}}"
              class="mx-auto contender-img">
            <div class="contender-name">
              <h5>{{$bout->blue_contender->first_name}}</h5>
              <h4>{{$bout->blue_contender->nickname}}</h4>
              <h5>{{$bout->blue_contender->last_name}}</h5>
              <div class="bout-btn bout-btn-blue bio-view-button" data-toggle="modal" data-target="#bio-modal"
                data-contenderId="{{$bout->blue_contender->id}}">View Bio</div>
              <div class="bout-btn bout-btn-blue" onclick="window.open('{{$bout->blue_contender->donate_url ?? 'https://givealittle.co.nz'}}', '_blank')">Donate</div>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- end each bout -->
    @endif
    @endforeach

  </div> <!-- end all bouts -->


<!-- Dynamic modal -->
<div id="bio-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
  style="display: none; z-index:4005;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">

        {{-- Dynamic content will load here --}}
        <div id="dynamic-content" style="color:black;">


          <div class="text-center">
            <h3 id=first-name class="d-inline mx-2"></h3>
            <h2 id="nickname" class="d-inline"></h2>
            <h3 id="last-name" class="d-inline mx-2"></h3>
            <hr>
            <iframe width="560" height="315" id="bio-vid" src="" frameborder="0" allow="autoplay; encrypted-media;"
              allowfullscreen></iframe>

            <div class="text-justify px-4 py-3">
              <p id="bio-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi quam cupiditate ea,
                aliquam voluptate veritatis officiis sequi quaerat aliquid placeat voluptatum
                nesciunt quod non, velit at inventore sapiente? Quia, quis.
              </p>
            </div>

            <div class="row">
              <div class="col-lg-6"><img id="bio-image" src="/storage/images/contenders/0.png" class="img-fluid"></div>
              <div class="col-lg-6">
                <h5 class="text-center">My Stats:</h5>
                <table class="table table-striped table-bordered table-sm text-center">
                  <tbody>
                    <tr>
                      <td> Age: <span id="contenderAge">44</span></td>
                    </tr>
                    <tr>
                      <td> Weight (kg): <span id="contenderWeight">77</span></td>
                    </tr>
                    <tr>
                      <td> Height (cm): <span id="contenderHeight">174</span></td>
                    </tr>
                    <tr>
                      <td> Reach (cm) <span id="contenderReach">174</span></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>

          </div>


        </div>

      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div> {{-- close bio-modal --}}
@endif
</div>
@endsection