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
                                    <div class="input-group">
                                        <input type="text" name="contenderDonateUrl" id="contenderDonateUrl" class="form-control" value="">
                                        <span class="ml-3" data-toggle="tooltip" data-placement="top" 
                                        title="Required format: https://www.example.com"><i class="fas fa-info-circle float-right"></i></span>
                                    </div>
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
                            <div class="input-group">
                                <input type="text" name="contenderBioUrl" id="contenderBioUrl" class="form-control" value="">
                                <span class="ml-3" data-toggle="tooltip" data-placement="top" title="This must go to a youtube video url only!">
                                    <i class="fas fa-exclamation-circle float-right"></i></span>
                            </div>
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
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantPersonal" class="nav-link">Personal</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantEmergency" class="nav-link">Emergency</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantMedical1" class="nav-link">Medical 1</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantMedical2" class="nav-link">Medical 2</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantAdditional" class="nav-link">Additional</a></li>
                        <li class="nav-item"><a role="tab" data-toggle="tab" href="#applicantCustom" class="nav-link">Custom</a></li>
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
                                                    <input type="text" id="appFirstName"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Last Name:</label> 
                                                    <input type="text" id="appLastName"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Fight Name:</label>
                                                    <input type="text" id="appFightName"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Age:</label>
                                                    <input type="text" id="appAge"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>DOB:</label>
                                                    <input type="text" id="appDob"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Gender:</label>
                                                    <input type="text" id="appGender"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="mx-3 my-1 px-3" style="border: 1px solid; width:764px;">
                                        <legend style="width: 140px;">Contact Info</legend>
                                        <div class="row">
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone 1:</label>
                                                    <input type="text" id="appPhone1"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Phone 2:</label>
                                                    <input type="text" id="appPhone2"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Email:</label>
                                                    <input type="text" id="appEmail"  readonly class="form-control-plaintext gray-card" />
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
                                                    <input type="text" id="appAddress1"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Address 2:</label>
                                                    <input type="text" id="appAddress2"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Suburb:</label>
                                                    <input type="text" id="appSuburb"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>City:</label>
                                                    <input type="text" id="appCity"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Post Code:</label>
                                                    <input type="text" id="appPostCode"  readonly class="form-control-plaintext gray-card" />
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>  
                                </div>
                            </form>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantPersonal">
                            <div class="row">
                                <fieldset class="mx-3 mt-3 px-3" style="border: 1px solid; width:764px;">
                                    <div class="row pt-3">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Height:</label>
                                                <input type="text" id="appHeight"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Current Weight:</label>
                                                <input type="text" id="appWeightC"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Expected Weight:</label>
                                                <input type="text" id="appWeightE"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <p id="fitnessLevel"></p>
                                            </div >
                                            <div class="col-lg-6 col-md-6 col-sm-6">
                                                <p id="dominantHand"></p>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                            <div class="form-group">
                                                <label>Boxing/Kickboxing/Martial Arts Experience:</label>
                                                <textarea rows="4" cols="50" id="appBoxingExperience"  readonly class="form-control-plaintext gray-card" ></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Sporting Experience:</label>
                                            <textarea rows="4" cols="50" id="appSportingExperience"  readonly class="form-control-plaintext gray-card" ></textarea>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 col-md-12 col-sm-12 px-0">
                                            <div class="form-group">
                                                <label>Hobbies/Interests:</label>
                                                <textarea rows="4" cols="50" id="hobbies"  readonly class="form-control-plaintext gray-card" ></textarea>
                                            </div>
                                        </div>
                                </fieldset>
                            </div>
                        </div>
                        <div role="tabpane" class="tab-pane" id="applicantEmergency">
                            <fieldset class="mx-0 mt-3 mb-2 px-3" style="border: 1px solid;">
                                <legend style="width:150px;">Personal Info</legend>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>First Name:</label> 
                                            <input type="text" id="appEmergencyFirstName"  readonly class="form-control-plaintext gray-card" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Last Name:</label> 
                                            <input type="text" id="appEmergencyLastName"  readonly class="form-control-plaintext gray-card" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Relationship</label> 
                                            <input type="text" id="appEmergencyRelationship"  readonly class="form-control-plaintext gray-card" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset class="mx-0 mt-3 mb-1 px-3" style="border: 1px solid;">
                                <legend style="width: 140px;">Contact Info</legend>
                                <div class="row">
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone 1:</label>
                                            <input type="text" id="appEmergencyPhone1"  readonly class="form-control-plaintext gray-card" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Phone 2:</label>
                                            <input type="text" id="appEmergencyPhone2"  readonly class="form-control-plaintext gray-card" />
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Email:</label>
                                            <input type="text" id="appEmergencyEmail"  readonly class="form-control-plaintext gray-card" />
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantMedical1">
                            <fieldset class="mx-0 my-1 px-3" style="border: 1px solid;">
                                <legend style="width: 180px;">Previous History</legend>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Heart Disease:</label>
                                            <input type="text" id="appHeartDisease" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Breathlessness:</label>
                                            <input type="text" id="appBreathlessness" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Epilepsy:</label>
                                            <input type="text" id="appEpilepsy" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Heart Attack:</label>
                                            <input type="text" id="appHeartAttack" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Stroke:</label>
                                            <input type="text" id="appStroke" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Heart Surgery:</label>
                                            <input type="text" id="appHeartSurgery" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Respiratory:</label>
                                            <input type="text" id="appRespiratoryProblems" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Cancer:</label>
                                            <input type="text" id="appCancer" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Irregular Heartbeat:</label>
                                            <input type="text" id="appIrregularHeatbeat" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Smoking:</label>
                                            <input type="text" id="appSmoking" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Joint Problems:</label>
                                            <input type="text" id="appJointProblems" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Chest Pain:</label>
                                            <input type="text" id="appChestPain" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Hypertension:</label>
                                            <input type="text" id="appHypertension" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Surgery:</label>
                                            <input type="text" id="appSurgery" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>Dizziness/fainting:</label>
                                            <input type="text" id="appDizzinessFainting" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <div class="form-group">
                                            <label>High Cholesterol:</label>
                                            <input type="text" id="appCholesterol" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Other:</label>
                                            <textarea rows="4" cols="50" id="appOther"  readonly class="form-control-plaintext gray-card"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Medically Supervised Activity:</label>
                                                <input type="text" id="appHeartCondtion" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Chest pain brought on by physical activity:</label>
                                                <input type="text" id="appPhysicalChestPain" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Onset of Recent Chest Pain:</label>
                                                <input type="text" id="appRecentChestPain" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                                <div class="form-group">
                                                    <label>Passed out due to dizziness:</label>
                                                    <input type="text" id="appPassedOut" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                                </div>
                                            </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Bone or Joint Problems:</label>
                                                <input type="text" id="appBoneJointProblems" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Medication for Blood Pressure or Heart:</label>
                                                <input type="text" id="appMedicationBloodHeart" readonly class="form-control-plaintext gray-card" style="width: 40px;" />
                                            </div>
                                        </div>
                                    </div>
                            </fieldset>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="applicantMedical2">
                            <fieldset class="mx-0 my-1 mt-3 px-3" style="border: 1px solid; width:764px;">
                                <div class="row  pt-3">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Explain your losses of consciousness:</label>
                                            <textarea rows="4" cols="50" id="appConcussed"  readonly class="form-control-plaintext gray-card"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Is there any reason why you shouldn't participate:</label>
                                            <textarea rows="4" cols="50" id="appReason"  readonly class="form-control-plaintext gray-card"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Hand injuries:</label>
                                            <textarea rows="4" cols="50" id="appHandInjuries"  readonly class="form-control-plaintext gray-card"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Previous significant injuries (especially head injuries):</label>
                                            <textarea rows="4" cols="50" id="appPreviousCurrentInjuries"  readonly class="form-control-plaintext gray-card"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Current Medication:</label>
                                            <textarea rows="4" cols="50" id="appCurrentMedicaton"  readonly class="form-control-plaintext gray-card"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </div> 
                        <div role="tabpanel" class="tab-pane" id="applicantAdditional">
                            <div class="row">
                                <fieldset class="mx-3 mt-3 px-3" style="border: 1px solid; width:764px;">
                                    <div class="row pt-3">
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Occupation:</label>
                                                <input type="text" id="appOccupation"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Employer:</label>
                                                <input type="text" id="appEmployer"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Can Secure Sponsor:</label>
                                                <input type="text" id="appSponsor"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-6 col-sm-12">
                                            <div class="form-group">
                                                <label>Consents to drug test:</label>
                                                <input type="text" id="appConsent"  readonly class="form-control-plaintext gray-card" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>Conviction Details:</label>
                                                <textarea rows="4" cols="50" id="appConvictionDetails"  readonly class="form-control-plaintext gray-card"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        {{-- start of custom answers --}}
                        <div role="tabpanel" class="tab-pane" id="applicantCustom">
                            <div class="row">
                                <fieldset class="mx-3 mt-3 px-3" style="border: 1px solid; width:764px;">
                                    <div class="row pt-3">

                                        <?php
                                            global $qNum; // counter to keep question and answer tied together
                                        ?>

                                        @foreach($event->customQuestions as $question)
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label>{{$question->text}}</label>
                                                @if($question->type == "Yes/No")
                                                    <input type="text" id="custom_{{++$qNum}}"  readonly class="form-control-plaintext gray-card" />
                                                @elseif($question->type == "Text")
                                                    <textarea rows="3" id="custom_{{++$qNum}}" readonly class="form-control-plaintext gray-card"></textarea>
                                                @endif
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        {{-- end of custom answers --}}
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
                            <img class="logoPreview img-fluid" id="imgPreview">
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