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
    <div class="col-md-12">
        <div class="row">
        
        @if($group->type != "System Group" && !$group->deleted_at)
        {!!Form::open(['action'=>['admin\GroupManagementController@destroy', $group->id], 'method'=> 'POST']) !!}
        <button class="btn btn-danger" type="submit"><i class="fas fa-user-times"></i> Delete Group</button>
        {{Form::hidden('_method', 'delete')}}
        {!! Form::close() !!}
        @elseif($group->deleted_at)
        {!!Form::open(['action'=>['admin\GroupManagementController@restore', $group->id], 'method'=> 'POST']) !!}
            <button class="btn btn-info" type="submit" ><i class="far fa-check-circle"></i> Restore Group</button>
            {{Form::hidden('_method', 'patch')}}
        {!! Form::close() !!}
        @endif
        </div>
    </div>
</div>
@endsection