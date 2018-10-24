@extends('admin.layouts.app') @section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.eventManagement')}}">Events Management</a>
    </li>
    <li class="breadcrumb-item active">Event: {{$event->name}}</li>
</ol>



<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'overview') || (app('request')->input('tab') == '') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-1" id="overview">Overview</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'bouts')? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-2" id="bouts">Bouts</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'contenders')? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-3" id="contenders">Contenders</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'applicants') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-4" id="applicants">Applicants</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'auction')? 'active': '' }}"
                    role="tab" data-toggle="tab" href="#tab-5" id="auction">Auction</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane {{(app('request')->input('tab') == '') || (app('request')->input('tab') == 'overview') ? 'active': ''}}" role="tabpanel" id="tab-1">

                <h3 class="mt-4">{{$event->name}} Overview</h3>

                <hr>
            
                <div class="row">                    
                    
                    <div class="col-lg-6">
                        <div class="card border-primary mb-2">
                        
                            <div class="card-header bg-primary text-white">
                                <h4 class="mb-0 d-inline-block">Event Details</h4>
                                <span class="float-right">
                                    <button role="button" data-toggle="modal" data-target="#eventDetailsModal" class="btn btn-primary float-right">
                                        <i class="fas fa-cog"></i>&nbsp; Edit Details
                                    </button> 
                                </span>
                            </div>

                            <div class="card-body">
                                <table class="table">
                                    <tr>
                                        <td>Event Name:</td>
                                        <td>{{$event->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Event Date:</td>
                                        <td>{{$event->datetime}}</td>
                                    </tr>
                                    <tr>
                                        <td>Event Venue:</td>
                                        <td>{{$event->venue_name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Venue Address:</td>
                                        <td>{{$event->venue_address}}</td>
                                    </tr>
                                    <tr>
                                        <td>Charity:</td>
                                        <td>{{$event->charity}}</td>
                                    </tr>
                                </table>
                            </div>                        
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <div class="card border-primary mb-2">
                            <div class="card-header bg-primary text-white">
                                <h4 class="text-white d-inline-block mb-0">Pending Applications</h4>
                                <span class="float-right"><a class="btn btn-primary" href="/a/event-management/{{$event->id}}?tab=applicants"><i class="fas fa-search"></i>&nbsp; View</a></span>
                            </div>
                            <div class="card-body">

                                {{Form::open(['action' => ['admin\EventManagementController@toggleApplications', $event->id], 'method' => 'PUT'])}}
                                    <label class="switch">
                                            <input type="checkbox" {{$event->open ? 'checked' : ''}} onchange="this.form.submit()">
                                            <span class="slider round"></span>
                                    </label>
                                {{Form::close()}}

                                <hr>

                                <h3 class="text-center">Applications Received</h3>
                                <h2 class="text-grey text-center">{{count($event->applicants)}}</h2>

                                <hr>

                                <div class="row">
                                    <div class="col-6">
                                        <h3 class="text-center">Blue Fighters Selected</h3>
                                        <h2 class="text-center">{{count($event->getTeam('blue'))}}</h2>
                                    </div>
                                    <div class="col-6">
                                        <h3 class="text-center">Red Fighters Selected</h3>
                                        <h2 class="text-center">{{count($event->getTeam('red'))}}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'bouts') ? 'active': ''}}" role="tabpanel" id="tab-2">
                
                <div class="mt-4">
                    <h3 class="d-inline">{{$event->name}} : Bout Management</h3>
                    <span class="float-right px-5"><button class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add Bout</button></span>
                </div>

                <hr>

                <div class="row">
                
                    @foreach($event->bouts as $bout)
                    <div class="col-lg-4 col-md-6">
                        <div class="card boutMgmt-card border-primary mb-3">
                            <div class="card-header boutMgmt-header bg-primary text-white">
                                <h4 class="mb-0 d-inline">{{$bout->name}}</h4>
                                <span class="float-right btn"><i class="fas fa-trash"></i></span>
                            </div>
                            <div class="card-body boutMgmt-body">
                                <form data-bout-id="{{$bout->id}}" action="{{route('admin.eventManagement.updateBoutDetails', ['boutId' => $bout->id])}}"
                                    data-red-id="{{$bout->red_contender_id ? $bout->red_contender_id : '0'}}" data-blue-id="{{$bout->blue_contender_id ? $bout->blue_contender_id : '0'}}" data-sponsor-id="{{$bout->sponsor_id ? $bout->sponsor_id : '0'}}"
                                    method="POST">
                                    <div class="form-group">
                                        <label for="sponsor-select-{{$bout->id}}">Bout Sponsor</label>
                                        <select name="sponsor" id="sponsor-select-{{$bout->id}}" class="form-control sponsor-select">
                                            <option value="0">---</option>
                                            @foreach($event->sponsors as $sponsor)
                                                <option value="{{$sponsor->id}}">{{$sponsor->company_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="blue-select-{{$bout->id}}">Blue Corner</label>
                                        <select name="blue" id="blue-select-{{$bout->id}}" class="form-control blue-select">
                                            <option value="0">---</option>
                                            @foreach($event->getTeam('blue') as $contender)
                                                <option value="{{$contender->id}}">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="red-select-{{$bout->id}}">Red Corner</label>
                                        <select name="red" id="red-select-{{$bout->id}}" class="form-control red-select">
                                            <option value="0">---</option>
                                            @foreach($event->getTeam('red') as $contender)
                                                <option value="{{$contender->id}}">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @csrf
                                    {{method_field('PATCH')}}
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'contenders') ? 'active': ''}}" role="tabpanel" id="tab-3">
                
                <div class="mt-4">
                    <h3>{{$event->name}} : Contenders</h3>
                </div>

                <hr>

                @foreach($event->contenders as $contender)

                    <h2>Contender Name: {{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h2>
                    <h4>Team: {{$contender->team}}</h4>

                @endforeach

            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'applicants') ? 'active': ''}}" role="tabpanel" id="tab-4">

            <div class="mt-4">
                <h3 class="d-inline">{{$event->name}} : Applications</h3>
                <span class="float-right px-5">
                    <button class="btn btn-success"><i class="fas fa-plus"></i>&nbsp;Add selected to team</button>
                </span>
            </div>

            <hr>
                
                <table id="applicant-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Team</th>
                            <th>Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Height (cm)</th>
                            <th>Current Weight (kg)</th>
                            <th>Expected Weight (kg)</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->applicants as $applicant)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input dtable-control" id="{{$applicant->id}}"
                                        value="checkedvalue">
                                </div>
                            </td>
                            <td>
                            @if($applicant->contender != null)
                                @if($applicant->contender->team == 'red')
                                    <span class="badge badge-danger">Red</span>
                                @elseif($applicant->contender->team == 'blue')
                                    <span class="badge badge-primary">Blue</span>
                                @endif
                            @endif
                            </td>
                            <td>{{$applicant->first_name . ' ' . $applicant->last_name}}</td>
                            <td>{{$applicant->getAge()}}</td>
                            @if($applicant->is_male)
                                <td>M</td>
                            @else
                                <td>F</td>
                            @endif
                            <td>{{$applicant->height}}</td>
                            <td>{{$applicant->current_weight}}</td>
                            <td>{{$applicant->expected_weight}}</td>
                            <td>
                                <button class="btn btn-info" type="button" onclick="applicantManagementModal({{$applicant->id}})"><i class="fal fa-info-circle"></i> More Info</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'auction') ? 'active': ''}}" role="tabpanel" id="tab-5">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Event Details Modal -->
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="Edit Event Details" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Edit Event Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.eventManagement.update', ['eventID' => $event->id])}}">
                    <div class="form-group">
                        <label for="eventName">Name:</label>
                        <input type="text" name="name" id="eventName" class="form-control" value="{{$event->name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="eventDate">Date and Time:</label>
                        <input type="datetime-local" name="date" id="eventDate" class="form-control" value="{{$event->getDateTimeString()}}" required>
                    </div>
                    <div class="form-group">
                        <label for="eventVenue">Venue Name:</label>
                        <input type="text" name="venue" id="eventVenue" class="form-control" value="{{$event->venue_name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="eventAddress">Venue Address:</label>
                        <input type="text" name="address" id="eventAddress" class="form-control" value="{{$event->venue_address}}" required>
                    </div>
                    <div class="form-group">
                        <label for="eventCharity">Supported Charity</label>
                        <input type="text" name="charity" id="eventCharity" class="form-control" value="{{$event->charity}}" required>
                    </div>
                    @csrf
                    {{method_field('PUT')}}
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div> <!-- End Edit Event Details Modal -->

<!-- More Info Modal -->
<div class="modal fade" id="applicantMoreInfoModal" tabindex="-1" role="dialog" aria-labelledby="Edit Event Details" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Edit Event Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantGeneral" class="nav-link active">General</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantPhysical" class="nav-link">Physical Information</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantAdditional" class="nav-link">Additional Info</a></li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="applicantGeneral">
                            <div class="row">
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <img src="/img/44Aquila.png" class="img-thumbnail">
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Name:</label>
                                        <input type="text" value="Joe Bloggs" readonly class="form-control-plaintext" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Fight Name:</label>
                                        <input type="text" value='"Average Joe"' readonly class="form-control-plaintext" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Age:</label>
                                        <input type="text" value="23" readonly class="form-control-plaintext" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>DOB</label>
                                        <input type="text" value="26/07/1990" readonly class="form-control-plaintext" />
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-6 col-sm-12">
                                    <div class="form-group">
                                        <label>Gender:</label>
                                        <input type="text" value="Male" readonly class="form-control-plaintext" />
                                    </div>
                                </div>
                                    
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantPhysical">
                            <p>Content for tab 2.</p>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantAdditional">
                            <p>Content for tab 3.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div><!-- End More Info Modal -->
@endsection