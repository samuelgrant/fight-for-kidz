@extends('layouts.app')

@section('content')
  <!-- Header -->
  <header class="masthead">
    <div class="container d-flex h-100 align-items-center">
      <div class="mx-auto text-center">
        <img src="img/f4k.png" class="img-fluid" />
        <h2 class="text-white-50 mx-auto mt-5 mb-5">Fight For Kidz is a charity boxing event held in Southland to raise money for Southland kidz charities.</h2>
      </div>
    </div>
  </header>

  <!-- Upcoming event -->
  <div style="background-color: black;">
    <section class="upcoming-section">
      <div class="container">
        <h1 class="text-white">Fight for Kidz 2018</h1>
        <p class="text-white mb-0">Join us on April 28th 2018 for the next Fight For Kids!</p>
      </div>
    </section>

  <!-- Subscriber Section -->
  <section class="text-center" id="subscriber-section">

    <div class="container my-5">
      <h1 class="mb-3">Fight For Kidz Newsletter!</h1>
      {!!Form::open(['action' =>'SubscribersController@store', 'class' =>'form-inline justify-content-center']) !!} 
    
        <div class="row">
          
          <div class="col-md-1 inputLabel"> 
            {{Form::label('name', 'Name:', ['class' => 'mr-3'])}}
          </div>
          <div class="col-md-4">
            {{Form::text('name', '', ['class' => 'form-control mr-3'])}}
          </div>

          <div class="col-md-1 inputLabel">
            {{Form::label('email', 'Email:', ['class' => 'mr-3'])}}
          </div>
          <div class="col-md-4">
            {{Form::text('email', '', ['class' => 'form-control mr-3 mb-4'])}}
          </div>

          <div class="col-md-2">         
            <button class="btn btn-danger form-control" id="subscribeBtn" type="submit"><i class="fas fa-user-plus"></i> Sign Up!</button>
            {!! app('captcha')->render(); !!}      
          </div>
        </div>
  
      {!!Form::close() !!}
    </div>

      @include('layouts.messages')
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
