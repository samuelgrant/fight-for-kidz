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
        
        <form class="form" method="POST" action="{{route('admin.mail.send')}}" id="mailForm" data-send-action="{{route('admin.mail.send')}}" data-target-group="{{$targetGroup ?? null}}">            

            <div class="form-group my-3">
                <label for="multipleGroupSelect">Select Email Recipients:</label>
                {{-- target group selector --}}
                <select name="target_groups[]" class="multi-select form-control" id="multipleGroupSelect" style="margin-top:-15px" multiple="multiple">
                    <optgroup label="System Groups">                        
                        <option value="admins">Administrators</option>
                        <option value="applicants">{{App\Event::current()->name}} Applicants</option>
                        <option value="sponsors">Sponsors</option>
                        <option value="subscribers">Subscribers</option>
                    <optgroup label="Custom Groups">                    
                        @foreach(App\Group::all() as $group)                    
                            <option value="{{$group->id}}">{{$group->name}}</option>
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
              <small id="helpId" class="text-muted float-right">0/5000</small>
            </div>
            <div class="d-block mx-auto">
                <a data-href="{{route('admin.mail.preview', ['messageText' => null])}}" href="" target="_blank" class="btn btn-info d-inline my-2 px-5" id="mailPreviewBtn"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Preview Email</a>
                <button type="submit" class="btn btn-primary d-inline my-2 px-5" id="mailSendBtn"><i class="fas fa-exclamation-triangle"></i>&nbsp;&nbsp;Send Email</button>
            </div>
            @csrf
        </form>
    </div>
</div>
@endsection

@section('scripts')

    <script>
        
        $(document).ready(function(){
 
            groupID = $('#mailForm').data('targetGroup');
            console.log(groupID);
            // find the element for the group in the dropdown and add 'selected' class
            $(`[data-value='${groupID}']`).click();

        })

    </script>

@endsection