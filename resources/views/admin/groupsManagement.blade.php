@extends('admin.layouts.app') @section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Group Management</li>
</ol>



<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-1" id="active">Current Groups</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-2" id="deleted">Deleted Groups</a></li>
                <button class="btn btn-primary btn-sm ml-1 my-1 tab-modal" data-toggle="modal" data-target="#newGroup">New
                    Group
                </button>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tabpanel" id="tab-1">
                <div class="row">
                    @foreach($groups as $group)
                    <div class="col-lg-3 col-md-4 col-sm-6 my-4 px-2">
                        <a class="btn groups" href="{{ route('admin.group', ['id' => $group->id])}}">
                            <img class="d-block m-auto" src="/storage/images/groups/{{($group->custom_icon)?$group->id: 0 }}.png" alt="Group Icon" />
                            <h5>{{$group->name}}</h5>
                            <span class="d-block text-center">{{$group->type}}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="tab-pane {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tabpanel" id="tab-2">
                <div class="row">
                    @foreach($deletedGroups as $group)
                    <div class="col-lg-3 col-md-4 col-sm-6 my-4 px-2">
                        <a class="btn groups" href="{{ route('admin.group', ['id' => $group->id])}}">
                            <img class="d-block m-auto" src="/storage/images/groups/{{($group->custom_icon)?$group->id: 0 }}.png" alt="Group Icon" />
                            <h5>{{$group->name}}</h5>
                            <span class="d-block text-center">{{$group->type}}</span>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!-- New Group Modal -->
<div id="newGroup" class="modal fade" role="dialog" tabindex="-1">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Create a New Group</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                        aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                {!! Form::open(['action' => 'admin\GroupManagementController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
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
                        <button class="btn btn-danger btn-sm d-block" type="button" onclick="resetImagePre()"><i class="fas fa-times"></i>
                            Remove Image</button>
                    </div>
                    <small id="groupAvatarHelp" class="text-muted d-block">Required format .png - max 100 x 80 px.</small>
                </div>
                <button class="btn btn-primary btn-success" type="submit">Create Group</button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</div>
@endsection