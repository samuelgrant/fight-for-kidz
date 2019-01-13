@extends('layouts.app')

@section('content')
  	<!-- Header -->
  	<header class="masthead">
		<div class="container d-flex h-100 align-items-center">
      		<div class="mx-auto text-center">
        		<div>
					@if(App\Event::current())
						<img src="{{App\Event::current()->isFutureEvent() ? '/storage/images/f4k_logo.png' : '/storage/images/f4k_logo_noyear.png'}}" alt="Fight for Kidz Logo" class="img-fluid">
					@endif
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
		<section id="about" class="upcoming-section pt-5">
			<div class="container-fluid pt-5">
				<div class="container">
					<div class="row mb-5 pb-5 d-flex">
						<div class="col-lg-12 col-ms-12 col-sm-12">
							<h1 class="text-white underline bar">About</h1>
							<p class="text-justify">
								{{$settings->about_us}}
							</p>
							@if(App\Document::where('display_location', 'Home/About Us')->get()->count() > 0)
							<div class="mb-3">
								<h5>Related files:</h5>
								@foreach(App\Document::where('display_location', 'Home/About Us')->get() as $doc)
									<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>
								@endforeach
							</div>
							@endif
						</div>
						<div class="col-lg-8 col-md-6 col-sm-12">
							<img src="storage/images/mainPagePhoto.jpg?{{filemtime(storage_path('app/public/images/mainPagePhoto.jpg'))}}" class="img-fluid" alt="Fight for Kidz 2016 cheque" />
						</div>
						<div class="col-lg-4 col-md-6 d-md-block d-sm-none d-none">
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
		  	<div class="container conform p-3 mt-5">
				<h1 class="mb-3">Fight for Kidz Updates!</h1>
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