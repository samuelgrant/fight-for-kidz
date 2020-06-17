@extends('layouts.app')

@section('content')
<div class="container auth">
    <div class="text-center text-white">
        <i class="fas fa-cog fa-7x text-danger fa-pulse slow" data-fa-transform="right-6 up-3"></i>
        <i class="fas fa-cog fa-5x text-dark" data-fa-transform="down-4"></i>
        <i class="fas fa-cog fa-10x text-warning fa-pulse slow" data-fa-transform="left-6" style="animation-direction: reverse;"></i>
        <h1 class="pt-2 mb-1">Internal Server Error</h1>
        <span>This error was probably our fault. <br /> Please flick us a message and tell us what page you were trying to visit.</span>
    </div>
</div>
@endsection