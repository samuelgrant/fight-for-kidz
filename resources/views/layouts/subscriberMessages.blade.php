@if(session('sub-success'))
  <div role="alert" class="alert alert-success">
    <button type="button" class="close alert-tag" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    {!! session('sub-success') !!}
  </div>
@endif

@if(session('sub-error'))
  <div role="alert" class="alert alert-danger">
    <button type="button" class="close alert-tag" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    {!! session('sub-error') !!}
  </div>
@endif