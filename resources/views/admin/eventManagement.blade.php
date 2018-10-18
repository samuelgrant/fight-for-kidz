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
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'applicants') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-3" id="applicants">Applicants</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'auction')? 'active': '' }}"
                    role="tab" data-toggle="tab" href="#tab-4" id="auction">Auction</a></li>
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
                                <h5 class="mb-0">Event Details</h5>
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
                                <a href="#" class="btn btn-primary float-right">Edit Details</a>
                            </div>
                       
                       </div>
                   </div>

                </div>
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'bouts') ? 'active': ''}}" role="tabpanel" id="tab-2">
                <div class="row">
                   
                </div>
            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'applicants') ? 'active': ''}}" role="tabpanel" id="tab-3">
                
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
                                <input type="checkbox" class="form-check-input dtable-control" id="{{$applicant->id}}"
                                    value="checkedvalue">
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
                                <button class="btn btn-info" type="submit"><i class="fal fa-info-circle"></i> More Info</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'auction') ? 'active': ''}}" role="tabpanel" id="tab-4">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Event Details Modal -->
{{-- <div class="modal fade" id="addToGroupModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add a new contact to {{$group->name}}</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.group.addMember', [$group->id])}}">
                    <div class="form-group">
                        <label for="inviteeName">Name</label>
                        <input type="text" name="name" id="inviteName" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="inviteeName">Email</label>
                        <input type="email" name="email" id="inviteEmail" class="form-control" required>
                    </div>
                    @csrf
                    <button type="submit" class="btn btn-success"><i class="fas fa-user-plus"></i> Add person to Group</button>
                </form>
            </div>
        </div>
    </div> --}}
{{-- </div> <!-- End Edit Event Details Modal --> --}}

@endsection