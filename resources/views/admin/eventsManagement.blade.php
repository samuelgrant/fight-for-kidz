@extends('admin.layouts.app') @section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Event Management</li>
</ol>


<!-- Page Content -->
<div class="row">  
    <div class="col-md-12">
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs nav-tabs-persistent">
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tab" data-toggle="tab" href="#tab-1" id="active">Current Events</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tab" data-toggle="tab" href="#tab-2" id="deleted">Deleted Events</a></li>
                <button class="btn btn-primary btn-sm ml-1 my-1 tab-modal" data-toggle="modal" data-target="#newEvent">New Event</button>
            </ul>
            <div class="tab-content">
                <div class="tab-pane {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tabpanel" id="tab-1">
                    <table id="event-dtable" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Charity</th>
                                <th>Public</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($events as $event)
                            <tr>
                                <td>{{strtotime($event->datetime)}}</td> {{-- Used for sorting by date --}}
                                <td>{{$event->name}}</td>
                                <td>{{\Carbon\Carbon::parse($event->datetime)->format('d M Y')}}</td>
                                <td>{{$event->venue_name}}</td>
                                <td>{{$event->charity}}</td>
                                <td>
                                    <form action="{{route('admin.eventManagement.togglePublic', ['eventID' => $event->id])}}" method="POST">                                    
                                        <label class="switch">
                                            <input type="checkbox" {{$event->is_public ? 'checked' : ''}} onchange="this.form.submit()">
                                            <span class="slider round"></span>
                                        </label>
                                        @method('PUT')
                                        @csrf
                                    </form>
                                </td>
                                <td>
                                    <a class="btn btn-primary" href="{{route('admin.eventManagement.view', ['eventID' => $event->id])}}"><i class="fas fa-edit"></i> Edit</a>
                                </td>
                                <td>
                                    <form action="{{route('admin.eventManagement.destroy', ['eventID' => $event->id])}}" method="POST">                                    
                                        <button class="btn btn-danger" type="submit"><i class="far fa-times-circle"></i> Delete Event</button>
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tabpanel" id="tab-2">
                    <table id="eventDeleted-dtable" class="table table-striped table-hover table-sm">
                        <thead>
                            <tr>
                                <th>Event ID</th>
                                <th>Name</th>
                                <th>Date</th>
                                <th>Venue</th>
                                <th>Charity</th>
                                <th>Public</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($deletedEvents as $event)
                            <tr>
                                <td>F4k-{{\Carbon\Carbon::parse($event->datetime)->format('Y')}}</td>
                                <td>{{$event->name}}</td>
                                <td>{{\Carbon\Carbon::parse($event->datetime)->format('d M Y')}}</td>
                                <td>{{$event->venue_name}}</td>
                                <td>{{$event->charity}}</td>
                                <td>{{($event->is_public)? "Yes":"No"}}</td>
                                <td>
                                    {!!Form::open(['action'=>['admin\EventManagementController@restore', $event->id], 'method'=> 'POST']) !!}
                                    <button class="btn btn-info" type="submit"><i class="far fa-times-circle"></i> Restore Event</button>
                                    {{Form::hidden('_method', 'patch')}} {!! Form::close() !!}
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
<!-- New Event Modal -->

<div class="modal fade" id="newEvent" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Create a New Event</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <form action="{{route('admin.eventManagement.store')}}" method="post">
                    <div class="form-group">
                        <label for="eventName">
                            <i class="fas fa-info-circle" data-toggle="tooltip" title="This is the event name;"></i>  
                            Event Name
                        </label>
                        <input type="text" name="eventName" id="eventName" class="form-control" placeholder="Fight for Kidz {{date('Y')}}" required>
                    </div>

                    <div class="form-group">
                        <label for="dateTime">
                                <i class="fas fa-info-circle" data-toggle="tooltip" title="The date and time of the main event; This can be used to display a countdown on the main page."></i>  
                            Date Time
                        </label>
                        <input type="datetime-local" name="dateTime" id="dateTime" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="venueName">
                            <i class="fas fa-info-circle" data-toggle="tooltip" title="Displayed under location; use the name of the venue."></i>  
                            Venue Name
                        </label>
                        <input type="text" name="venueName" id="venueName" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="venueAddress">
                            <i class="fas fa-info-circle" data-toggle="tooltip" title="Used for Google Maps; use the physical address or a well known name for the venue."></i>
                            Venue Address
                        </label>
                        <input type="text" name="venueAddress" id="venueAddress" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-success"><i class="far fa-check-circle"></i> Create Event</button>
                    @csrf
                </form>
            </div>
        </div>
    </div>
</div>
@endsection