@if(count($errors) > 0 )
  @foreach($errors->all() as $error)
    <div role="alert" class="alert alert-danger">
      <button type="button" class="close alert-tag" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
        {{$error}}
    </div>
  @endforeach
@endif

@if(session('success'))
  <div role="alert" class="alert alert-success">
    <button type="button" class="close alert-tag" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    {!! session('success') !!}
  </div>
@endif

@if(session('error'))
  <div role="alert" class="alert alert-danger">
    <button type="button" class="close alert-tag" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">x</span></button>
    {!! session('error') !!}
  </div>
@endif

@if(session('maintenance'))
  <div role="alert" class="alert alert-info">
    <strong>Maintenance Mode: </strong> Only site administrators can access this site.
    <ul>
        <li>Do not logout</li>
        <li>Do not CREATE UPDATE or DELETE database records.</li>
    </ul>
  </div>
@endif