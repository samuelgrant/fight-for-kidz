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
    <div class="col-lg-4 col-md-6 col-sm-12">
        <div class="card border-danger">
            <div class="card-header bg-danger text-white">
                <h5 class="mb-0"><i class="fas fa-exclamation-triangle"></i> Group Settings</h5>
            </div>
            <div class="card-body">
                @if($group->type != "System Group")
                <form method="POST" action="{{route('admin.group.update', [$group->id])}}" enctype="multipart/form-data">
                    <div class="form-group">
                      <label for="name">Group Name</label>
                      <input type="text" name="groupName" id="name" class="form-control" value="{{$group->name}}" required>
                    </div>
                    
                   
                <div class="form-group">
                    <label for="groupAvatar">Optional Group Icon</label>
                    <div class="row">
                        <div class="col-md-2">
                            <img id="imgPreview" class="group-icon" src="{{$group->custom_icon ? '/storage/images/groups/'.$group->id.'.png' : 'https://via.placeholder.com/100x80'}}" class="float-left mr-2" alt="placeholder">
                        </div>
                        <div class="col-md-10">
                            <label class="btn btn-info btn-sm btn-file">
                                <i class="fas fa-upload"></i> Select Image
                                <input name="groupImage" id="img" type="file" style="display: none;">
                                <input type="checkbox" id="removeImageCheckbox" name="removeImageCheckbox" style="display:none">
                            </label>
                            <button class="btn btn-danger btn-sm d-block" type="button" id="btnRemoveImage" onclick="resetImagePre()"><i class="fas fa-times"></i>
                                Remove Image</button>                                
                            <small id="groupAvatarHelp" class="text-muted d-bhlock">Use png 100H x 80W.</small>
                        </div>
                    </div>
                </div>

                 @csrf
                    {{Form::hidden('_method', 'PUT')}}
                    <button type="submit" class="btn btn-success btn-block"><i class="far fa-check-circle"></i> Update Settings</button>
                </form>
                
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
                @else
                    <span class="text-danger">This is an automated group. You cannot change the settings of this group.</span>
                @endif
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6 col-sm-12">
        @if($group->type != "System Group")
            <button class="btn btn-primary mb-3" type="button" data-toggle="modal" data-target="#addToGroupModal">Add new contact to Group</button>
        @endif
        <table id="subscribers-dtable" class="table table-striped table-hover table-sm">
            <thead class="thead-default">
                <tr>
                    <th></th>
                    <th>Name</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                <tr>
                    <td>
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="" value="checkedValue">
                        </div>
                    </td>
                    <td>{{$member['name']}}</td>
                        <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if($group->type != "System Group")
<!-- Add to group modal -->
<div class="modal fade" id="addToGroupModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add a new contact to a group.</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.group.addMember', [$group->id])}}">
                    <div class="form-group">
                        <label for="inviteeName">Name</label>
                        <input type="text" name="name" id="inviteName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="inviteeName">Email</label>
                        <input type="email" name="email" id="inviteEmail" class="form-control" required>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i> Add person to Group</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endif
@endsection