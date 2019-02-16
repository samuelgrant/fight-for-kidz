@include('layouts.head')

<body class="ring-bg">
    <div class="" style="min-height: calc(100vh - 120px);">
        @include('layouts.nav')
    
        @yield('content')
    </div>

    @include('layouts.footer')
</body>

</html>