<!-- I have cookies -->
<script>
$('body').ihavecookies({
		title: "Cookies & Privacy",
		message: "We use cookies to ensure you get the best experince on our website.",
		cookieTypes: []
	}); 
</script>
<script src="/js/admin-event.js"></script>
<!-- Footer -->
<footer id="f4k-footer" class="bg-black small text-center text-white-50 row py-2">
	<div class="col-sm-4 mb-3">
  		<img src="/storage/images/f4k_logo_noyear.png" alt="Fight for Kids logo" class="img-fluid w-50">
	</div>  
	<div class="col-sm-4 mb-3 my-auto">
  		&copy; {{ date('Y') }} {{config('app.name')}} 
	</div>     
	<div class="col-sm-4 mb-3 my-auto">
  		<a style="color: grey;" href="{{route('login')}}">Administration Login</a>
	</div>
</footer>
