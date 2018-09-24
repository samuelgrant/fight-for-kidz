  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-light fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="{{route('index')}}">
      <div>
        <img src="/storage/images/f4k_logo.png" class="img-fluid">
      </div>
      </a>
      <button class="navbar-toggler  navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive"
        aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        Menu
        <i class="fas fa-bars"></i>
      </button>
      <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/about">About us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/contenders">Contenders</a>
          </li>
          <li class="nav-item">
              <a class="nav-link js-scroll-trigger" href="/previous">Previous Years</a>
          </li>
          <li class="dropdown">
            <a class="dropdown-toggle nav-link" data-toggle="dropdown" href="#">Support Us
              <span class="caret"></span>
            </a>
            <ul id="dropdown1" class="dropdown-menu">
              <li>
                <a class="js-scroll-trigger" href="#"><p>Reserve Seats</p></a>
              </li>
              <li>
                <a class="js-scroll-trigger" href="{{route('Merchandise')}}"><p>Merchandise</p></a>
              </li>
              <li>
                <a href="/auction"><p>Auction</p></a>
              </li>
              <li>
                <a class="js-scroll-trigger" href="{{route('application')}}"><p>Apply</p></a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link js-scroll-trigger" href="/contact"><p>Contact Us</p></a>
          </li>
        </ul>
      </div>
    </div>
  </nav>
  <script>
        var c = document.getElementById("navcanvas");
        var ctx = c.getContext("2d");
        var year = "2021"
        ctx.font = "40px Arial";
        ctx.fillStyle = "white";
        ctx.fillText(year,1,110);
      </script>
