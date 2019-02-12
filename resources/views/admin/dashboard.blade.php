@extends('admin.layouts.app')
@section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item active">
        Dashboard
    </li>
</ol>

<!-- Page Content -->

<div class="row" style="display: flex">

    {{-- Current event card --}}
    <div class="col-lg-6 pb-4">
        <div class="card border-primary h-100">
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
                    <tr>
                        <td>Charity logo:</td>
                        <td>
                            <img class="img-fluid" style="max-width: 160px; max-height: 100px"  src="/storage/images/charity/{{file_exists(public_path('storage/images/charity/' . $event->id . '.png')) ? $event->id : '0' }}.png">
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    {{-- End of current event card --}}

    {{-- Applications card --}}
    <div class="col-lg-6 pb-4">
        <div class="card border-primary h-100">
            <div class="card-header bg-primary text-white">
                <small>{{$event->name}}</small>
                <br>
                <h4 class="text-white d-inline-block mb-0">Pending Applications</h4>
                <span class="float-right"><a class="btn btn-primary" href="/a/event-management/{{$event->id}}?tab=applicants"><i class="fas fa-search"></i>&nbsp; View Applicants</a></span>
            </div>
            <div class="card-body text-center">

                <h5 class="d-inline-block mb-1">Applications are {{$event->open ? 'OPEN' : 'CLOSED'}}</h5>

                <hr>

                <div class="gray-card mt-2">
                    <h3 class="text-center">Applications Received</h3>
                    <h2 class="text-grey text-center">{{count($event->applicants)}}</h2>
                </div>

                <hr>

                <div class="row">
                    <div class="col-6">
                        <div class="gray-card">
                            <h3 class="text-center">Blue Fighters Selected</h3>
                            <h2 class="text-center">{{count($event->getTeam('blue'))}}</h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="gray-card">
                            <h3 class="text-center">Red Fighters Selected</h3>
                            <h2 class="text-center">{{count($event->getTeam('red'))}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- End of applications card --}}

    {{-- Site settings card --}}
    <div class="col-lg-6 pb-4">
        <div class="card border-primary h-100">
            
            <div class="card-header bg-primary text-white">
                <h4 class="text-white d-inline-block mb-0">Other Website Settings</h4>                
                <span class="float-right"><button class="btn btn-primary" data-target="#siteSettingsModal" onclick="setSettingsModal({{$settings->display_merch}}, '{{$settings->about_us}}')" id="editSettingsButton" data-toggle="modal"><i class="fas fa-cogs"></i>&nbsp; Edit</button></span>
            </div>

            <div class="card-body">

                <h5 class="mb-4 text-center">Merchandise page is {{$settings->display_merch ? 'ENABLED' : 'DISABLED'}}</h5>

                <div class="row d-flex">
                    <div class="col-lg-8">
                        <h5>About Us</h5>
                        <p id="aboutUsText" class="text-justify">{{$settings->about_us}}</p>
                    </div>
    
                    <div class="col-lg-4">
                        <h5>Main Page Image</h5>
                        <img class="img-fluid" src="/storage/images/mainPagePhoto.jpg?{{filemtime(storage_path('app/public/images/mainPagePhoto.jpg'))}}" alt="Main Page Image">
                    </div>
                </div>

            </div>
            
        </div>
    </div>
    {{-- End of site settings card --}}

    {{-- File uploads card --}}
    <div class="col-lg-6 pb-4">
        <div class="card border-primary h-100">
            
            <div class="card-header bg-primary text-white">
                <h4 class="text-white d-inline-block mb-0">File Uploads</h4>                
                <span class="float-right"><button class="btn btn-primary" data-target="#uploadModal" data-toggle="modal"><i class="fas fa-plus"></i>&nbsp; Upload File</button></span>
            </div>

            <div class="card-body">               

                @if(count(App\Document::all()) > 0)
                <table class="table table-striped table-sm">

                    <thead>
                        <th>File Name</th>
                        <th>Location</th>
                        <th class="text-right">Actions</th>
                    </thead>

                    <tbody>

                        @foreach(App\Document::all() as $doc)

                            <tr>
                                <td>{{$doc->originalName}}</td>
                                <td>{{$doc->display_location}}</td>
                                <td class="text-right">
                                    <button type="button" onclick="fileUpdateModal({{$doc->id}})" class="btn btn-primary btn-sm d-inline-block"><i class="fas fa-cogs"></i></button>
                                    <form class="d-inline-block" action="{{route('admin.deleteFile', ['docID' => $doc->id])}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                            </tr>

                        @endforeach

                    </tbody>

                </table>
                @else
                
                <h5 class="text-center mt-5">There are no files to display!</h5>
                
                @endif

            </div>
            
        </div>
    </div>
    {{-- End of file uploads card --}}

</div>

{{-- site settings modal --}}
<div id="siteSettingsModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="Site Settings" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Website Settings</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.updateSettings')}}" method="POST" enctype="multipart/form-data">

                <div class="form-group w-100 text-center">
                    <h5 class="mb-3">Enable Merchandise Page</h5>
                    <label class="switch align-middle">
                            <input name="displayMerch" id="displayMerchCheckbox" type="checkbox" {{$settings->display_merch ? 'checked' : ''}}>
                            <span class="slider round"></span>
                    </label>
                </div>                
                
                <div class="form-group">
                    <label class="mb-1" for="aboutUs"><h5>About Us</h5></label>
                    <textarea class="form-control" rows="5" name="aboutUs" id="aboutUs">{{$settings->about_us}}</textarea>
                </div>

                <div class="form-group">

                    <h5>About Us Photo</h5>

                    {{-- Image preview --}}
                    <img src="/storage/images/mainPagePhoto.jpg" class="img-fluid mb-2" id="imgPreview">
                    <br>
                    <label class="btn btn-info btn-sm btn-file">
                        <i class="fas fa-upload"></i> Select Image
                        <input type="file" name="mainPagePhoto" id="mainPagePhoto" class="d-none">
                    </label> 
                    <small>file must be jpg less than 2MB</small>             
                </div>

                {{method_field('PATCH')}}
                <div class="float-right">
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save Changes</button>
                </div>     
                @csrf               
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end of site settings modal --}}

{{-- file upload modal --}}
<div id="uploadModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Upload new file</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form action="{{route('admin.uploadFile')}}" method="POST" enctype="multipart/form-data">
            
                <div class="form-group">
                    <label class="btn btn-success" for="fileUpload">
                        Select File
                        <input type="file" id="fileUpload" name="uploaded" hidden required>
                    </label>
                    <span id="fileName" class="ml-3">No file selected</span>
                </div>

                <hr>

                <div class="form-group">
                    <label for="displaySelect">Where should this file be downloadable from?</label>
                    <select id="displaySelect" name="location" class="form-control">
                        <option value="Home/About Us">About Us (Home Page)</option>
                        <option value="Event">Main Event Page</option>
                        <option value="Fighter App">Fighter Application Page</option>
                        <option value="Sponsor Enquiry">Sponsor Enquiry Page</option>
                        <option value="Table Enquiry">Table Enquiry Page</option>
                    </select>
                </div>

                <div class="float-right">
                    <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                    <button class="btn btn-primary" type="submit">Save File</button>
                </div>     
                @csrf               
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end of file upload modal --}}

{{-- file update modal --}}
<div id="updateModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h4 class="modal-title">Update file download location</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="fileUpdateForm" action="" data-action="{{route('admin.updateFile', ['docID' => null])}}" method="POST">
                    
                    <div class="form-group">
                        <label for="updateDisplaySelect">Where should this file be downloadable from?</label>
                        <select id="updateDisplaySelect" name="location" class="form-control">
                                <option value="Home/About Us">About Us (Home Page)</option>
                                <option value="Event">Main Event Page</option>
                                <option value="Fighter App">Fighter Application Page</option>
                                <option value="Sponsor Enquiry">Sponsor Enquiry Page</option>
                                <option value="Table Enquiry">Table Enquiry Page</option>
                                <option value="General Enquiry">General Enquiry Page</option>
                        </select>
                    </div>
    
                    <div class="float-right">
                        <button type="button" data-dismiss="modal" class="btn btn-danger">Cancel</button>
                        <button class="btn btn-primary" type="submit">Save Changes</button>
                    </div>     
                    @csrf  
                    @method('PATCH')             
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- end of file update modal --}}


@endsection