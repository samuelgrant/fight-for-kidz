@include('layouts.head')

<body class="ring-bg">
    @include('layouts.nav')
    @include('layouts.messages')

    @yield('content')

    @include('layouts.footer')
</body>

</html>