@extends('layouts.app') 
@section('content')

@include('layouts.messages')

<div class="container conform" id="application-form">
	<div class="mt-3 p-3">
		<h1 class="text-center my-3">Fighter Application - {{App\Event::current()->name}}</h1>
		<p class="text-center">Thank you for your interest in becoming a Fight for Kidz contender.</p>
		<form id="application-form" method="POST" action="{{route('application.fight.submit')}}" enctype="multipart/form-data">
			<div class="form-section">

				<!-- Contact Information -->
				<h3>Contact Information</h3>
				<hr class="mb-4">
				<div class="form-group-margin">
					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="first_name">First Name:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="first_name" required>
						</div>

						<div class="col-md-2 inputLabel">
							<label for="last_name">Last Name:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="last_name" required>
						</div>
					</div>
				</div>

				<div class="form-group-margin">
					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="address_1">Address 1:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="address_1" required>
						</div>


						<div class="col-md-2 inputLabel">
							<label for="address_2">Address 2:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="address_2">
						</div>
					</div>

					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="suburb">Suburb:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="suburb">
						</div>

						<div class="col-md-2 inputLabel">
							<label for="city">City:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="city" required>
						</div>
					</div>

					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="post_code">Post Code:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="post_code" required>
						</div>

						<div class="col-md-2 inputLabel">
							<label for="email">Email:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="email" required>
						</div>
					</div>
				</div>

				<div class="form-group-margin">
					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="phone">Phone:</label>
						</div>
						<div class="col-md-4" id="phoneInput">
							<input class="form-control" type="text" name="phone">
						</div>

						<div class="col-md-2 inputLabel">
							<label for="mobile">Mobile:</label>
						</div>
						<div class="col-md-4" id="mobileInput">
							<input class="form-control" type="text" name="mobile">
						</div>
					</div>
				</div>
			</div>

			<!-- Personal Details -->
			<div class="form-section">
				<h3>Personal Details</h3>
				<hr class="mb-4">
				<div class="form-group-margin">
					<div class="row">
						<div class="col-md-3 inputLabel">
							<label for="dob">Date of Birth:</label>
						</div>
						<div class="col-md-3 input-group date" id="datepicker">
							<input class="form-control" type="date" name="dob" required>
						</div>

						<div class="col-md-3 inputLabel">
							<label for="height">Height (cm):</label>
						</div>
						<div class="col-md-3">
							<input class="form-control" type="text" name="height" required>
						</div>

						<div class="col-md-3 inputLabel">
							<label for="current_weight">Current Weight (kg):</label>
						</div>
						<div class="col-md-3">
							<input class="form-control" type="text" name="current_weight" required>
						</div>

						<div class="col-md-3 inputLabel">
							<label for="expected_weight">Expected Weight (kg):</label>
						</div>
						<div class="col-md-3">
							<input class="form-control" type="text" name="expected_weight">
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-3 inputLabel">
							<label for="occupation">Occupation:</label>
						</div>
						<div class="col-md-3">
							<input class="form-control" type="text" name="occupation" required>
						</div>

						<div class="col-md-3 inputLabel">
							<label for="employer">Employer:</label>
						</div>
						<div class="col-md-3">
							<input class="form-control" type="text" name="employer">
						</div>
					</div>
				</div>

				<!-- Gender and handedness -->

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<p class="">Are you:</p>
							<div class="radio form-group">
								<div><label class="radio-selector"><input type="radio" name="gender" value="male" required>Male</label></div>
								<div><label class="radio-selector"><input type="radio" name="gender" value="female" required>Female</label></div>
							</div>
						</div>
						<div class="col-md-6">
							<p>Are you:</p>
							<div class="radio form-group">
								<div><label class="radio-selector"><input type="radio" name="hand" value="left" required>Left-handed</label></div>
								<div><label class="radio-selector"><input type="radio" name="hand" value="right" required>Right-handed</label></div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-group">
					<div class="row">
						<div class="col-md-6">
							<label for="nickname">Preferred fight name:</label>
							<input type="text" id="nickname" name="nickname" class="form-control" placeholder="(leave blank if undecided)">
						</div>
					</div>
				</div>

				<div class="form-group">
					<p class="">Can you secure your own sponsor? (not a condition of entry)</p>
					<div class="radio">
						<label class="radio-selector"><input type="radio" name="sponsorRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="sponsorRadio" value="no" required>No</label>
					</div>
				</div>

				<!-- Photo upload -->

				<div class="form-group">
					<label for="upload">Please upload a recent photo of yourself:</label>
					<br>
					<input type="file" class="form-control-file" name="photo" required>
				</div>
			</div>


			<div class="form-section">
				<h3>Sporting Experience</h3>
				<hr class="mb-4">
				{{-- Fitness rating --}}
				<div class="form-group">
					<p class="">How would you rate you fitness levels</p>
					<div class="radio ">
						Poor &nbsp;
						<label class="radio-selector"><input type="radio" name="fitness_rating" value="1" required>1</label>
						<label class="radio-selector"><input type="radio" name="fitness_rating" value="2" required>2</label>
						<label class="radio-selector"><input type="radio" name="fitness_rating" value="3" required>3</label>
						<label class="radio-selector"><input type="radio" name="fitness_rating" value="4" required>4</label>
						<label class="radio-selector"><input type="radio" name="fitness_rating" value="5" required>5</label>
						Excellent
					</div>
				</div>

				<!-- Previous boxing experience -->

				<div class="form-group">
					<p class="">Have you ever done boxing/kickboxing/martial arts?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="expRadio" value="yes" onclick="showexperience()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="expRadio" value="no" onclick="hideExperience()" required>No</label>
					</div>
				</div>
				<div id="exeperience" class="form-group" style="display: none;">
					<textarea id="experience" name="fighting_experience" class="form-control" rows="3" placeholder="Please describe any prior boxing/kickboxing/martial arts experience..."></textarea>
				</div>

				<!-- All sporting experience -->

				<div class="form-group">
					<label for="summary" class="">Other sporting experience:</label>
					<textarea id="summary" name="sporting_experience" class="form-control" placeholder="Please describe any other sporting experience you have..."
					 rows="3" required></textarea>
				</div>

				<!-- Hobbies / interests -->

				<div class="form-group">
					<label for="summary" class="">Hobbies/interests:</label>
					<textarea id="summary" name="hobbies" class="form-control" placeholder="Please describe any other hobbies/interests you have..."
					 rows="3" required></textarea>
				</div>

			</div>

			<!-- Criminal/legal Questions + custom questions -->

			<div class="form-section">
				<h3>Additional Information</h3>
				<hr class="mb-4">

				{{-- Custom questions here --}}

				<?php
					global $q; // counter for question numbering					
				?>

				@foreach(App\Event::current()->customQuestions as $question)

					<div class="form-group">

						@if($question->type == 'Text')

						<label for="custom_{{++$q}}">{{$question->text}}</label>
						<textarea class="form-control" type="text" maxlength="500" name="custom_{{$q}}" id="custom_{{$q}}" rows="3" {{$question->required ? 'required' : ''}}></textarea>

						@elseif($question->type == "Yes/No")

						<p>{{$question->text}}</p>
						<div class="radio ">
							<label class="radio-selector"><input type="radio" name="custom_{{++$q}}" value="Yes" {{$question->required ? 'required' : ''}}>Yes</label>
							<label class="radio-selector"><input type="radio" name="custom_{{$q}}" value="No" {{$question->required ? 'required' : ''}}>No</label>
						</div>

						@endif

					</div> 

				@endforeach

				{{-- End of custom questions --}}

				<div class="form-group" id="additional_information">
					<p class="">Do you have any criminal convictions or are facing charges?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="convictedRadio" value="yes" onclick="showcriminal()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="convictedRadio" value="no" onclick="hidecriminal()" required>No</label>
					</div>

					<div id="criminal" class="form-group" style="display: none;">
						<textarea id="convictions" name="conviction_details" class="form-control" rows="3" placeholder="Please explain..."></textarea>
					</div>

					<br>
					<p class="">Are you happy to take a drug screening test?</p>
					<div class="radio">
						<label class="radio-selector"><input type="radio" name="drugRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="drugRadio" value="no" required>No</label>
					</div>
				</div>

				<hr class="mb-4">

				<div class="form-group text-center">
					<label for="subscribeCheckbox">
						<input class="d-inline-block align-middle" type="checkbox" name="subscribeCheckbox" id="subscribeCheckbox" checked>I would like to receive Fight for Kidz updates via email
					</label>
					<label for="guidelinesCheckbox">
            			<input class="d-inline-block align-middle" type="checkbox" name="declCheckbox" id="guidelinesCheckbox" required>I have provided true and accurate information in this application
          			</label>
				</div>
			</div>

			<div class="text-center">
				<input type="submit" role="button" class="btn btn-danger mt-2" value="Submit Application"> {!! app('captcha')->render();
				!!}
			</div>
			@csrf
		</form>
	</div>
</div>
@endsection