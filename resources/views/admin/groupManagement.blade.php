@extends('admin.layouts.app')
@section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.groupManagement')}}">Group Management</a>
    </li>
    <li class="breadcrumb-item active">Group: {{$group->name}}</li>   
</ol>

<!-- Page Content -->
<div class="row">
    <!-- Group Settings -->
    <div class="col-lg-3 col-md-4 col-sm-12">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Group Settings</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{route('admin.group.update', [$group->id])}}">
                    <div class="form-group">
                      <label for="name">Group Name</label>
                      <input type="text" name="name" id="name" class="form-control" value="{{$group->name}}" required>
                    </div>
                    
                    @csrf
                    {{Form::hidden('_method', 'PUT')}}
                    <button type="submit" class="btn btn-success btn-block"><i class="far fa-check-circle"></i> Update Settings</button>
                </form>
                @if($group->type != "System Group")
                <hr>
                    @if($group->type != "System Group" && !$group->deleted_at)
                    {!!Form::open(['action'=>['admin\GroupManagementController@destroy', $group->id], 'method'=> 'POST']) !!}
                        <button class="btn btn-danger btn-block" type="submit"><i class="fas fa-user-times"></i> Delete Group</button>
                        {{Form::hidden('_method', 'delete')}}
                    {!! Form::close() !!}
                    <p class="mt-2">You Will not be able to:</p>
                    <ul class="pl-2">
                        <li>Add or remove people from the group.</li>
                        <li>Email this group.</li>
                        <li>Manage this group.</li>
                    </ul>
                    <p>You can re-enable this group from the deleted tab on the group management page.</p>
                    @elseif($group->deleted_at)
                    {!!Form::open(['action'=>['admin\GroupManagementController@restore', $group->id], 'method'=> 'POST']) !!}
                        <button class="btn btn-info btn-block" type="submit" ><i class="far fa-check-circle"></i> Restore Group</button>
                        {{Form::hidden('_method', 'patch')}}
                    {!! Form::close() !!}
                    @endif
                @endif
            </div>
        </div>
    </div>

        

        </div>
    </div>
</div>
@endsection