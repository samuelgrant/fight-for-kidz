@extends('layouts.app')

@section('content')

	@include('layouts.messages')

  	<div class="container conform">	

    	<div class="mt-5 mb-5" style="padding: 20px 40px;">
			<h1 class="text-white text-center mb-4">Contact Us</h1>
			<!-- Select Message Type -->

			<!-- Table contact us form -->
			<div id="tableMessage">
				<h3 class="text-center">Enquire about Booking a Table </h3>
				<p class="text-center my-4">Fill this out, and we will contact you when we can.</p>

				{{-- Files for download --}}
				@if(App\Document::where('display_location', 'Table Enquiry')->get()->count() > 0)
					<div class="mb-3 w-100 text-center">
						<h5>Related files:</h5>
						@foreach(App\Document::where('display_location', 'Table Enquiry')->get() as $doc)
						<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>
						@endforeach
					</div>
				@endif

				<small>* Denotes a required field.</small>
				<form action="{{route('contact.table')}}" method="POST">
					<div class="row">
						<div class="form-group col-md-6">
							<input id="tbl_name" name="name" type="text" class="form-control" placeholder="* Your name" required>
						</div>
						<div class="form-group col-md-6">
							<input id="tbl_email" name="email" type="email" class="form-control" placeholder="* Your email address" required>
						</div>
					</div>
					<div class="form-group">
						<input id="tbl_phone" name="phone" type="text" class="form-control" placeholder="* Phone number" required>
					</div>					
					<div class="form-group">
						<label for="tbl_message" class="text-white">Optional message - What type of table are you looking to book?:</label>
						<textarea id="tbl_message" name="message" class="form-control" rows="5"></textarea>
					</div>
					<label for="subscribeCheckbox">
						<input class="d-inline-block align-middle" type="checkbox" name="subscribeCheckbox" id="subscribeCheckbox" checked>I would like to receive Fight for Kidz updates via email
					</label>
					<button type="submit" class="btn btn-primary mt-2 d-block mx-auto">Send Message</button>
					@csrf
					{!! app('captcha')->render(); !!}
				</form>
			</div>
		</div>
		<!-- End Table contact us form -->		


		</div>				
	</div>
@endsection