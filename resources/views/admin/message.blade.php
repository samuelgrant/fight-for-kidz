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

<?php
    $contact = $msg->senderAsContact();
?>


<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Message Details</h4>
                <span class="float-right">                    
                    @if($contact == null)
                        <span>Sender not in your 'other contacts' list.</span>
                        <form class="form-inline d-inline ml-3" action="{{route('admin.contact.add')}}" method="post">
                            
                            <input name="name" type="hidden" value="{{$msg->name}}">
                            <input name="phone" type="hidden" value="{{$msg->phone}}">
                            <input name="email" type="hidden" value="{{$msg->email}}">                            
                            @csrf
                            <button type="submit" class="btn btn-info">Add to contacts &nbsp; <i class="fas fa-plus"></i></button>
                        </form>
                    @elseif($contact->name != $msg->name)
                        <span>Sender is in your 'other contacts' list under the name '{{$contact->name}}'.</span>
                        <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#addContactToGroupModal">Add contact to group &nbsp; <i class="fas fa-plus"></i></button>
                    @else
                        <span>Sender is in your 'other contacts' list.</span>
                        <button type="button" class="btn btn-info ml-3" data-toggle="modal" data-target="#addContactToGroupModal">Add contact to group &nbsp; <i class="fas fa-plus"></i></button>
                    @endif
                </span>
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

@if($contact)
<div class="modal fade" id="addContactToGroupModal" tabindex="-1" role="dialog"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Add message sender to group?</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">

                <p>Please select which group you would like to add this contact to:</p>

                @if($contact != null)
                    @if($contact->name != $msg->name)
                    <p>The existing contact under the name {{$contact->name}} will be copied to this group. If you want to change the name of this contact, you will neet to do so on 
                    the 'Group Management' page, under 'Other Contacts'.</p>
                    @endif
                @endif

                <form method="POST" action="{{route('admin.contact.addContactToGroup', ['contactId' => $contact->id])}}">                    

                    <select class="form-control mb-3" name="groupId">
                        @foreach(App\Group::all() as $group)
                            <option value="{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    </select>
                    @csrf
                    <button type="submit" class="btn btn-success">Add to Group</button>                    
                </form>

            </div>
        </div>
    </div>
</div>
@endif

@endsection