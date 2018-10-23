@extends('layouts.app')

@section('content')
  	<!-- Header -->
  	<header class="masthead">
		<div class="container d-flex h-100 align-items-center">
      		<div class="mx-auto text-center">
        		<div>
         			<img src="/storage/images/f4k_logo.png?{{filemtime($_SERVER["DOCUMENT_ROOT"].'/storage/images/f4k_logo.png')}}" class="img-fluid">
        		</div>  
        		<div class="text-white-50 mx-auto mt-5 mb-5">
            		<a class="bout-btn bout-btn-red" href="#about">About Us</a>
            		<a class="bout-btn bout-btn-blue" href="{{route('event', App\Event::current()->id)}}">{{App\Event::current()->name}}</a>
        		</div>
      		</div>
    	</div>
  	</header>
  	<!-- Upcoming event -->
	<div style="background-color: black;">
    	<section id="about" class="upcoming-section">
			<div class="container">
				<div class="row mb-5">
					<div class="col-lg-12 col-ms-12 col-sm-12">
						<h1 class="text-white underline bar">About</h1>
						<p class="text-justify">
							Fight for Kidz is a charity boxing event held in Southland every year to help raise funds for our most vunerable children.
							Since 2003 boxers have gone head to head in xx events  raising money for verious charities rasing a total of $xxx,xxx.
						</p>

						<p class="texr-justify">
							Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae deserunt ab cupiditate quidem qui voluptates dolores quo veniam tempora neque sapiente libero ullam, 
							excepturi culpa quibusdam non tempore! Quis, consequatur. Lorem ipsum dolor sit amet consectetur adipisicing elit. Repellendus maxime ducimus nulla veritatis quia aliquam vel architecto amet doloribus laudantium neque ipsum nemo, accusantium cupiditate et. Tempora eaque hic perspiciatis!
						</p>
					</div>
					<div class="col-lg-8 col-md-6 col-col-sm-12 py-5">
						<img src="storage/images/2016Cheque.jpg" class="img-fluid" alt="Fight for Kidz 2016 cheque">
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 mt-5 pb-4">
						<div id="fb-root"></div>
							<div class="fb-page" data-href="https://www.facebook.com/fightforkidz" data-tabs="timeline" data-small-header="true" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
								<blockquote cite="https://www.facebook.com/fightforkidz" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/fightforkidz">Fight For Kidz</a></blockquote>
							</div>
						</div>
					</div>
				</div> 
			</div>
		</section>
		<section id="contact">
			<div class="container conform">
				<div class="push-down mt-0" style="padding: 20px 40px;">
					<h1 class="text-white text-center">Contact Us</h1>
					<p class="text-white text-center mb-5">Please feel free to contact us and we will get back to you as soon as possible.</p>
					<form>
						<div class="row">
							<div class="form-group col-md-6">
								<input id="name" type="text" class="form-control" placeholder="Your name">
							</div>
							<div class="form-group col-md-6">
								<input id="name" type="text" class="form-control" placeholder="Your email address">
							</div>
						</div>
						<div class="form-group">
							<input id="name" type="text" class="form-control" placeholder="Phone number">
						</div>
						<div class="form-group">
							<label for="message" class="text-white">Your message:</label>
							<textarea id="message" class="form-control" rows="5"></textarea>
						</div>
						<div class="text-center">
							<input type="submit" role="button" class="btn btn-primary mt-2" value="Send Message">
						</div>
					</form>
				</div>
			</div>
		</section>
  	</div>
@endsection