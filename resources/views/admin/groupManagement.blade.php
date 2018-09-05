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
        
        @if($group->type != "System Group")
        {!!Form::open(['action'=>['admin\GroupManagementController@destroy', $group->id], 'method'=> 'POST']) !!}
        <button class="btn btn-danger" type="submit"><i class="fas fa-user-times"></i> Delete Group</button>
        {{Form::hidden('_method', 'delete')}}
        {!! Form::close() !!}
        @endif
        </div>
    </div>
</div>

<!-- New Group Modal -->
<div id="newGroup" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Create a New Group</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                {!! Form::open(['action' => 'admin\GroupManagementController@store', 'method' => 'POST']) !!}
                    <div class="form-group">
                      <label for="name">Group Name</label>
                      <input type="text" name="groupName" id="name" class="form-control" placeholder="*required" maxlength="30" required>
                    </div>
                    
                   <div class="form-group">
                        <label for="groupAvatar">Optional Group Icon</label>
                        <div>
                            <img id="imgPreview" src="https://via.placeholder.com/100x80" class="float-left mr-2" alt="placeholder">
                            <label class="btn btn-info btn-sm btn-file">
                                <i class="fas fa-upload"></i> Select Image 
                                <input name="groupImage" id="img" type="file" style="display: none;">
                            </label>
                            <button class="btn btn-danger btn-sm d-block" type="button" onclick="resetImagePre()"><i class="fas fa-times"></i> Remove Image</button>
                        </div>
                        <small id="groupAvatarHelp" class="text-muted d-block">Required format .png - max 100 x 80 px.</small>
                   </div>
                   <style>
                   .btn-file {
                        position: relative;
                        overflow: hidden;
                    }
                    .btn-file input[type=file] {
                        position: absolute;
                        top: 0;
                        right: 0;
                        min-width: 100%;
                        min-height: 100%;
                        font-size: 100px;
                        text-align: right;
                        filter: alpha(opacity=0);
                        opacity: 0;
                        outline: none;
                        background: white;
                        cursor: inherit;
                        display: block;
                    }
                   </style>
                    <button class="btn btn-primary btn-success" type="submit">Create Group</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection