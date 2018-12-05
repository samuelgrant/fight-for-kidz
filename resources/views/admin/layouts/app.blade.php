<!DOCTYPE html>
<html lang="en">

    <head>
        @include('admin.layouts.head')
    </head>

    <body id="page-top">
        @include('admin.layouts.nav')
            <div id="content-wrapper">
                <div class="container-fluid">
                    @include('admin.layouts.alerts')
                    @yield('page')
                </div>
                <!-- /.container-fluid -->
            </div>
            <!-- /.content-wrapper -->
        </div>
        @include('admin.layouts.footer')
        @yield('scripts')
    </body>
</html>