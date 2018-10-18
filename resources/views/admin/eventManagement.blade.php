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
            <div class="tab-pane " role="tabpanel" id="tab-1">
                <div class="row">
                    
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-2">
                <div class="row">
                   
                </div>
            </div>
            <div class="tab-pane" role="tabpanel" id="tab-3">
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
            <div class="tab-pane" role="tabpanel" id="tab-4">
                <div class="row">
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection