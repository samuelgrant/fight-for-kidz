<!-- Footer -->

<!-- I have cookies -->
<script>
  $('body').ihavecookies({
    title: "Cookies & Privacy",
    message: "We use cookies to ensure you get the best experince on our website.",
    cookieTypes: []
  }); 
</script>

  <footer class="bg-black small text-center text-white-50 row" style="">
    <div class="col-sm-4 mb-3">
      <div class="logoimg nav-logoimg">
        <canvas id="footerCanvas" style="width: 100%; height:100%">
        </canvas>
      </div> 
    </div>  
    <div class="col-sm-4 mb-3">
      Copyright &copy; {{config('app.name')}} {{ date('Y') }}
    </div>     
    <div class="col-sm-4 mb-3">
      <a style="color: grey;" href="{{route('login')}}">Administration Login</a>
    </div>
  </footer>