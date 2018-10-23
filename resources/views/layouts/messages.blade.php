@if(session('success'))
    <div class="alert alert-success">
        {{session('success')}}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        {{session('error')}}
    </div>
@endif

@if(count($errors) > 0 )
   @foreach($errors->all() as $error)
     <div role="alert" class="alert alert-danger">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&#10007;</span></button>
        {{$error}}
     </div>
   @endforeach
@endif