<nav class="navbar navbar-expand navbar-dark bg-dark static-top">      

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
	  </button>
	  
    <a class="navbar-brand mr-1" href="{{route('admin.dashboard')}}">{{config('app.name')}} - Admin Dashboard (logged in as {{Auth::user()->name}})</a>
    
      <!-- Navbar -->
      <ul class="navbar-nav  ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <li class="nav-item">
            <form method="post" action="/logout">
              @csrf
                <button class="btn btn-link" id="logout" type="submit"><i class="fas fa-user-circle fa-fw"></i>&nbsp;Logout</button>
            </form>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.dashboard')}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.eventManagement')}}">
            <i class="fab fa-react"></i>
            <span>Event Management</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.sponsorManagement')}}">
            <i class="fas fa-money-bill-wave-alt"></i>
            <span>Sponsor Management</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.groupManagement')}}">
            <i class="fas fa-layer-group"></i>
            <span>Group Management</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.sendMail')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Send Emails</span>
          </a>
        </li>         
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.messages')}}">
            <i class="fas fa-fw fa-envelope"></i>
            <span>View Messages</span>
          </a>
        </li> 
        <li class="nav-item">
          <a class="nav-link" href="{{route('admin.userManagement')}}">
            <i class="fas fa-fw fa-users"></i>
            <span>User Management</span>
          </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('admin.merchandiseManagement')}}">
              <i class="fas fa-fw fa-shopping-cart"></i>
              <span>Merchandise Management</span>
            </a>
          </li>
        <hr>
        <li class="nav-item">
          <a class="nav-link" href="{{route('index')}}">
            <i class="fas fa-boxing-glove"></i>
            <span>Back to Public Website</span>
          </a>
        </li>    
      </ul>

    
    <!-- /#wrapper -->