@extends('admin.layouts.app') @section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.messages')}}">Messages</a>
    </li>
    <li class="breadcrumb-item active">
        View Message
    </li>
</ol>


<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Message Details</h4>
            </div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Date Received</td>
                        <td>{{$msg->created_at}}</td>
                    </tr>
                    <tr>
                        <td>Event:</td>
                        <td>{{App\Event::find($msg->event_id)->name}}</td>
                    </tr>
                    <tr>
                        <td>Message Type:</td>
                        <td>{{$msg->message_type}}</td>
                    </tr>
                    <tr>
                        <td>Name:</td>
                        <td>{{$msg->name}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$msg->email}}</td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td>{{$msg->phone}}</td>
                    </tr>
                    @if($msg->message_type == 'Sponsor')
                    <tr>
                        <td>Sponsorship Type:</td>
                        <td>{{$msg->sponsorship_type}}</td>
                    </tr>
                    @endif
                    <tr>
                        <td>Message:</td>
                        <td>{{$msg->message}}</td>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection