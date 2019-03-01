@extends('layouts.app')

@section('content')

	@include('layouts.messages')

  	<div class="container conform">	

    	<div class="mt-5 mb-5" style="padding: 20px 40px;">
			<h1 class="text-white text-center">Contact Us</h1>
			<!-- Select Message Type -->
			<div id="messageTypeContainer" class="pb-3">
				<p class="text-white text-center mt-5">Why do you want to get in touch with us?</p>
				<select id="messageType" class="form-control" onchange="toggelForm()">
					<option value="select" {{app('request')->input('option') == null ? 'selected' : null}}>-- Select type of enquiry --</option>
					<option value="general" {{app('request')->input('option') == 'general' ? 'selected' : null}}>General Enquiry</option>
					<option value="sponsor" {{app('request')->input('option') == 'sponsor' ? 'selected' : null}}>Become a Sponsor</option>
					<option value="table" {{app('request')->input('option') == 'table' ? 'selected' : null}}>Table Booking Enquiry</option>
				</select>
			</div>

			<hr />

			<!-- Normal contact us form -->
			<div id="generalMessage" class="hidden">
				<h3 class="text-center">General Message</h3>
				<p class="text-center">Please send us a message and we will get back to you as soon as we can.</p>
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
					<button class="btn btn-primary mt-2 d-block mx-auto">Send Message</button>
					@csrf
					{!! app('captcha')->render(); !!}
				</form>
			</div>
			<!-- End Normal contact us form -->

			<!-- Sponsorship contact us form -->
			<div id="sponsorMessage" class="hidden">
				<h3 class="text-center">Sponsorship Enquiry</h3>
				<p class="text-center">Fill this out, and we will contact our potential sponsors closer to the event.</p>

				{{-- Files for download --}}
				@if(App\Document::where('display_location', 'Sponsor Enquiry')->get()->count() > 0)
					<div class="mb-3 w-100 text-center">
						<h5>Related files:</h5>
						@foreach(App\Document::where('display_location', 'Sponsor Enquiry')->get() as $doc)
						<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>
						@endforeach
					</div>
				@endif

				<small>* Denotes a required field.</small>
				<form action="{{route('contact.sponsor')}}" method="POST">
					<div class="row">
						<div class="form-group col-md-6">
							<input id="spon_name" name="name" type="text" class="form-control" placeholder="* Your name" required>
						</div>
						<div class="form-group col-md-6">
							<input id="companyName" name="companyName" type="text" class="form-control" placeholder="* Company name" required>
						</div>
						<div class="form-group col-md-6">
							<input id="spon_email" name="email" type="email" class="form-control" placeholder="* Your email address" required>
						</div>
					</div>
					<div class="form-group">
						<input id="spon_phone" name="phone" type="text" class="form-control" placeholder="* Phone number" required>
					</div>					
					<div class="form-group">
						<label for="spon_type" class="text-white">* What type/s of sponsorship are you interested in?</label>
						<input id="spon_type" name="type" type="text" class="form-control" required>
					</div>
					<div class="form-group">
						<label for="message" class="text-white">Optional message:</label>
						<textarea id="spon_message" name="message" class="form-control" rows="5"></textarea>
					</div>
					<label for="subscribeCheckbox">
						<input class="d-inline-block align-middle" type="checkbox" name="subscribeCheckbox" id="subscribeCheckbox" checked>I would like to receive Fight for Kidz updates via email
					</label>
					<button class="btn btn-primary mt-2 d-block mx-auto">Send Message</button>
					@csrf
					{!! app('captcha')->render(); !!}
				</form>
			</div>
			<!-- End Sponsorship contact us form -->

			<!-- Table contact us form -->
			<div id="tableMessage" class="hidden">
				<h3 class="text-center">Enquire about Booking a Table </h3>
				<p class="text-center">Fill this out, and we will contact you when we can.</p>

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
					<button class="btn btn-primary mt-2 d-block mx-auto">Send Message</button>
					@csrf
					{!! app('captcha')->render(); !!}
				</form>
			</div>
		</div>
		<!-- End Table contact us form -->			
	</div>
	<script>
		function toggelForm(){
			let selected = $("#messageType").val();

			$("#generalMessage").addClass("hidden");
			$("#sponsorMessage").addClass("hidden");
			$("#tableMessage").addClass("hidden");
			if(selected == "general") {
				$("#generalMessage").removeClass("hidden");
			}

			if(selected == "sponsor") {
				$("#sponsorMessage").removeClass("hidden");
			}
			if(selected == "table") {
				$("#tableMessage").removeClass("hidden");
			}
		}

		$(document).ready(function(){
			// Set the form to display initially
			toggelForm();
		});
	</script>
@endsection