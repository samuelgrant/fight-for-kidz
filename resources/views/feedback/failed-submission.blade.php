@extends('layouts.app')

@section('content')
<div class="container auth conform p-3">

    @include('layouts.messages')

    <div class="text-center text-white">
        <i class="far fa-sad-tear fa-5x"></i>
        <h1 class="pt-2 mb-5">There were some problems...</h1>
        <span>Unfortunately, your application failed to submit correctly. Please see the errors at the top of the page, and try again. If errors persist, please contact Fight for Kidz.</span>
        <a href="/"><h3 class="text-center text-white mt-5"><u>Back to Fight for Kidz</u></h3></a>
    </div>    
</div>
@endsection