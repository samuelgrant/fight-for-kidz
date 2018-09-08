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

    <!-- About Section -->
    <section id="about" class="about-section">
      <div class="container">
        <h1 class="text-white text-center mb-5">About Us</h1>
        <div class="row mb-5">
          <div class="col-lg-7">
            <h4 class="bar text-left text-white">Our Vision</h4>
            <div class="mt-lg-5">
              <p class="text-white-50 text-justify">Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae deserunt ab cupiditate quidem qui voluptates dolores
                quo veniam tempora neque sapiente libero ullam, excepturi culpa quibusdam non tempore! Quis, consequatur. Lorem
                ipsum dolor sit amet consectetur adipisicing elit. Repellendus maxime ducimus nulla veritatis quia aliquam
                vel architecto amet doloribus laudantium neque ipsum nemo, accusantium cupiditate et. Tempora eaque hic perspiciatis!
              </p>
            </div>
          </div>
          <div class="col-lg-2"></div>
          <div class="col-lg-3 text-white text-right results">
            <h4 class="bar">Our Results - 2017</h4>
            <p class="all-caps">Contenders</p>
            <p class="stat">12</p>
            <p class="all-caps">Funds Raised</p>
            <p class="stat">$212,000</p>
            <p class="all-caps">Charities Supported</p>
            <p class="stat">CharityOne, CharityTwo</p>
          </div>
        </div>
        <img src="img/troopers-memorial2.png" class="img-fluid mb-5" />
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
          </div>
        </div>
  
      {!!Form::close() !!}
    </div>

    <div class="alert">
      @include('layouts.messages')
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
