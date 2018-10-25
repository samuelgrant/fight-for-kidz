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
                                <span class="btn btn-primary float-right" onclick="removeBout({{$bout->id}})"><i class="fas fa-trash"></i></span>
                            </div>
                            <div class="card-body boutMgmt-body">
                                <form data-bout-id="{{$bout->id}}" action="{{route('admin.eventManagement.updateBoutDetails', ['boutId' => $bout->id])}}"
                                    data-red-id="{{$bout->red_contender_id ?? '0'}}" data-blue-id="{{$bout->blue_contender_id ?? '0'}}" data-sponsor-id="{{$bout->sponsor_id ?? '0'}}"
                                    data-winner-id="{{$bout->victor_id ?? '0'}}" data-video-url="{{$bout->video_url}}"
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

                                    <div class="form-group">
                                        <label for="winner-{{$bout->id}}">Winner</label>
                                        <select name="winner" id="winner-{{$bout->id}}" class="form-control winner-select">
                                            <option value="0">---</option>
                                            @if($bout->red_contender)
                                                <option value="{{$bout->red_contender->id}}">(Red) {{$bout->red_contender->getFullName()}}</option>
                                            @endif
                                            @if($bout->blue_contender)
                                                <option value="{{$bout->blue_contender->id}}">(Blue) {{$bout->blue_contender->getFullName()}}</option>
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="video-{{$bout->id}}">Video URL:</label>
                                        <input class="form-control video-url" type="text" name="video" id="video-{{$bout->id}}" placeholder="Enter video url">
                                    </div>

                                    <div class="form-group float-right mb-0" style="display:none" id="bout-buttons" class='bout-buttons-div'>                                    
                                        <button id="cancel-button" class="btn btn-danger mr-2">Cancel</button>
                                        <input type="submit" id="save-button" class="btn btn-success float-right" value="Save Changes">
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

                <div class="row">
                
                    {{-- start of blue team --}}
                    <div class="col-lg-6">
                    
                        <div class="card border-primary">
                        
                            <div class="card-header bg-primary text-white">
                            
                                <h4 class="d-inline-block">Blue Team</h4>
                                <h5 class="d-inline-block float-right">{{count($event->getTeam('blue'))}} members</h5>
                            
                            </div>

                            <div class="card-body">
                            
                                <table class="table table-hover table-sm">
                                
                                    @foreach($event->getTeam('blue') as $contender)

                                        <tr>
                                            <td><h3>{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h3></td>
                                        </tr>

                                    @endforeach

                                </table>

                            </div>
                        
                        </div>
                    
                    </div>
                    {{-- end of blue team --}}

                    {{-- start of red team --}}
                    <div class="col-lg-6">
                    
                        <div class="card border-danger">
                        
                            <div class="card-header bg-danger text-white">
                            
                                <h4 class="d-inline-block">Red Team</h4>
                                <h5 class="d-inline-block float-right">{{count($event->getTeam('red'))}} members</h5>
                            
                            </div>

                            <div class="card-body">
                            
                                <table class="table table-hover table-sm">
                                
                                    @foreach($event->getTeam('red') as $contender)

                                        <tr>
                                            <td><h3>{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h3></td>
                                        </tr>

                                    @endforeach

                                </table>

                            </div>
                        
                        </div>
                    
                    </div>
                    {{-- end of red team --}}
                
                </div>                

            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'applicants') ? 'active': ''}}" role="tabpanel" id="tab-4">

            <div class="mt-4">
                <h3 class="d-inline">{{$event->name}} : Applications</h3>
                <span class="float-right px-5">
                    <button class="btn btn-success" data-toggle="modal" data-target="#editTeamModal" onclick="countSelected('applicants')"><i class="fas fa-plus"></i>&nbsp;Add selected to team</button>
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
                                    <input type="checkbox" class="dtable-checkbox form-check-input dtable-control" id="{{$applicant->id}}"
                                        value="checkedvalue" data-applicant-id="{{$applicant->id}}">
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
                <h4 class="modal-title">Applicant Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div>
                    <ul class="nav nav-tabs">
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantGeneral" class="nav-link active">General</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantPhysical" class="nav-link">Physical Information</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantAdditional" class="nav-link">Additional Info</a></li>
                        <li class="nav-item mr-auto">
                            <button class="btn btn-primary btn-sm ml-1 my-1">
                                    <svg class="svg-inline--fa fa-edit fa-w-18" aria-hidden="true" data-prefix="fas" data-icon="edit" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" data-fa-i2svg=""><path fill="currentColor" d="M402.6 83.2l90.2 90.2c3.8 3.8 3.8 10 0 13.8L274.4 405.6l-92.8 10.3c-12.4 1.4-22.9-9.1-21.5-21.5l10.3-92.8L388.8 83.2c3.8-3.8 10-3.8 13.8 0zm162-22.9l-48.8-48.8c-15.2-15.2-39.9-15.2-55.2 0l-35.4 35.4c-3.8 3.8-3.8 10 0 13.8l90.2 90.2c3.8 3.8 10 3.8 13.8 0l35.4-35.4c15.2-15.3 15.2-40 0-55.2zM384 346.2V448H64V128h229.8c3.2 0 6.2-1.3 8.5-3.5l40-40c7.6-7.6 2.2-20.5-8.5-20.5H48C21.5 64 0 85.5 0 112v352c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48V306.2c0-10.7-12.9-16-20.5-8.5l-40 40c-2.2 2.3-3.5 5.3-3.5 8.5z"></path></svg>
                                Edit
                            </button>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="applicantGeneral">
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <div class="form-group mb-0 mt-3">
                                            <img src="/img/cox.png" class="img-thumbnail" height="200" width="200">
                                        </div>
                                    </div>
                                    <fieldset class="mx-3 mb-1 px-3" style="border: 1px solid;">
                                        <legend style="width: 150px;">Personal Info</legend>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label class="inline-block text-left" style="width: 100px;" >Name:</label> 
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
                                                    <label>DOB:</label>
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
                                    </fieldset>
                                    <fieldset class="mx-3 my-1 px-3" style="border: 1px solid; width:764px;">
                                        <legend style="width: 140px;">Contact Info</legend>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="text" value="Joe.bloggs@average.com" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone:</label>
                                                    <input type="text" value="N/A" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Mobile:</label>
                                                    <input type="text" value="0211319819" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="m-3 px-3" style="border: 1px solid;">
                                        <legend style="width: 100px;">Address</legend>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address 1:</label>
                                                    <input type="text" value="123 Fake St" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address 2:</label>
                                                    <input type="text" value="" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Suburb:</label>
                                                    <input type="text" value="Clifton" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>City:</label>
                                                    <input type="text" value="Cruella De ville" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Post Code:</label>
                                                    <input type="text" value="9812" readonly class="form-control-plaintext" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>  
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantPhysical">
                            <div class="row">
                                <fieldset class="mx-3 mt-3 px-3" style="border: 1px solid; width:764px;">
                                    <div class="row pt-3">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Height:</label>
                                                <input type="text" value="5 feet 9 inches" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Weight:</label>
                                                <input type="text" value="90kg" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Expected Weight:</label>
                                                <input type="text" value="120kg" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                        <div class="form-group">
                                            <label>Sporting Experience:</label>
                                            <textarea rows="4" cols="50" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar tellus vel nulla feugiat, id vehicula tortor tincidunt. Sed auctor rutrum nibh, sit amet suscipit risus porttitor eget. Aliquam in diam nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean ut leo quis eros tempus porta. Nunc at tellus a erat pulvinar efficitur quis ac tellus. Phasellus porttitor dolor ut mauris venenatis, nec feugiat nisl cursus. Proin risus massa, tempor nec sagittis eu, faucibus eget erat. Suspendisse fermentum nulla non velit condimentum, ut fermentum urna faucibus."
                                                readonly class="form-control-plaintext" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                        <div class="form-group">
                                            <label>Boxing Experience:</label>
                                            <textarea rows="4" cols="50" placeholder="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec pulvinar tellus vel nulla feugiat, id vehicula tortor tincidunt. Sed auctor rutrum nibh, sit amet suscipit risus porttitor eget. Aliquam in diam nisl. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Aenean ut leo quis eros tempus porta. Nunc at tellus a erat pulvinar efficitur quis ac tellus. Phasellus porttitor dolor ut mauris venenatis, nec feugiat nisl cursus. Proin risus massa, tempor nec sagittis eu, faucibus eget erat. Suspendisse fermentum nulla non velit condimentum, ut fermentum urna faucibus."
                                                readonly class="form-control-plaintext" ></textarea>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantAdditional">
                            <div class="row">
                                <fieldset class="mx-3 mt-3 px-3" style="border: 1px solid; width:764px;">
                                    <div class="row pt-3">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Occupation:</label>
                                                <input type="text" value="Male" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Employer:</label>
                                                <input type="text" value="Male" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Conviction Details:</label>
                                                <input type="text" value="120kg" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Can Secure Sponsor:</label>
                                                <input type="text" value="120kg" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Consents to drug test:</label>
                                                <input type="text" value="120kg" readonly class="form-control-plaintext" />
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End More Info Modal -->

<!-- Add applicants to team modal -->
<div class="modal fade" id="editTeamModal" tabindex="-1" role="dialog" aria-labelledby="Edit Team" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">Edit Team Membership</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        <p id="modal-message"></p>

                        <div class="form-group">
                            <label for="team-select">Select team to add to:</label>
                            <select class="form-control" name="team" id="team-select">
                                <option value="red">Red</option>
                                <option value="blue">Blue</option>
                            </select>
                        </div>

                        <button data-dismiss="modal" id="confirmAddToTeam" role="button" onclick="addSelectedToTeam({{$event->id}})" class="btn btn-success">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End add to team modal -->
@endsection