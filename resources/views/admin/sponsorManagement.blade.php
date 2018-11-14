@extends('admin.layouts.app') 
@section('page')

<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active"><a href="{{route('admin.sponsorManagement')}}">Sponsor Management</a></li>
    <li class="breadcrumb-item active">{{$sponsor->company_name}}</li>
</ol>


<div class="row">

    <div class="col-lg-6">
        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Sponsor Details</h4>
                <span class="float-right">
                    <button role="button" data-toggle="modal" data-target="#sponsorDetailsModal" class="btn btn-primary float-right">
                        <i class="fas fa-cog"></i>&nbsp; Edit Details
                    </button> 
                </span>
            </div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Company Name:</td>
                        <td>{{$sponsor->company_name}}</td>
                    </tr>
                    <tr>
                        <td>Contact Name:</td>
                        <td>{{$sponsor->contact_name}}</td>
                    </tr>
                    <tr>
                        <td>Phone:</td>
                        <td>{{$sponsor->contact_phone}}</td>
                    </tr>
                    <tr>
                        <td>Email:</td>
                        <td>{{$sponsor->email}}</td>
                    </tr>
                    <tr>
                        <td>Website URL:</td>
                        <td>{{$sponsor->url}}</td>
                    </tr>
                    <tr>
                        <td>Logo:</td>
                        <td><img style="max-width:250px" class="img-fluid" src="/storage/images/sponsors/{{file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')) ? $sponsor->id : '0' }}.png"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6">

        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Sponsorships</h4>
                <span class="float-right">
                    <button role="button" data-toggle="modal" data-target="#sponsorshipAddModal" class="btn btn-primary float-right">
                        <i class="fas fa-plus"></i>&nbsp; Add sponsorship
                    </button> 
                </span>
            </div>

            <div class="card-body">
                <table class="table table-striped">
                    @if(count($sponsor->events) > 0)
                    @foreach($sponsor->events as $event)
                    <tr>
                        <td>
                            <h4 class="d-inline-block">{{$event->name}}</h4>
                            <a class="float-right" data-toggle="collapse" href="#{{$event->id}}-collapse"><i class="fas fa-caret-down"></i></a>
                            <div class="collapse mt-3" id="{{$event->id}}-collapse">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5 class="mb-1">Bouts:</h5>
                                        <p>{{count($sponsor->bouts()->where('event_id', $event->id)->get())}} bouts sponsored</p>
                                    </div>
                                    <div class="col-sm-6">
                                        <h5 class="mb-1">Fighters:</h5>
                                        @if(count($sponsor->contenders()->where('event_id', $event->id)->get()) > 0)
                                        @foreach($sponsor->contenders()->where('event_id', $event->id)->get() as $contender)
                                        <p class="mb-0">{{$contender->getFullName()}}</p>
                                        @endforeach
                                        @else
                                        <p class="mb-0">No fighters sponsored</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>               
                    </tr>
                    @endforeach
                    @else
                        <h4 class="text-center">This sponsor has not sponsored any events yet.</h4>
                    @endif
                </table>
            </div>
        </div>

    </div>

</div>

{{-- Edit sponsor modal --}}
<div class="modal fade" id="sponsorDetailsModal" tabindex="-1" role="dialog" aria-labelledby="Edit Sponsor Details" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Edit Sponsor Details</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.sponsorManagement.update', ['sponsorID' => $sponsor->id])}}" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="companyName">Company Name:</label>
                        <input type="text" name="companyName" id="companyName" class="form-control" value="{{$sponsor->company_name}}" required>
                    </div>
                    <div class="form-group">
                        <label for="contactName">Contact Name:</label>
                        <input type="text" name="contactName" id="contactName" class="form-control" value="{{$sponsor->contact_name}}">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone:</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{$sponsor->contact_phone}}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email:</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{$sponsor->email}}" required>
                    </div>
                    <div class="form-group">
                        <label for="url">Website URL:</label>
                        <input type="url" name="url" id="url" class="form-control" value="{{$sponsor->url}}">
                    </div>
                    <div class="card w-50 mx-auto text-center mb-3">
                        <label for="logo">Logo:</label>
                        <img class="logoPreview img-fluid" id="logoPreview" src="/storage/images/sponsors/{{file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')) ? $sponsor->id : '0' }}.png">
                        <label for="logoInput" class="btn btn-primary">Change
                            <input type="file" name="logo" id="logoInput" class="form-control" hidden>
                        </label>
                    </div>
                    @csrf {{method_field('PATCH')}}
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- End Edit Sponsor Details Modal -->

{{-- Add sponsorship modal --}}
<div class="modal fade" id="sponsorshipAddModal" tabindex="-1" role="dialog" aria-labelledby="Add Sponsorship" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">Add Sponsorship</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body text-center">
                    <h5>Select which event to sponsor:</h5>
                    <form method="post" action="{{route('admin.sponsorManagement.addToEvent', ['sponsorID' => $sponsor->id])}}">
                        <select class="form-control" name="eventID" required>
                            @foreach(App\Event::all() as $event)
                            @if(!$sponsor->events->contains($event))
                            <option value="{{$event->id}}">{{$event->name}}</option>
                            @endif
                            @endforeach
                        </select>
                        <br>
                        @csrf
                        <button type="submit" class="btn btn-success">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end sponsorship add modal --}}

@endsection