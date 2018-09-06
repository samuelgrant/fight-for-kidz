@extends('layouts.app') @section('content')
<div class="container conform" id="application-form">
  <div class="push-down p-3">
    <h1 class="text-center my-3">Application Form - Contenders</h1>
    <p class="text-center">Thank you for your interest in becoming a Fight For Kidz contender.</p>
    <p class="text-center mb-5">Before applying, please familiarize yourself with the
      <a class="" href="#">
        <u>Applicant Guidelines</u></a>.</p>
    <form id="application-form">
      <div class="form-section">
        <h3>Contact Information</h3>
        <hr>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"><input class="form-control" type="text" name="first_name" placeholder="First Name(s)"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="last_name" placeholder="Last Name"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"><input class="form-control" type="text" name="address_1" placeholder="Address line 1"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="address_2" placeholder="Adress line 2 (optional)"></div>
          </div>
          <div class="row">
            <div class="col-sm-6"><input class="form-control" type="text" name="suburb" placeholder="Suburb (optional)"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="city" placeholder="City"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"><input class="form-control" type="text" name="email" placeholder="Email address"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="phone" placeholder="Phone"></div>
          </div>
          <div class="row">
            <div class="col-sm-6"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="mobile" placeholder="Mobile"></div>
          </div>
        </div>
      </div>

      <div class="form-section">
        <h3>Personal Details</h3>
        <hr>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"><input class="form-control" type="date" name="dob" placeholder="Date of birth"></div> <!-- Replace with nicer date picker -->
            <div class="col-sm-6"><input class="form-control" type="text" name="height" placeholder="Height (cm)"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="current_weight" placeholder="Current weight (kg)"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="expected_weight" placeholder="Target weight (kg)"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="row">
            <div class="col-sm-6"><input class="form-control" type="text" name="occupation" placeholder="Occupation"></div>
            <div class="col-sm-6"><input class="form-control" type="text" name="employer" placeholder="Current Employer (if employed)"></div>
          </div>
        </div>

        <!-- Left or right handedness -->

        <div class="form-group">
          <p class="">Are you left or right handed?</p>
          <div class="radio ">
            <label class="radio-selector"><input type="radio" name="hand" value="left">Left</label>
            <label class="radio-selector"><input type="radio" name="hand" value="right">Right</label>
          </div>
        </div>

        <div class="form-group">
          <div class="row">
            <div class="col-sm-6">
              <p class="">Preferred boxing nickname:</p>
              <input type="text" class="form-control" placeholder="(leave blank if undecided)">
            </div>
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
        <hr>
        <!-- Previous boxing experience -->

        <div class="form-group">
          <p class="">Have you ever done boxing/kickboxing fitness?</p>
          <div class="radio ">
            <label class="radio-selector"><input type="radio" name="expRadio" value="yes" onclick="showexperience()">Yes</label>
            <label class="radio-selector"><input type="radio" name="expRadio" value="false" onclick="hideExperience()">No</label>
          </div>
        </div>
        <div id="exeperience" class="form-group" style="display: none;">
          <textarea id="experience" class="form-control" rows="2" placeholder="Please describe any prior boxing/kickboxing experience..."></textarea>
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
        <hr>
        <div class="form-group">
          <p class="">Do you have any criminal convictions or are facing charges?</p>
          <div class="radio ">
            <label class="radio-selector"><input type="radio" name="convictedRadio" onclick="showcriminal()">Yes</label>
            <label class="radio-selector"><input type="radio" name="convictedRadio" onclick="hidecriminal()">No</label>
          </div>
        </div>
        <div id="criminal" class="form-group" style="display: none;">
          <textarea id="convictions" name="conviction_details" class="form-control" rows="2" placeholder="Please explain..."></textarea>
        </div>

        <div class="form-group">
          <p class="">Are you happy to take a drug screening test?</p>
          <div class="radio">
            <label class="radio-selector"><input type="radio" name="crimeRadio">Yes</label>
            <label class="radio-selector"><input type="radio" name="crimeRadio">No</label>
          </div>
        </div>

        <div class="form-group">
          <input type="checkbox" name="guidelinesCheckbox" id="guidelinesCheckbox">
          <label for="guidelinesCheckbox">I have read and agree to the <a href="#" target="_blank"><u>Applicant Guidelines</u></a></label>
        </div>
      </div>

      <div class="text-center">
        <input type="submit" role="button" class="btn btn-danger mt-2" value="Submit Application">
      </div>
    </form>
  </div>
</div>
@endsection