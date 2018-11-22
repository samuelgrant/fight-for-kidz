@extends('layouts.app')

@section('content')
<div class="container auth">
    <img class="d-block mx-auto" src="http://f4k.localhost/storage/images/f4k_logo_noyear.png" style="max-width:50%">
    <div class="text-center text-white">
        <h1 class="pt-2 mb-1">Temporarily Offline</h1>
        <span>Our website is temporarily unavailable. We will be back online as soon as possible.</span>
    </div>    
</div>

<script>
    $(".navbar").remove();
</script>
@endsection