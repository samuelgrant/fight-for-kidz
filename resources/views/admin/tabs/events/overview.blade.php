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
                    <tr>
                        <td>Buy Tickets (Seats)</td>
                        <td><a href="{{$event->ticket_seller_url}}">{{$event->ticket_seller_url}}</a></td>
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
                                    </label> {{Form::close()}}

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