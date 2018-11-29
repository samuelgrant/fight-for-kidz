-@extends('layouts.app') 
@section('content')

@include('layouts.messages')

<div class="container conform" id="application-form">
	<div class="mt-3 p-3">
		<h1 class="text-center my-3">Fighter Application - {{App\Event::current()->name}}</h1>
		<p class="text-center">Thank you for your interest in becoming a Fight for Kidz contender.</p>
		@if(App\Document::where('display_location', 'Fighter App')->get()->count() > 0)
			<div class="mb-3">
				<h5>Important Files:</h5>
				@foreach(App\Document::where('display_location', 'Fighter App')->get() as $doc)
				<a class="d-block" href="{{Storage::disk('documents')->url($doc->filename)}}" download="{{$doc->originalName}}">{{$doc->originalName}}</a>
				@endforeach
			</div>
		@endif
		<form id="application-form" method="POST" action="{{route('application.fight.submit')}}" enctype="multipart/form-data">
			<div class="form-section">

{{-- Contact Info Section --}}
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
{{-- End Contact Info Section --}}

{{-- Personal Details Section --}}
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
{{-- End of Persoal Details --}}

{{-- Emergency Contact Section --}}
			<div class="form-section">
				<h3>Emergency Contact</h3>
				<hr class="mb-4">

				<div class="form-group-margin">
					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="emergency_first">First Name:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="emergency_first" required>
						</div>

						<div class="col-md-2 inputLabel">
							<label for="emergency_last">Last Name:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="emergency_last" required>
						</div>
					</div>
					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="emergency_phone">Phone:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="emergency_phone">
						</div>

						<div class="col-md-2 inputLabel">
							<label for="emergency_mobile">Mobile:</label>
						</div>
						<div class="col-md-4">
							<input class="form-control" type="text" name="emergency_mobile">
						</div>
					</div>
				</div>
				<div class="form-group-margin">
					<div class="row">
						<div class="col-md-2 inputLabel">
							<label for="emergency_email">Email:</label>
						</div>
						<div class="col-md-6">
							<input class="form-control" type="text" name="emergency_email">
						</div>
					</div>
				</div>
			</div>
{{-- End Emergency Contact Section --}}

{{-- Sporting Experience Section --}}
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
						<label class="radio-selector"><input type="radio" name="expRadio" value="yes" onclick="showExperience()" required>Yes</label>
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
{{-- End Sporting Section --}}

{{-- Medical Innfo Section --}}
			<div class="form-section">
				<h3>Medical Information</h3>
				<hr class="mb-4">

				<div class="form-group-margin">
					<fieldset style="border: 1px solid;   border-top-left-radius: 15px; border-top-right-radius: 15px;">
						<legend class="ml-3" style="width :200px;">Previous History</legend>
						<h5 class="mt-2 mb-3 ml-3">Do you have a past history of the following?</h5>

						<div class="row px-auto">
							<div class="col-md-4">
								<label class=" pl-3" for="heart_disease">Heart Disease:</label>
								<input class="float-right" type="checkbox" name="heart_disease" required>
							</div>
							<div class="col-md-4">
								<label for="heart_surgery">Heart Surgery:</label>
								<input class="float-right" type="checkbox" name="heart_surgery" required>
							</div>
							<div class="col-md-4">
								<label for="heart_attack">Heart Attack:</label>
								<input class="float-right" type="checkbox" name="heart_attack" required>
							</div>
						</div>
						<div class="row px-auto">
							<div class="col-md-4">
								<label class=" pl-3" for="stroke">Stroke:</label>
								<input class="float-right" type="checkbox" name="stroke" required>
							</div>
							<div class="col-md-4">
									<label for="smoking">Smoking:</label>
									<input class="float-right" type="checkbox" name="smoking" required>
								</div>
							<div class="col-md-4">
								<label for="cancer">Cancer:</label>
								<input class="float-right" type="checkbox" name="cancer" required>
							</div>
						</div>
						<div class="row px-auto">
							<div class="col-md-4">
								<label class="pl-3" for="breathlessness">Breathlessness:</label>
								<input class="float-right" type="checkbox" name="breathlessness" required>
							</div>
							<div class="col-md-4">
								<label for="epilepsy">Epilepsy:</label>
								<input class="float-right" type="checkbox" name="epilepsy" required>
							</div>
							<div class="col-md-4">
								<label for="chest_pain_discomfort">Chest Pain/Discomfort:</label>
								<input class="float-right" type="checkbox" name="chest_pain_discomfort" required>
								</div>
						</div>
						<div class="row px-auto">
							<div class="col-md-4">
								<label class=" pl-3" for="irregular_heartbeat">Irregular Heartbeat:</label>
								<input class="float-right" type="checkbox" name="irregular_heartbeat" required>
							</div>
							<div class="col-md-4">
								<label for="respiratory_problems">Respiratory Problems:</label>
								<input class="float-right" type="checkbox" name="respiratory_problems" required>
							</div>
							<div class="col-md-4">
								<label for="joint_pain_problems">Joint Pain/Problems:</label>
								<input class="float-right" type="checkbox" name="joint_pain_problems" required>
							</div>
						</div>
						<div class="row px-auto">
							<div class="col-md-4">
								<label class="pl-3" for="surgery">Surgery:</label>
								<input class="float-right" type="checkbox" name="surgery" required>
							</div>
							<div class="col-md-4">
								<label for="dizziness_fainting">Dizziness or Fainting:</label>
								<input class="float-right" type="checkbox" name="dizziness_fainting" required>
							</div>
							<div class="col-md-4">
								<label for="high_cholesterol">High Cholesterol (>240):</label>
								<input class="float-right" type="checkbox" name="high_cholesterol" required>
							</div>
						</div>
						<div class="row px-auto">
							<div class="col-md-4">
								<label class=" pl-3" for="hypertension">Hypertension (>140/90):</label>
								<input class="float-right" type="checkbox" name="hypertension" required>
							</div>
							<div class="col-md-4">
								<label for="heart_disease">Other:</label>
								<input class="float-right" id="otherCheck" type="checkbox" name="heart_disease" onclick="showOther()" required>
							</div>
						</div> 
						<div class="row px-auto">
							<div id="other" class="form-group" style="display: none;">
								<textarea id="other_info" name="other_details" class="form-control ml-4 mt-3" rows="3"  cols="93" placeholder="Please explain..."></textarea>
							</div>
						</div>
					</fieldset>
				</div>

				<div class="form-group">
					<p class="">Have you ever had any hand injuries?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="handRadio" value="yes" onclick="showHand()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="handRadio" value="no" onclick="hideHand()" required>No</label>
					</div>

					<div id="hand" class="form-group" style="display: none;">
						<textarea id="handInjury" name="hand_details" class="form-control" rows="3" placeholder="Please explain..."></textarea>
					</div>
					<br>

					<p class="">Have you ever had any injuries (expecially head injuries)?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="injuryRadio" value="yes" onclick="showInjury()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="injurydRadio" value="no" onclick="hideInjury()" required>No</label>
					</div>

					<div id="injury" class="form-group" style="display: none;">
						<textarea id="injuries" name="injury_details" class="form-control" rows="3" placeholder="Please explain..."></textarea>
					</div>
					<br>

					<p class="">Are you currently taking any medications?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="medsRadio" value="yes" onclick="showMeds()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="medsRadio" value="no" onclick="hideMeds()" required>No</label>
					</div>

					<div id="meds" class="form-group" style="display: none;">
						<textarea id="medication" name="meds_details" class="form-control" rows="3" placeholder="Please list medication as well as the reasons for taking..."></textarea>
					</div>
					<br>
				</div>

				<div class="form-group">
					<h5><i>Please read the following eight questions carefully and answer each one honestly.</i></h5>
					<br>

					<p class="">1. Has a physician ever said that you have a heart condition and recommended only medically supervised activity?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="heartRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="heartRadio" value="no" required>No</label>
					</div>
					<p class="">2. Do you have chest pain that’s brought on by physical activity? </p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="activityRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="activityRadio" value="no" required>No</label>
					</div>
					<p class="">3. Have you developed chest pain in the past month? </p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="monthRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="monthRadio" value="no" required>No</label>
					</div>
					<p class="">4. Have you on one or more occasions lost consciousness or fallen over as a result of dizziness?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="consciousnessRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="consciousnessRadio" value="no" required>No</label>
					</div>
					<p class="">5. Do you have a bone or joint problem that could be aggravated by the proposed physical activity?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="boneRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="boneRadio" value="no" required>No</label>
					</div>
					<p class="">6. Has a physician ever recommended medication for your blood pressure or a heart condition?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="bloodRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="bloodRadio" value="no" required>No</label>
					</div>
					<p class="">7. Have you ever been knocked out or concussed?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="concussedRadio" value="yes" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="concussedRadio" value="no" required>No</label>
					</div>
					<p class="">8. Are you aware, through your own experience or a physician’s advice, of any other reason that would prohibit you from exercising without medical supervision?</p>
					<div class="radio ">
						<label class="radio-selector"><input type="radio" name="reasonsRadio" value="yes" onclick="showReason()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="reasonsRadio" value="no" onclick="hideReason()" required>No</label>
					</div>

					<div id="reason" class="form-group" style="display: none;">
						<textarea id="reasons" name="reason_details" class="form-control" rows="3" placeholder="Please explain..."></textarea>
					</div>

					<br>
					<h5><i>If you answered “yes” to any of these eight questions you should consult your Physician before participation in any physical training can begin.</i></h5>
				</div>
			</div>
{{-- End Medical Info Section --}}

{{-- Additional Info Section --}}
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
						<label class="radio-selector"><input type="radio" name="convictedRadio" value="yes" onclick="showCriminal()" required>Yes</label>
						<label class="radio-selector"><input type="radio" name="convictedRadio" value="no" onclick="hideCriminal()" required>No</label>
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
{{--End Additonal Information Section --}}

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