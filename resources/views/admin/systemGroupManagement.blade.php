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
    <li class="breadcrumb-item active">System Group: {{$type}}</li>
</ol>

<!-- Page Content -->
<div class="row">
    <!-- Group Settings -->
    <div class="col-12">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 mr-2 d-inline-block"><i class="fas fa-info-circle"></i> Displaying {{$type}}</h3><span>{!!($type == 'All') ? '(excluding <a class="text-white" href="'. route('admin.group.subscribers') .'"><u>subscribers</u></a>)' : ''!!}</span>
            </div>
        </div>
    </div>
    <div class="col-12">

        <div class="mb-3">
            <a class="btn btn-success" href="{{route('admin.groupManagement')}}"><i class="fas fa-arrow-left"></i></a>
    
            {{-- Add selected to group - visible to all groups --}}
            <button class="btn btn-success" type="button" data-toggle="modal" data-target="#copyToGroupModal">
                <i class="fas fa-copy"></i>&nbsp; Copy to group
            </button>
        </div>

        <table id="system-group-dtable" class="table table-striped table-hover table-sm">
            <thead class="thead-default">
                <tr>
                    <th><input type="checkbox" id="dtable-select-all"></th>
                    <th class="dtable-control">Name</th>
                    <th class="dtable-control">Email</th>
                    <th class="dtable-control">Phone</th>
                    <th class="dtable-control">Description</th>
                </tr>
            </thead>
            <tbody>

                {{-- Admins loop --}}
                @if($type == 'All' || $type == 'Admins')
                    @foreach(App\User::all() as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member['email']}}"
                                        value="checkedValue" data-member-type="admin" data-member-id="{{$member['id']}}">
                                </div>
                            </td>
                            <td>{{$member['name']}}</td>
                            <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                            <td></td>
                            <td>Administrator</td>
                        </tr>
                    @endforeach
                @endif

                {{-- Subscribers loop --}}
                @if($type == 'Subscribers')
                    @foreach(App\Subscriber::all() as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member['email']}}"
                                        value="checkedValue" data-member-type="subscriber" data-member-id="{{$member['id']}}">
                                </div>
                            </td>
                            <td>{{$member['name']}}</td>
                            <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                            <td></td>
                            <td>Subscriber</td>
                        </tr>
                    @endforeach
                @endif

                {{-- Applicants loop --}}
                @if($type == 'All' || $type == 'Applicants')
                    @foreach(App\Applicant::all() as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member['email']}}"
                                        value="checkedValue" data-member-type="applicant" data-member-id="{{$member['id']}}">
                                </div>
                            </td>
                            <td>{{$member['first_name'] . ' ' . $member['last_name']}}</td>
                            <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                            <td>{{$member['phone']}}</td>
                            <td>Applicant</td>
                        </tr>
                    @endforeach
                @endif

                {{-- Sponsors loop --}}
                @if($type == 'All' || $type == "Sponsors")
                    @foreach(App\Sponsor::all() as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member['email']}}"
                                        value="checkedValue" data-member-type="sponsor" data-member-id="{{$member['id']}}">
                                </div>
                            </td>
                            <td>{{$member['contact_name'] . ' (' . $member['company_name'] . ')'}}</td>
                            <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                            <td>{{$member['contact_phone']}}</td>
                            <td>Sponsor</td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</div>

{{-- copy success modal --}}
<div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Copy Successful</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <p id="modal-message-success"></p>

                <button type="button" class="btn btn-danger" data-dismiss="modal">Okay</button>

            </div>
        </div>
    </div>
</div>
{{-- end of success modal --}}

{{-- Copy to another group modal - outside if block as it is available for system groups --}}
<div class="modal fade" id="copyToGroupModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Copy Selected Contacts to Group</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <p>Copy selected contacts to which group?</p>

                <select id="groupDropdown" class="form-control">
                    @foreach ($groups as $groupOption)                        
                        <option value="{{$groupOption->id}}">{{$groupOption->name}}</option>                        
                    @endforeach
                </select>

                <br>

                <button type="button" class="btn btn-success d-block m-auto" data-dismiss="modal" onclick="copySelectedToGroup('systemGroups')">Confirm</button>

            </div>
        </div>
        <div class="modal-body">
            <form>

            </form>
        </div>
    </div>
</div>

@endsection