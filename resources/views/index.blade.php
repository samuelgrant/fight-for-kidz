@extends('layouts.app')

@section('content')
  	<!-- Header -->
  	<header class="masthead">
		<div class="container d-flex h-100 align-items-center">
      		<div class="mx-auto text-center">
        		<div>
         			<img src="{{App\Event::current()->isFutureEvent() ? '/storage/images/f4k_logo.png' : '/storage/images/f4k_logo_nodate.png'}}" class="img-fluid">
        		</div>  
        		<div class="text-white-50 mx-auto mt-5 mb-5">
            		<a class="btn btn-danger" href="#about">About Us</a>
            		<a class="btn btn-primary bg-blue" href="{{route('event', str_replace(' ','-', App\Event::current()->name))}}">{{App\Event::current()->name}}</a>
        		</div>
      		</div>
    	</div>
  	</header>
  	<!-- Upcoming event -->
	<div style="background-color: black;">
    	<section id="about" class="upcoming-section">
			<div class="container">
				<div class="row mb-5 pb-5 d-flex">
					<div class="col-lg-12 col-ms-12 col-sm-12">
						<h1 class="text-white underline bar">About</h1>
						<p class="text-justify">
							Fight for Kidz is a charity boxing event held in Southland every year to help raise funds for our most vunerable children.
							Since 2003 boxers have gone head to head in xx events raising money for various charities rasing a total of $xxx,xxx.
						</p>
					</div>
					<div class="col-lg-8 col-md-6 col-col-sm-12">
						<img src="storage/images/mainPagePhoto.jpg" class="img-fluid" alt="Fight for Kidz 2016 cheque">
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12" style="background-color: lightgray;">
						<div id="fb-root"></div>
							<div class="fb-page" data-href="https://www.facebook.com/fightforkidz" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
								<blockquote cite="https://www.facebook.com/fightforkidz" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/fightforkidz">Fight For Kidz</a></blockquote>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</section>
		<!-- Subscriber Section -->
		<section class="text-center" id="subscriber-section">
	  
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
							<button class="btn btn-success btn-block " id="subscribeBtn" type="submit"><i class="far fa-newspaper"></i> Sign up for updates</button>
							{!! app('captcha')->render(); !!}      
						</div>
					</div>
					@csrf
				</form>
		  	</div>
		</section>
  	</div>
@endsection