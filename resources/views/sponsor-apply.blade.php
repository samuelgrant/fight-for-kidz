@extends('layouts.app') 
@section('content')
<div class="container conform" id="application-form">
  <div class="push-down p-3">
    <h1 class="text-center my-3">Application Form - Contenders</h1>
    <p class="text-center">Thank you for your interest in becoming a Fight for Kidz contender.</p>
    <p class="text-center mb-5">Before applying, please familiarize yourself with the
      <a class="" href="#">
        <u>Applicant Guidelines</u></a>.</p>
    <form id="application-form">
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
              <input class="form-control" type="text" name="first_name">
            </div>

            <div class="col-md-2 inputLabel">
              <label for="last_name">Last Name:</label>
            </div>
            <div class="col-md-4">
              <input class="form-control" type="text" name="last_name">
            </div>
          </div>
        </div>

        <div class="form-group-margin">
          <div class="row">
            <div class="col-md-2 inputLabel">
              <label for="address_1">Address 1:</label>
            </div>
            <div class="col-md-4">
              <input class="form-control" type="text" name="address_1">   
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
              <input class="form-control" type="text" name="city">
            </div>
          </div>

          <div class="row">
            <div class="col-md-2 inputLabel">
              <label for="post_code">Post Code:</label>
            </div>
            <div class="col-md-4">
              <input class="form-control" type="text" name="post_code">
            </div>
            
            <div class="col-md-2 inputLabel">
              <label for="email">Email:</label>
            </div>
            <div class="col-md-4">
              <input class="form-control" type="text" name="email">
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
                <input class="form-control" type="date" name="dob">
            </div>        

            <div class="col-md-3 inputLabel">
              <label for="height">Height (cm):</label>
            </div>
            <div class="col-md-3">
              <input class="form-control" type="text" name="height">
            </div>

            <div class="col-md-3 inputLabel">
              <label for="current_weight">Current Weight (kg):</label>
            </div>
            <div class="col-md-3">
              <input class="form-control" type="text" name="current_weight">
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
              <input class="form-control" type="text" name="occupation">
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
                <div><label class="radio-selector"><input type="radio" name="gender" value="male">Male</label></div>
                <div><label class="radio-selector"><input type="radio" name="gender" value="female">Female</label></div>
              </div>
            </div>
            <div class="col-md-6">
              <p>Are you:</p>
              <div class="radio form-group">
                <div><label class="radio-selector"><input type="radio" name="hand" value="left">Left-handed</label></div>
                <div><label class="radio-selector"><input type="radio" name="hand" value="right">Right-handed</label></div>
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
            <label class="radio-selector"><input type="radio" name="sponsorRadio">Yes</label>
            <label class="radio-selector"><input type="radio" name="sponsorRadio">No</label>
          </div>
        </div>

        <!-- Photo upload -->

        <div class="form-group">
          <label for="upload">Please upload a recent photo of yourself:</label>
          <br>
          <input type="file" class="form-control-file" name="photo">
        </div>
      </div>


      <div class="form-section">
        <h3>Sporting Experience</h3>
        <hr class="mb-4">
        <!-- Previous boxing experience -->

        <div class="form-group">
          <p class="">Have you ever done boxing/kickboxing fitness?</p>
          <div class="radio ">
            <label class="radio-selector"><input type="radio" name="expRadio" value="yes" onclick="showexperience()">Yes</label>
            <label class="radio-selector"><input type="radio" name="expRadio" value="false" onclick="hideExperience()">No</label>
          </div>
        </div>
        <div id="exeperience" class="form-group" style="display: none;">
          <textarea id="experience" class="form-control" rows="3" placeholder="Please describe any prior boxing/kickboxing experience..."></textarea>
        </div>

        <!-- All sporting experience -->

        <div class="form-group">
          <label for="summary" class="">Other sporting experience:</label>
          <textarea id="summary" name="sporting_experience" class="form-control" placeholder="Please describe any other sporting experience you have..."
            rows="3"></textarea>
        </div>
      </div>

      <!-- Criminal/legal Questions -->

      <div class="form-section">
        <h3>Additional Information</h3>
        <hr class="mb-4">
        <div class="form-group" id="additional_information">
          <p class="">Do you have any criminal convictions or are facing charges?</p>
          <div class="radio ">
            <label class="radio-selector"><input type="radio" name="convictedRadio" onclick="showcriminal()">Yes</label>
            <label class="radio-selector"><input type="radio" name="convictedRadio" onclick="hidecriminal()">No</label>
          </div>
        
        <div id="criminal" class="form-group" style="display: none;">
          <textarea id="convictions" name="conviction_details" class="form-control" rows="3" placeholder="Please explain..."></textarea>
        </div>
          
          <br>
          <p class="">Are you happy to take a drug screening test?</p>
          <div class="radio">
            <label class="radio-selector"><input type="radio" name="crimeRadio">Yes</label>
            <label class="radio-selector"><input type="radio" name="crimeRadio">No</label>
          </div>
        </div>

        <hr class="mb-4">

        <div class="form-group text-center">
          <input type="checkbox" name="guidelinesCheckbox" id="guidelinesCheckbox">
          <label for="guidelinesCheckbox">I have read and agree to the <a href="#" target="_blank"><u>Applicant Guidelines</u></a></label>
        </div>
      </div>

      <div class="text-center">
        <input type="submit" role="button" class="btn btn-danger mt-2" value="Submit Application">
        {!! app('captcha')->render(); !!}
      </div>
    </form>
  </div>
</div>
@endsection