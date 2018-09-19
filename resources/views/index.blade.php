@extends('layouts.app')

@section('content')
  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center col-md-12">
        <div class="logoimg col-md-12 ">
          <canvas id="myCanvas" style=" width: 100%; height: 100%">
          </canvas>
        </div>  
        <h2 class="text-white-50 mx-auto mt-5 mb-5">Fight For Kidz is a charity boxing event held in Southland to raise money for Southland kidz charities.</h2>
      </div>
    </div>
  </header>
  <!-- Upcoming event -->
  <div style="background-color: black;">
    <section class="upcoming-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-8 col-md-6 col-col-sm-12">
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
                        var uluru = { {{$event->venue_gps}} };
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
                
                <script async defer
                    src="https://maps.googleapis.com/maps/api/js?key={{env('GOOGLE_MAPS_KEY')}}&callback=initMap">
                </script>
            </div> 
          </div>
        </div>    
      </div>
      <hr>
    </section>

  <!-- Subscriber Section -->
  <section class="text-center" id="subscriber-section">

    <div class="container my-5">
      <h1 class="mb-3">Fight For Kidz Newsletter!</h1>
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
            <button class="btn btn-danger btn-block " id="subscribeBtn" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
            {!! app('captcha')->render(); !!}      
          </div>
        </div>
        @csrf
      </form>
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
  </div>
@endsection
