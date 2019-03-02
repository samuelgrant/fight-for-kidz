<div id="browser-alert" role="alert" class="alert alert-warning">
		<button type="button" class="close alert-tag" data-dismiss="alert" aria-label="Close"><span  style="color:black" aria-hidden="true">x</span></button>
		You appear to be using an outdated internet browswer. In order to properly view our site, we recommend updating to a modern browser such 
		as <a href="https://www.google.com/chrome/">Google Chrome</a>.
</div>

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