@extends('layouts.app')

@section('content')
<div class="container auth conform p-3">
    <div class="text-center text-white">
        <i class="fas fa-thumbs-up fa-5x"></i>
        <h1 class="pt-2 mb-5">Application Received</h1>
        <span>Thank you for applying to fight in {{App\Event::current()->name}}. We will review all applications and be in touch soon!</span>
        <a href="/"><h3 class="text-center text-white mt-5"><u>Back to Fight for Kidz</u></h3></a>
    </div>    
</div>
@endsection