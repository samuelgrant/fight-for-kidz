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
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tab" data-toggle="tab" href="#tab-1" id="active">Current Accounts</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tab" data-toggle="tab" href="#tab-2" id="deleted">Deleted Accounts</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tabpanel" id="tab-1">
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
                                        <button class="btn btn-info" type="submit"><i class="far fa-times-circle"></i> Deactivate Account</button>
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
                <div class="tab-pane {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tabpanel" id="tab-2">
                <div class="table-responsive">
                        <table class="table table-striped table-hover table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Deleted</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($deletedUsers as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td><a href="mailto:{{$user->email}}">{{$user->email}}</a></td>
                                    <td>{{$user->deleted_at}}</td>
                                    <td>
                                        {!!Form::open(['action'=>['admin\UserManagementController@restore', $user->id], 'method'=> 'POST']) !!}
                                        <button class="btn btn-info" type="submit"><i class="far fa-times-circle"></i> Restore Account</button>
                                        {{Form::hidden('_method', 'patch')}}
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div> 
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection
