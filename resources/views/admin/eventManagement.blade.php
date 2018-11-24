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
            <ul class="nav nav-tabs nav-tabs-persistent">
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'overview') || (app('request')->input('tab') == '') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-1" id="overview">Overview</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'sponsors') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-1-5" id="sponsors">Sponsors</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'bouts') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-2" id="bouts">Bouts</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'contenders') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-3" id="contenders">Contenders</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'applicants') ? 'active': '' }}"
                        role="tab" data-toggle="tab" href="#tab-4" id="applicants">Applicants</a></li>
                <li class="nav-item"><a class="nav-link {{ (app('request')->input('tab') == 'auction') ? 'active': '' }}"
                    role="tab" data-toggle="tab" href="#tab-5" id="auction">Auction</a></li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane {{(app('request')->input('tab') == '') || (app('request')->input('tab') == 'overview') ? 'active': ''}}" role="tabpanel" id="tab-1">

                @include('admin.tabs.events.overview')
                
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'sponsors') ? 'active': ''}}" role="tabpanel" id="tab-1-5">

                @include('admin.tabs.events.sponsors')
                    
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'bouts') ? 'active': ''}}" role="tabpanel" id="tab-2">
                
                @include('admin.tabs.events.bouts')

            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'contenders') ? 'active': ''}}" role="tabpanel" id="tab-3">
                
                @include('admin.tabs.events.contenders')              

            </div>

            <div class="tab-pane {{(app('request')->input('tab') == 'applicants') ? 'active': ''}}" role="tabpanel" id="tab-4">

                @include('admin.tabs.events.applicants')
                
            </div>
            <div class="tab-pane {{(app('request')->input('tab') == 'auction') ? 'active': ''}}" role="tabpanel" id="tab-5">
                
                @include('admin.tabs.events.auction')

            </div>
        </div>
    </div>
</div>

<!-- Edit Contender Details Modal - loads dynamically -->
<div class="modal fade" id="editContenderModal" tabindex="-1" role="dialog" aria-labelledby="Edit Contender Details" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">Edit Contender Details</h4>                    
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form method="post" id="editContenderForm" enctype="multipart/form-data" data-action="{{route('admin.eventManagement.updateContender', ['contenderID' => null])}}/" action="">
                        <div class="row">
                            <div class="col-lg-8">
                            <div class="form-group">
                                <label for="contenderFirstName">First Name:</label>
                                <input type="text" name="contenderFirstName" id="contenderFirstName" class="form-control" value="" required>
                            </div>
                            <div class="form-group">
                                <label for="contenderLastName">Last Name:</label>
                                <input type="text" name="contenderLastName" id="contenderLastName" class="form-control" value="" required>
                            </div>
                                <div class="form-group">
                                    <label for="contenderNickName">Nickname:</label>
                                    <input type="text" name="contenderNickname" id="contenderNickname" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="contenderSponsor">Sponsor:</label>
                                    <select class="form-control" id="contenderSponsor" name="contenderSponsor">
                                            <option value="0">--- No sponsor ---</option>
                                        @foreach($event->sponsors as $sponsor)
                                            <option value="{{$sponsor->id}}">{{$sponsor->company_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="contenderDonateUrl">Donate URL:</label>
                                    <input type="text" name="contenderDonateUrl" id="contenderDonateUrl" class="form-control" value="">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <label for="contenderHeight">Height:</label>
                                    <input type="text" name="contenderHeight" id="contenderHeight" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="contenderWeight">Weight:</label>
                                    <input type="text" name="contenderWeight" id="contenderWeight" class="form-control" value="">
                                </div>
                                <div class="form-group">
                                    <label for="contenderReach">Reach:</label>
                                    <input type="text" name="contenderReach" id="contenderReach" class="form-control" value="">
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="contenderBioUrl">Bio URL:</label>
                            <input type="text" name="contenderBioUrl" id="contenderBioUrl" class="form-control" value="">
                        </div>

                        <label for="contenderBio">Contender Bio:</label>
                        <textarea name="contenderBio" id="contenderBio" class="form-control mb-3"></textarea>

                        <label for="contenderImage">Contender Image:</label>
                        <input type="file" class="d-block mb-3" name="contenderImage" id="contenderImage">

                        @csrf
                        {{method_field('PATCH')}}
                        <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- End Edit Contender Details Modal -->

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
                        <label for="eventDesc">Description:</label>
                        <textarea name="eventDesc" id="eventDesc" class="form-control" required>{{$event->desc_1}}</textarea>
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
                    <div class="form-group">
                        <label for="ticketsWebsite">Buy Tickets (Seats) URL</label>
                        <input type="text" name="tickets" id="ticketWebsite" class="form-control" value="{{$event->ticket_seller_url}}">
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
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="applicantGeneral">
                            <form>
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-sm-12 text-center">
                                        <div class="form-group mb-0 mt-3">
                                            <img src="" id="appPhoto" data-route="{{route('admin.getApplicantImage', ['imageName' => null])}}/" class="img-thumbnail" height="200" width="200">
                                        </div>
                                    </div>
                                    <fieldset class="mx-3 mb-1 px-3" style="border: 1px solid;">
                                        <legend style="width: 150px;">Personal Info</legend>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>First Name:</label> 
                                                    <input type="text" id="appFirstName" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Last Name:</label> 
                                                    <input type="text" id="appLastName" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Fight Name:</label>
                                                    <input type="text" id="appFightName" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Age:</label>
                                                    <input type="text" id="appAge" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>DOB:</label>
                                                    <input type="text" id="appDob" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Gender:</label>
                                                    <input type="text" id="appGender" value='' readonly class="form-control-plaintext gray-card" />
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
                                                    <input type="text" id="appEmail" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone:</label>
                                                    <input type="text" id="appPhone" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Mobile:</label>
                                                    <input type="text" id="appMobile" value='' readonly class="form-control-plaintext gray-card" />
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
                                                    <input type="text" id="appAddress1" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address 2:</label>
                                                    <input type="text" id="appAddress2" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Suburb:</label>
                                                    <input type="text" id="appSuburb" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>City:</label>
                                                    <input type="text" id="appCity" value='' readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Post Code:</label>
                                                    <input type="text" id="appPostCode" value='' readonly class="form-control-plaintext gray-card" />
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
                                                <input type="text" id="appHeight" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Current Weight:</label>
                                                <input type="text" id="appWeightC" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Expected Weight:</label>
                                                <input type="text" id="appWeightE" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                        <p id="fitnessLevel"></p>
                                        <div class="form-group">
                                            <label>Sporting Experience:</label>
                                            <textarea rows="4" cols="50" id="appSportingExperience" placeholder="" readonly class="form-control-plaintext gray-card" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                        <div class="form-group">
                                            <label>Boxing/Kickboxing/Martial Arts Experience:</label>
                                            <textarea rows="4" cols="50" id="appBoxingExperience" placeholder="" readonly class="form-control-plaintext gray-card" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                            <div class="form-group">
                                                <label>Hobbies/Interests:</label>
                                                <textarea rows="4" cols="50" id="hobbies" placeholder="" readonly class="form-control-plaintext gray-card" ></textarea>
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
                                                <input type="text" id="appOccupation" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Employer:</label>
                                                <input type="text" id="appEmployer" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Can Secure Sponsor:</label>
                                                <input type="text" id="appSponsor" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Consents to drug test:</label>
                                                <input type="text" id="appConsent" value='' readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Conviction Details:</label>
                                                <textarea rows="4" cols="50" id="appConvictionDetails" placeholder='' readonly class="form-control-plaintext gray-card"></textarea>
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

                        <button data-dismiss="modal" id="confirmAddToTeam" role="button" onclick="addSelectedToTeam()" class="btn btn-success">Confirm</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- End add to team modal -->

<!-- Create / edit auction item modal -->
<div class="modal fade" id="createEditAuctionItemModal" tabindex="-1" role="dialog" aria-labelledby="Edit Team" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="auctionModalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                    <form id="auctionForm" method="POST" action="{{route('admin.auctionManagement.store', ['eventID' => $event->id])}}" enctype="multipart/form-data">
                    <input id="hiddenMethod" type="hidden" name="_method" value="POST">
                    @csrf
                    <div class="form-group">
                        <label for="auctionName">Item name:</label>
                        <input  type="text" class="form-control" name="name" id="auctionName" placeholder="*required"  required>
                    </div>

                    <div class="form-group">
                        <label for="auctionDescription">Item description:</label>
                        <input  type="text" class="form-control" name="description" id="auctionDescription"  placeholder="*required" required>
                    </div>

                    <div class="form-group">
                        <label for="auctionDonor">Item donor:</label>
                        <input  type="text" class="form-control" name="donor" id="auctionDonor">
                    </div>

                    <div class="form-group">
                        <label for="auctionDonorUrl">Item donor url:</label>
                        <input  type="text" class="form-control" name="donorUrl" id="auctionDonorUrl">
                    </div>

                    <div class="card w-50 mx-auto text-center mb-3">
                            <label for="logo">Item Image:</label>
                            <img class="logoPreview img-fluid" id="imgPreview" src="/storage/images/noImage.png">
                            <label for="itemImage" class="btn btn-primary mb-0">Change
                                <input type="file" name="itemImage" id="itemImage" class="form-control" hidden>
                            </label>
                        </div>
                    
                    <button type="submit" id="auctionModalButton" class="btn btn-success float-right"></button>

                    {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- End create / edit auction item modal -->
@endsection