@extends('admin.layouts.app') @section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">E-Mails</li>
</ol>



<!-- Page Content -->
<div class="row">
    <div class="col-md-12">

        <h3>Send Mail</h3>
        
        <form class="form" enctype="multipart/form-data" method="POST" action="{{route('admin.mail.send')}}" id="mailForm" data-send-action="{{route('admin.mail.send')}}" data-target-group="{{$targetGroup ?? null}}">            

            <div class="form-group my-3">
                <label for="multipleGroupSelect">Select Email Recipients:</label>
                {{-- target group selector --}}
                <select name="target_groups[]" class="multi-select form-control" id="multipleGroupSelect" style="margin-top:-15px" multiple="multiple">   
                    
                    <optgroup label="Custom Groups">                    
                        @foreach(App\Group::all() as $group)                    
                            <option value="group-{{$group->id}}">{{$group->name}}</option>
                        @endforeach
                    
                    <optgroup label="Misc" style="text-align: left">
                        <option value="subscribers">Subscribers</option>
                        <option value="admins">Administrators</option>

                    @foreach(App\Event::all()->sortByDesc('datetime') as $event)
                        <optgroup label="{{$event->name}}">
                            <option value="red-{{$event->id}}">Red Fighters - {{\Carbon\Carbon::parse($event->datetime)->format('Y')}}</option>
                            <option value="blue-{{$event->id}}">Blue Fighters - {{\Carbon\Carbon::parse($event->datetime)->format('Y')}}</option>
                            <option value="applicants-{{$event->id}}">Applicants - {{\Carbon\Carbon::parse($event->datetime)->format('Y')}}</option>
                            <option value="sponsors-{{$event->id}}">Sponsors - {{\Carbon\Carbon::parse($event->datetime)->format('Y')}}</option>
                    @endforeach                                                
                    
                </select> 
                <input type="checkbox" style="opacity: 0; position: relative; top: -35px; left:125px" oninvalid="this.setCustomValidity('Please select a recipient group')" oninput="setCustomValidity('')" id="hiddenCheck" required> 
            </div>           

            <div class="form-group">
                <label for="subject">Subject</label>
                <input type="text" name="subject" id="subject" class="form-control" placeholder="" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea name="messageText" id="messageText" class="form-control" placeholder="" rows="12" required></textarea>
            </div>
            <div class="form-group">
				<label class="btn btn-primary" for="fileUpload"><i class="fas fa-paperclip"></i>&nbsp;Select Attachments
					<input type="file" multiple="multiple" id="fileUpload" name="messageAttachments[]" class="d-none">
				</label>
				<span class="ml-3 gray-card d-none" id="fileName"></span>
				<span id="clearAttachmentsBtn" class="times-circle-btn d-none"><i class="fas fa-times-circle"></i></span>
            </div>
            <div class="form-group w-100">
                <div class="d-inline-block">
                    <table>
                        <tr>
                            <td><button type="button" class="btn btn-info btn-lg px-5" id="mailPreviewBtn" data-url="{{route('admin.mail.preview')}}"}><i class="fas fa-print"></i>&nbsp;&nbsp;Preview Email</button></td>
                            <td>
                                <button type="button" id="sendBtn" class="btn btn-primary btn-lg d-inline px-5" data-toggle="modal" data-target="#confirmSendModal">
                                    <i class="fas fa-envelope"></i>&nbsp;&nbsp;Send Email
                                </button>
                                <button type="submit" class="d-none" id="mailFormSubmitBtn"></button>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center" id="promptText"><small>You will be prompted to confirm.</small></td>
                        </tr>
                    </table>
                </div>
            </div>
            @csrf
        </form>
    </div>
</div>
@endsection

@section('scripts')

    {{-- Preselect recipient group when navigating here from a group 'email to group' button --}}
    <script>
        
        $(document).ready(function(){
            groupID = $('#mailForm').data('targetGroup');
            if(groupID != null) {
                // find the element for the group in the dropdown and 'click'
                option = $("[data-value='" + groupID + "']");
                option.click();
            }
        })

    </script>

    {{-- Ckeditor --}}
    <script>
        var editor = CKEDITOR.replace( 'messageText', {
    language: 'en',
    extraPlugins: 'notification'
});

editor.on( 'required', function( evt ) {
    editor.showNotification( 'This field is required.', 'warning' );
    evt.cancel();
} );
    </script>




{{-- Confirm send modal --}}
<div id="confirmSendModal" class="modal fade" role="dialog" tabindex="-1" data-url="{{route('admin.mail.getRecipients')}}">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title bg-dark text-white">Confirm Email Send</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white"
                        aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <p>Email will be sent to <span id="noOfEmails"></span> email addresses.</p>

                <button class="btn btn-primary mb-3" type="button" data-toggle="collapse" data-target="#recipientList">
                    See recipients &nbsp;&nbsp;<i class="fas fa-angle-down"></i>
                </button>

                <div class="collapse mb-3" id="recipientList">

                    <table class="table">
                        <thead>
                            <th>Email Address</th>
                            <th>Name</th>
                        </thead>
                        <tbody id='recipientTableBody'>

                        </tbody>
                    </table>
                </div>

                <div>
                    <button class="btn btn-danger" type="button" data-dismiss="modal">Cancel</button>
                    <button class="btn btn-success float-right" type="button" data-dismiss="modal" id="confirmSendBtn"><i class="fas fa-check"></i>&nbsp;&nbsp;SEND</button>
                </div>

            </div>
        </div>
    </div>
</div>










@endsection