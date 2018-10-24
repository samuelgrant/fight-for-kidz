<!-- Footer -->

<!-- I have cookies -->
<script>
  $('body').ihavecookies({
    title: "Cookies & Privacy",
    message: "We use cookies to ensure you get the best experince on our website.",
    cookieTypes: []
  }); 
</script>

  <footer class="bg-black small text-center text-white-50 row py-2">
    <div class="col-sm-4 mb-3">
      <img src="/storage/images/f4k_logo.png?{{filemtime($_SERVER["DOCUMENT_ROOT"].'/storage/images/f4k_logo.png')}}" class="img-fluid w-50">
      </div> 
    </div>  
    <div class="col-sm-4 mb-3 my-auto">
      &copy; {{ date('Y') }} {{config('app.name')}} 
    </div>     
    <div class="col-sm-4 mb-3 my-auto">
      <a style="color: grey;" href="{{route('login')}}">Administration Login</a>
    </div>
  </footer>