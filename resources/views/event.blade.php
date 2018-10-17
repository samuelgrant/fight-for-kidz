@extends('layouts.app')

@section('content')

<!-- Upcoming event -->
<div style="background-color: black;">
  <section class="upcoming-section">
    <div class="container">
      <div class="row mb-5">
        <div class="col-lg-8 col-md-6 col-col-sm-12 pt-5">
          <h1 class="text-white underline bar">{{$event->name}}</h1>
          <p class="text-justify">{!! $event->desc_1 !!}</p>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12 text-white text-right results mt-5">
          <p class="all-caps sidebar-heading">Date</p>
          <p class="stat">{{\Carbon\Carbon::parse($event->datetime)->format('D d M Y')}}</p>
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
</div>
</div>
</section>

<!-- Sponsors Section -->
<section id="sponsors-section">
  <h2 class="text-center text-dark">Our Sponsors</h2>
  <div class="slick-sponsors">
    <div><img src="img/customer-1.png" /></div>
    <div><img src="img/customer-2.png" /></div>
    <div><img src="img/customer-3.png" /></div>
    <div><img src="img/customer-4.png" /></div>
  </div>
</section>

<!-- Bouts Section -->
<div class="container pt-5">

  <!-- All bouts will be contained within single row -->
  <div class="row bouts-row">

    <!-- Each bout will create one column -->
    <div class="col-lg-6 bout-column">

      <!-- Each bout has a bout header -->
      <div class="bout-card">
        <div class="bout-header">
          <h2>BOUT ONE</h2>
          {{-- <p class="sponsored-by">sponsored by</p> --}}
          <div class="sponsor-badge">
            <div class="vertical-aligner"></div><img src="/storage/images/FighterSponsorslogo/Taurs sponsor.png" class="img-fluid bout-sponsor">
          </div>
        </div>

        <!-- Each bout card will contain two contender-cards -->
        <div class="contender-card contender-card-red">
          <div class="contender-card-inner">
            <img src="/storage/images/Fighters/Joe THE BEAST Blee.png" class="mx-auto contender-img">
            <div class="contender-name">
              <h5>Joe</h5>
              <h4>'The Beast'</h4>
              <h5>Blee</h5>
            </div>
            <!-- <div class="contender-sponsor">
              <p class="sponsored-by">sponsored by</p>
              <div class="sponsor-badge">
                <div class="vertical-aligner"></div><img src="/storage/images/FighterSponsorslogo/Logan sponsor.png"
                  class="img-fluid">
              </div>
            </div> -->
            <div class="table-responsive table-borderless">
            </div>
            <div class="bout-btn bout-btn-red bio-view-button" data-toggle="modal" data-target="#bio-modal"
              data-contenderId="1">View Bio</div>
            <div class="bout-btn bout-btn-red" onclick="window.open('https://givealittle.co.nz/fundraiser/joe-blee-fight-for-kidz-2018', '_blank')">Donate</div>
          </div>
        </div>

        <div class="contender-card contender-card-blue">
          <div class="contender-card-inner">
            <img src="/storage/images/Fighters/Logan Intimidator Valli.png" class="mx-auto contender-img">
            <div class="contender-name">
              <h5>Logan</h5>
              <h4>'Intimidator'</h4>
              <h5>Valli</h5>
            </div>
            <!-- <div class="contender-sponsor">
              <p class="sponsored-by">sponsored by</p>
              <div class="sponsor-badge">
                <div class="vertical-aligner"></div><img src="/storage/images/FighterSponsorslogo/Joes sponser.png"
                  class="img-fluid">
              </div>
            </div> -->
            <div class="bout-btn bout-btn-blue" onclick="location.href='#'">View Bio</div>
            <div class="bout-btn bout-btn-blue" onclick="location.href='#'">Donate</div>
          </div>
        </div>
      </div>

    </div>

    <div class="col-lg-6 bout-column">

      <!-- Each bout has a bout header -->
      <div class="bout-card">
        <div class="bout-header">
          <h2>BOUT ONE</h2>
          <p class="sponsored-by">sponsored by</p>
          <div class="sponsor-badge">
            <div class="vertical-aligner"></div><img src="/storage/images/FighterSponsorslogo/Alissa sponser.png" class="img-fluid bout-sponsor">
          </div>
        </div>

        <!-- Each bout card will contain two contender-cards -->
        <div class="contender-card contender-card-red">
          <div class="contender-card-inner">
            <img src="/storage/images/Fighters/Joe THE BEAST Blee.png" class="mx-auto contender-img">
            <div class="contender-name">
              <h5>Joe</h5>
              <h4>'The Beast'</h4>
              <h5>Blee</h5>
            </div>
            <div class="contender-sponsor">
              <p class="sponsored-by">sponsored by</p>
              <div class="sponsor-badge">
                <div class="vertical-aligner"></div><img src="/storage/images/FighterSponsorslogo/Kelly sponser.png"
                  class="img-fluid">
              </div>
            </div>
            <div class="bout-btn bout-btn-red" onclick="location.href='#'">View Bio</div>
            <div class="bout-btn bout-btn-red" onclick="location.href='#'">Donate</div>
          </div>
        </div> <!-- end contender card -->

        <div class="contender-card contender-card-blue">
          <div class="contender-card-inner">
            <img src="/storage/images/Fighters/Logan Intimidator Valli.png" class="mx-auto contender-img">
            <div class="contender-name">
              <h5>Logan</h5>
              <h4>'Intimidator'</h4>
              <h5>Valli</h5>
            </div>
            <div class="contender-sponsor">
              <p class="sponsored-by">sponsored by</p>
              <div class="sponsor-badge">
                <div class="vertical-aligner"></div><img src="/storage/images/FighterSponsorslogo/pauls sponser.png"
                  class="img-fluid">
              </div>
            </div>
            <div class="bout-btn bout-btn-blue" onclick="location.href='#'">View Bio</div>
            <div class="bout-btn bout-btn-blue" onclick="location.href='#'">Donate</div>
          </div>
        </div> <!-- end contender card -->
      </div> <!-- end bout card -->
    </div> <!-- end bout column -->

  </div>

  <!-- This version of the layout is displayed on a small screen. -->
  <div class="bouts-stack">
    <div class="bout-card">
      <div class="row bout-header text-center">
        <div class="col-sm-4">
          <h2>BOUT ONE</h2>
        </div>
        <div class="col-sm-4">
          <p>sponsored by</p>
        </div>
        <div class="col-sm-4 sponsor-badge mx-auto"><img src="/storage/images/FighterSponsorslogo/Taurs sponsor.png"
            class="img-fluid bout-sponsor"></div>
      </div>
      <div class="row">
        <div class="col-6 contender-card contender-card-red">
          <div class="contender-card-inner">
            <img src="/storage/images/Fighters/Logan Intimidator Valli.png" class="mx-auto contender-img">
            <div class="contender-name">
              <h5>Logan</h5>
              <h4>'Intimidator'</h4>
              <h5>Valli</h5>
            </div>
          </div>
        </div>
        <div class="col-6 contender-card contender-card-blue">
          <div class="contender-card-inner">
            <img src="/storage/images/Fighters/Logan Intimidator Valli.png" class="mx-auto contender-img">
            <div class="contender-name">
              <h5>Logan</h5>
              <h4>'Intimidator'</h4>
              <h5>Valli</h5>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Dynamic modal -->
<div id="bio-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none; z-index:4005;">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">

      <div class="modal-body">

        <div id="modal-loader" style="display: none; text-align: center">
          <p style="color: black;">Loading</p>
          <img src="/storage/images/ajax-loader.gif">
        </div>

        {{-- Dynamic content will load here --}}
        <div id="dynamic-content" style="color:black;">


          <div class="text-center">
              <h5 id=first-name class="d-inline"></h5>
              <h4 id="nickname" class="d-inline"></h4>
              <h5 id="last-name" class="d-inline"></h5>
              <hr>
              <div style="background-color:lightgray; width: 100%; height: 300px" class="mx-auto my-3"></div>
              
              <div class="bio-text text-justify">
                  <p>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi quam cupiditate ea, 
                    aliquam voluptate veritatis officiis sequi quaerat aliquid placeat voluptatum 
                    nesciunt quod non, velit at inventore sapiente? Quia, quis.
                  </p>
              </div>

              <div class="row">
                <div class="col-lg-6"><img id="pic" src="/storage/images/applicants/default.png" class="img-fluid"></div>
                <div class="col-lg-6">
                  <h5 class="text-center">My Stats:</h5>
                  <table class="table table-striped table-bordered table-sm text-center">
                      <tbody>
                        <tr>
                          <td> Age: 44</td>
                        </tr>
                        <tr>
                          <td> Weight: 77kg</td>
                        </tr>
                        <tr>
                          <td> Height: 174cm</td>
                        </tr>
                        <tr>
                          <td> Reach 174cm</td>
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

<script>
  $(document).ready(function(){
      $('.bio-view-button').on('click', function(e){

        var url = '/contenders/bio/' + $(this).attr('data-contenderId');

        console.log(url);

        $('#modal-loader').show();

        $.ajax({
          url: url,
          method: 'get',
          dataType: 'json'
        }).done(function(data){
          
          console.log(data);
          $('#first-name').html(data['first_name']);
          $('#last-name').html(data['last_name']);
          $('#nickname').html('\'' + data['nickname'] + '\'');
          // $('#pic').attr('src', data['imagePath']);
          $('#bio-vid').attr('src', 'https://www.youtube.com/embed/y2Ky3Wo37AY?rel=0');
          $('#modal-loader').hide();
        }).fail(function(){
          console.log('failed');
          $('#dynamic-content').html('<p style="color:black;">Something went wrong. Please try again...</p>');
          $('#modal-loader').hide();
        });
      });
    });

</script>

<!-- Subscriber Section -->
{{-- <section class="text-center" id="subscriber-section">

  <div class="container my-5">
    <h1 class="mb-3">Fight for Kidz Newsletter!</h1>
    @include('layouts.messages')
    <form method="post" action="{{route('subscribe')}}" class="justify-content-center">
      <div class="row">
        <div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for="name">Your Name</label>
            <input type="text" name="name" id="name" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6 col-sm-12">
          <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" required>
          </div>
        </div>

        <div class="col-md-6 offset-md-3">
          <button class="btn btn-danger btn-block " id="subscribeBtn" type="submit"><i class="fas fa-user-plus"></i>
            Sign Up</button>
          {!! app('captcha')->render(); !!}
        </div>
      </div>
      @csrf
    </form>
  </div>
</section> --}}

</div>
@endsection