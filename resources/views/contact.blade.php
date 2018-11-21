@extends('layouts.app')

@section('content')
  <div class="container conform">
    <div class="mt-5" style="padding: 20px 40px;">
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
        <div class="text-center"><input type="submit" role="button" class="btn btn-primary mt-2" value="Send Message"></div>
      </form>
    </div>
  </div>
@endsection