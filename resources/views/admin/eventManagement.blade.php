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
                    
                    <div class="col-md-4">
                    <div class="card border-primary">
                    
                        <div class="card-header bg-primary text-white">
                            <h4 class="mb-0">Event Details</h4>
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

                            <div class="card-footer">
                                <button data-toggle="modal" data-target="#eventDetailsModal" class="btn btn-primary float-right">Edit Details</button>
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
                
                    {{-- @foreach($event->bouts as $bout) --}}
                    <div class="col-md-4">
                        <div class="card boutMgmt-card border-primary">
                            <div class="card-header boutMgmt-header bg-primary">
                                <h4 class="mb-0">Bout One</h4>
                            </div>
                            <div class="card-body boutMgmt-body">
                                <form>
                                    <div class="form-group">
                                        <label for="sponsor-select">Bout Sponsor</label>
                                        <select name="sponsor" id="sponsor-select" class="form-control">
                                            <option value="1">Hunter and Sons</option>
                                            <option value="2">Harvey Norman</option>
                                            <option value="3">The Warehouse Invercargill</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="blue-select">Blue Corner</label>
                                        <select name="blue" id="blue-select" class="form-control">
                                            <option value="1">Joe Blogg</option>
                                            <option value="2">Harvey Norman</option>
                                            <option value="3">John Doe</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="red-select">Red Corner</label>
                                        <select name="red" id="red-select" class="form-control">
                                            <option value="1">Hunter Robinson</option>
                                            <option value="2">Michael Williams</option>
                                            <option value="3">Gary Woodhouse</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    {{-- @endforeach --}}

                </div>
            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'contenders') ? 'active': ''}}" role="tabpanel" id="tab-3">
                
                <div class="mt-4">
                    <h3>{{$event->name}} : Contenders</h3>
                </div>

                <hr>
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
                                <button class="btn btn-info" type="submit" data-toggle="modal" data-target="#moreInfoModal"><i class="fal fa-info-circle"></i> More Info</button>
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
<div class="modal fade" id="eventDetailsModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Edit Event Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
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
<div class="modal fade" id="moreInfoModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">More Info</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End More Info Modal -->
@endsection