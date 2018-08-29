@extends('layouts.app')

@section('content')
  <div class="container" id="application-form" style="max-width: 900px;">
    <div class="push-down">
      <h1 class="text-white text-center">Application Form - Contenders</h1>
      <p class="text-white text-center">Use this form to apply to fight in the next Fight For Kidz event</p>
      <p class="text-white text-center mb-5">Before applying, please familiarize yourself with the
        <a class="text-white" href="#">
          <u>Applicant Guidelines</u></a>.</p>
      <form>
        <div class="row">
          <div class="form-group col-md-6">
            <input id="name" type="text" class="form-control" placeholder="Your name">
          </div>
          <div class="form-group col-md-6">
            <input id="email" type="text" class="form-control" placeholder="Your email address">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <input id="Address" type="text" class="form-control" placeholder="Address">
          </div>
          <div class="form-group col-md-6">
            <input id="dob" type="text" class="form-control" placeholder="Date of birth">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <input id="Phone" type="text" class="form-control" placeholder="Phone">
          </div>
          <div class="form-group col-md-6">
            <input id="Moblie" type="text" class="form-control" placeholder="Mobile">
          </div>
        </div>
        <div class="row">
          <div class="form-group col-md-6">
            <input id="Weight" type="text" class="form-control" placeholder="Weight">
          </div>
          <div class="form-group col-md-6">
            <input id="Height" type="text" class="form-control" placeholder="Height">
          </div>
        </div>
        <div class="form-group">
          <p class="text-white">Are you left handed or right?</p>
          <div class="radio text-white">
            <label>
              <input type="radio" class="radio" name="expRadio">Yes</label>
            <label>
              <input type="radio" class="radio" name="expRadio">No</label>
          </div>
        </div>
        <div class="form-group">
          <label for="summary" class="text-white">All Sporting Experience:</label>
          <textarea id="summary" class="form-control" rows="2"></textarea>
        </div>
        <div class="form-group">
          <p class="text-white">Do you have previous boxing experience?</p>
          <div class="radio text-white">
            <label>
              <input type="radio" class="radio" name="expRadio">Yes</label>
            <label>
              <input type="radio" class="radio" name="expRadio">No</label>
          </div>
        </div>
        <div class="form-group">
          <label for="experience" class="text-white">Please describe your boxing experience:</label>
          <textarea id="experience" class="form-control" rows="2"></textarea>
        </div>
        <div class="form-group">
          <p class="text-white">do you have any crimal convictions?</p>
          <div class="radio text-white">
            <label>
              <input type="radio" class="radio" name="expRadio">Yes</label>
            <label>
              <input type="radio" class="radio" name="expRadio">No</label>
          </div>
        </div>
        <div class="form-group">
          <label for="experience" class="text-white">Please list/describe your crimes:</label>
          <textarea id="experience" class="form-control" rows="2"></textarea>
        </div>
        <div class="form-group text-white">
          <label for="upload" class="text-white">Please upload your photo:</label>
          <br>
          <input type="file" class="file">
        </div>
        <div class="text-center">
          <input type="submit" role="button" class="btn btn-primary mt-2" value="Submit Application">
        </div>
      </form>
    </div>
  </div>
@endsection