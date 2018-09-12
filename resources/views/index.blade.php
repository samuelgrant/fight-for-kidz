@extends('layouts.app')

@section('content')
  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center col-md-12">
        <div class="logoimg col-md-12 ">
          <canvas id="myCanvas"   style=" width: 100%; height: 100%;">
          </canvas>
        </div>  
        <h2 class="text-white-50 mx-auto mt-5 mb-5">Fight For Kidz is a charity boxing event held in Southland to raise money for Southland kidz charities.</h2>
      </div>
    </div>
  </header>
  <script>
    var c = document.getElementById("myCanvas");
    var ctx = c.getContext("2d");
    ctx.font = "40px Arial";
    ctx.fillStyle = "white";
    ctx.fillText(year,10,100);
</script>
  <!-- Upcoming event -->
  <div style="background-color: black;">
    <section class="upcoming-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-lg-8 col-md-6 col-col-sm-12">
            <h1 class="text-white underline bar">Fight for Kidz 2018</h1>
            <p class="text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae deserunt ab cupiditate quidem qui voluptates dolores quo veniam tempora neque sapiente libero ullam, excepturi culpa quibusdam non tempore! Quis, consequatur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maxime ducimus nulla veritatis quia aliquam vel architecto amet doloribus laudantium neque ipsum nemo, accusantium cupiditate et. Tempora eaque hic perspiciatis!</p>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae deserunt ab cupiditate quidem qui voluptates dolores quo veniam tempora neque sapiente libero ullam, excepturi culpa quibusdam non tempore! Quis, consequatur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maxime ducimus nulla veritatis quia aliquam vel architecto amet doloribus laudantium neque ipsum nemo, accusantium cupiditate et. Tempora eaque hic perspiciatis!</p>
            <p>veritatis quia aliquam vel architecto amet doloribus laudantium neque ipsum nemo, accusantium cupiditate et. Tempora eaque hic perspiciatis!</p>
          </div>
          <div class="col-lg-4 col-md-6 col-sm-12 text-white text-right results mt-5">
              <p class="all-caps sidebar-heading">Date</p>
              <p class="stat">Saturday 28<sup>th</sup> April</p>
              <p class="all-caps sidebar-heading">Location</p>
              <p class="stat">ILT Stadium</p>
              <p class="all-caps sidebar-heading">Supporting</p>
                <a class="stat-link" href="https://google.com" style="color: white!important;">
                    <i class="fas fa-link"></i>
                    Koha Kai
                </a>
            </div>
          </div>
        </div>
       <div class="row">
          <div class="col-lg-12 col-md-12 col-col-sm-12">
            <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?q=ILT%20stadium&key=AIzaSyCh5DbSbB0_mE1DZJJfjhbJpkRfROHjgSw" allowfullscreen>
            </iframe>
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

          <div class="col-md-12">         
            <button class="btn btn-danger form-control px-4" id="subscribeBtn" type="submit"><i class="fas fa-user-plus"></i> Sign Up</button>
            {!! app('captcha')->render(); !!}      
          </div>
        </div>
        @csrf
      </form>
    </div>
  </section>

    <!-- Sponsors Section -->
    <section id="sponsors-section">
      <h2 class="text-center">Our Sponsors</h2>
        <div class="row">
          <div class="col-lg-3"><img src="img/customer-1.png" /></div>
          <div class="col-lg-3"><img src="img/customer-2.png" /></div>
          <div class="col-lg-3"><img src="img/customer-3.png" /></div>
          <div class="col-lg-3"><img src="img/customer-4.png" /></div>
        </div>
      </section>    

  </div>
@endsection
