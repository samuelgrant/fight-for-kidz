<!-- Footer -->

<!-- I have cookies -->
<script>
  $('body').ihavecookies({
    title: "Cookies & Privacy",
    message: "We use cookies to ensure you get the best experince on our website.",
    cookieTypes: []
  }); 
</script>

  <footer class="bg-black small text-center text-white-50">
    <div class="col-sm-4">
      <img src="img/f4k.png" style="height:50px" alt="Fight for Kidz logo" class="d-none d-md-inline-block">
    </div>
    <div class="container">
      Copyright &copy; {{config('app.name')}} {{ date('Y') }}
    </div>
    <div class="text-right mr-3">
      <a style="color: grey;" href="{{route('login')}}">Administration Login</a>
    </div>
  </footer>