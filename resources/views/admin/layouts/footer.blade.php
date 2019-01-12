<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Sticky Footer -->
<footer class="sticky-footer">
    <div class="container my-auto">
    <div class="copyright text-center my-auto">
        <span>Copyright © {{config('app.name')}} {{ date('Y') }}</span>
    </div>
    </div>
</footer>

<!-- Bootstrap core JavaScript-->
<!-- non-slim jQuery -->
<script src="/admin/js/libraries/jquery.min.js"></script>
<script src="/admin/js/libraries/popper.min.js"></script>
<script src="/admin/js/libraries/bootstrap.min.js"></script>

<!-- Custom scripts for all pages-->
<script type="text/javascript" src="/admin/js/admin-app.js"></script>
<script type="text/javascript" src="/admin/js/sb-admin.min.js"></script>
<script type="text/javascript" src="/admin/js/admin-bouts.js"></script>
<script type="text/javascript" src="/admin/js/admin-contenders.js"></script>
<script type="text/javascript" src="/admin/js/admin-sponsors.js"></script>

<!-- Jquery Validation -->
<script src="/admin/js/libraries/jquery-validate.min.js"></script>


<!-- Datatable -->
<script src="/admin/js/libraries/jquery-datatables.min.js"></script>
<script src="/admin/js/libraries/datatables-bootstrap4.min.js"></script>

{{-- fSelect --}}
<script src="/admin/js/fSelect.js" type="text/javascript"></script>
<script>
        (function($){
            $(function(){
                $('.multi-select').fSelect();
            });
        })(jQuery);
</script>

{{-- Ckeditor --}}
<script src="{{asset('/vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
