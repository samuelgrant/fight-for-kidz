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

        @include('admin.layouts.manualMessage')

        <div class="card mb-3">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0 mr-2 d-inline-block"><i class="fas fa-info-circle"></i> Displaying {{$type}} {!!(in_array($type, ['Applicants', 'Red Contenders', 'Blue Contenders', 'Sponsors'])) ? 'for ' . $event->name : ''!!}</h3>
                <span>
                    {!!($type == 'All') ? '(excluding <a class="text-white" href="'. route('admin.group.subscribers') .'"><u>subscribers</u></a>)' : ''!!}                    
                </span>
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
            @if($type != 'All' && $type != 'Others')
                <form action="{{route('admin.mail.preset')}}" method="POST" class="float-right">
                    <input name="groupID" type="hidden" value="{{strtolower($type)}}">
                    <button class="btn btn-success" type="submit"><i class="fas fa-envelope"></i>&nbsp;Email All</button>
                    @csrf
                </form> 
            @endif
        </div>

        <table id="system-group-dtable" class="table table-striped table-hover table-sm">
            <thead class="thead-default">
                <tr>
                    <th><input type="checkbox" id="dtable-select-all"></th>
                    <th class="dtable-control">Name</th>
                    <th class="dtable-control">Email</th>
                    <th class="dtable-control">Phone</th>
                    <th class="dtable-control">Description</th>
                    <th></th>
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
                            <td></td>
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
                            <td></td>
                        </tr>
                    @endforeach
                @endif

                {{-- Applicants loop --}}
                @if($type == 'All' || $type == 'Applicants' || $type == 'All Applicants')                    
                    @foreach(($type == 'Applicants' ? App\Applicant::where('event_id', $event->id)->get() : App\Applicant::all()) as $member)
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
                            <td>
                                @if($member->isContender())
                                Fighter ({{Carbon\Carbon::parse(App\Event::find($member['event_id'])->datetime)->format('Y')}})</td>
                                @else
                                Applicant ({{Carbon\Carbon::parse(App\Event::find($member['event_id'])->datetime)->format('Y')}})</td>
                                @endif
                            <td></td>
                        </tr>
                    @endforeach
                @endif

                {{-- Red team loop --}}
                @if($type == 'Red Contenders')                    
                    @foreach($event->getTeam('red') as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member->applicant['email']}}"
                                        value="checkedValue" data-member-type="applicant" data-member-id="{{$member->applicant['id']}}">
                                </div>
                            </td>
                            <td>{{$member['first_name'] . ' ' . $member['last_name']}}</td>
                            <td><a href="mailto:{{$member->applicant['email']}}">{{$member->applicant['email']}}</a></td>
                            <td>{{$member->applicant['phone']}}</td>
                            <td>Contender ({{Carbon\Carbon::parse(App\Event::find($member['event_id'])->datetime)->format('Y')}})</td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif

                {{-- Blue team loop --}}
                @if($type == 'Blue Contenders')                    
                    @foreach($event->getTeam('blue') as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member->applicant['email']}}"
                                        value="checkedValue" data-member-type="applicant" data-member-id="{{$member->applicant['id']}}">
                                </div>
                            </td>
                            <td>{{$member['first_name'] . ' ' . $member['last_name']}}</td>
                            <td><a href="mailto:{{$member->applicant['email']}}">{{$member->applicant['email']}}</a></td>
                            <td>{{$member->applicant['phone']}}</td>
                            <td>Contender ({{Carbon\Carbon::parse(App\Event::find($member['event_id'])->datetime)->format('Y')}})</td>
                            <td></td>
                        </tr>
                    @endforeach
                @endif

                {{-- Sponsors loop --}}
                @if($type == 'All' || $type == "Sponsors" || $type == "All Sponsors")
                    @foreach(($type == "Sponsors" ? $event->sponsors : App\Sponsor::all()) as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member['email']}}"
                                        value="checkedValue" data-member-type="sponsor" data-member-id="{{$member['id']}}">
                                </div>
                            </td>
                            <td>{{$member['contact_name'] ? $member['contact_name'] . ' (' . $member['company_name'] . ')' : $member['company_name']}}</td>
                            <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                            <td>{{$member['contact_phone']}}</td>
                            <td>Sponsor</td>
                            <td><a class="btn btn-primary btn-sm" target="_blank" href="{{route('admin.sponsorManagement.view', ['sponsorID' => $member['id']])}}"><i class="fas fa-search"></i></a></td>
                        </tr>
                    @endforeach
                @endif

                {{-- Contacts loops --}}
                @if($type == 'All' || $type == "Others")
                    @foreach(App\Contact::all() as $member)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-checkbox member-remove-checkbox dtable-control" id="{{$member['email']}}"
                                        value="checkedValue" data-member-type="contact" data-member-id="{{$member['id']}}">
                                </div>
                            </td>
                            <td>{{$member['name']}}</td>
                            <td><a href="mailto:{{$member['email']}}">{{$member['email']}}</a></td>
                            <td>{{$member['phone']}}</td>
                            <td>Other contact</td>
                            <td><button class="btn btn-primary btn-sm" onclick="editContactModal({{$member['id']}})"><i class="fas fa-cog"></i></button></td>
                        </tr>
                    @endforeach
                @endif

            </tbody>
        </table>
    </div>
</div>

{{-- edit contact modal --}}
<div class="modal fade" id="editContactModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white">Edit Contact</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="editContactForm" method="post" action="" data-action="{{route('admin.contact.update', ['contactID' => null])}}">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="contactName" class="form-control" required>
                    </div>
                    <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" name="phone" id="contactPhone" class="form-control">
                        </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="contactEmail" class="form-control" required>
                    </div>
                    @method('PATCH')
                    @csrf    
                    <button type="button" id="buttonDeleteContact" class="btn btn-danger" onclick="confirmAction()"><i class="fas fa-trash"></i>&nbsp; Delete</button>
                    <button type="button" id="buttonConfirmContact" class="btn btn-danger d-none" onclick="actionConfirmed()"><i class="fas fa-trash"></i>&nbsp; Confirm Delete?</button>
                    <button type="submit" class="btn btn-success float-right">Save Changes</button>
                </form>
                <form id="contactDeleteForm" class="d-none" action="" data-action={{route('admin.contact.delete', ['contactID' => null])}} method="POST">
                    @method('DELETE')
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end edit contact modal --}}

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