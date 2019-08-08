@include('layouts.cookie-consent')

<!-- Footer -->
<footer id="f4k-footer" class="bg-black small text-center text-white-50 py-2">
	<div class="container-fluid" style="padding-right: 15px; padding-left: 15px; margin-right:auto; margin-left:auto;">
		<div class="row">
			<div class="col-sm-4 mb-3">
		  		<img src="/storage/images/f4k_logo_noyear.png" alt="Fight for Kids logo" class="img-fluid w-50">
			</div>  
			<div class="col-sm-4 mb-3 my-auto">
		  		&copy; {{ date('Y') }} {{config('app.name')}} 
			</div>     
			<div class="col-sm-4 mb-3 my-auto">
		  		<a style="color: grey;" href="{{route('login')}}">Administration Login</a>
			</div>
		</div>
	</div>
</footer>
