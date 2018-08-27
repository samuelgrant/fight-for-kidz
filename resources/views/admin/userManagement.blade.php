@extends('admin.layouts.app')
@section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">User Management</li>
</ol>

<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Last Updated</th>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{$user->name}}</td>
                        <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                        <td>{{($user->active)? "Active Account" : "Activation Required"}}</td>
                        <td>{{$user->updated_at}}</td>
                        <td>
                            {!!Form::open(['action'=>['admin\UserManagementController@toggleActive', $user->id], 'method' => 'POST']) !!}
                            @if($user->active)
                            <button class="btn btn-info" type="submit"><i class="far fa-times-circle"></i> Deactive Account</button>
                            @else
                            <button class="btn btn-info" type="submit"><i class="far fa-check-circle"></i> Activate Account</button>
                            @endif
                            {{Form::hidden('_method', 'put')}}
                            {!! Form::close() !!}
                        </td>
                        <td>
                            {!!Form::open(['action'=>['admin\UserManagementController@destroy', $user->id], 'method'=> 'POST']) !!}
                            <button class="btn btn-danger" type="submit"><i class="fas fa-user-times"></i> Delete Account</button>
                            {{Form::hidden('_method', 'delete')}}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>  
    </div>
</div>
@endsection