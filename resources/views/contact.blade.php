@extends('layouts.app')

@section('content')

	@include('layouts.messages')

  	<div class="container conform">	

    	<div class="mt-5 mb-5" style="padding: 20px 40px;">
			<h1 class="text-white text-center mb-4">Contact Us</h1>
			<!-- Select Message Type -->
			
			<!-- Normal contact us form -->
			<div id="generalMessage">
				<h3 class="text-center">General Message</h3>
				<p class="text-center my-4">Please send us a message and we will get back to you as soon as we can.</p>
				<small>* Denotes a required field.</small>
				<form action="{{route('contact.general')}}" method="POST">
					<div class="row">
						<div class="form-group col-md-6">
							<input id="gen_name" name="name" type="text" class="form-control" placeholder="* Your name" required>
						</div>
						<div class="form-group col-md-6">
							<input id="gen_email" name="email" type="email" class="form-control" placeholder="* Your email address" required>
						</div>
					</div>
					<div class="form-group">
						<input id="gen_phone" name="phone" type="text" class="form-control" placeholder="* Phone number" required>
					</div>
					<div class="form-group">
						<label for="gen_message" class="text-white">* Your message:</label>
						<textarea id="gen_message" class="form-control" name="message" rows="5" required></textarea>
					</div>
					<label for="subscribeCheckbox">
						<input class="d-inline-block align-middle" type="checkbox" name="subscribeCheckbox" id="subscribeCheckbox" checked>I would like to receive Fight for Kidz updates via email
					</label>
					<button type="submit" class="btn btn-primary mt-2 d-block mx-auto">Send Message</button>
					@csrf
					{!! app('captcha')->render(); !!}
				</form>
			</div>
			<!-- End Normal contact us form -->
			
		</div>
		<!-- End Table contact us form -->			
	</div>
@endsection