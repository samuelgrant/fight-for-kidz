@extends('admin.layouts.app')
@section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        Dashboard
    </li>
</ol>

<!-- Page Content -->

<div class="row">

    {{-- Current event card --}}
    <div class="col-lg-6">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <small>Upcoming Event:</small>
                <br>
                <h4 class="text-white d-inline-block mb-0">{{$event->name}}</h4>
                <span class="float-right"><a class="btn btn-primary" href="/a/event-management/{{$event->id}}"><i class="fas fa-cogs"></i>&nbsp; Manage</a></span>
            </div>
            <div class="card-body">
                <table class="table">
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

    {{-- Applications card --}}
    <div class="col-lg-6">
        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                <small>{{$event->name}}</small>
                <br>
                <h4 class="text-white d-inline-block mb-0">Pending Applications</h4>
                <span class="float-right"><a class="btn btn-primary" href="/a/event-management/{{$event->id}}?tab=applicants"><i class="fas fa-search"></i>&nbsp; View</a></span>
            </div>
            <div class="card-body">
                <h3 class="text-center">Applications Received</h3>
                <h2 class="text-grey text-center">{{count($event->applicants)}}</h2>

                <br>

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

@endsection