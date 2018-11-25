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
            <div class="form-group w-100">
                <div class="d-inline-block">
                    <table>
                        <tr>
                            <td><a data-href="{{route('admin.mail.preview', ['messageText' => null])}}" href="" target="_blank" class="btn btn-info btn-lg d-inline px-5" id="mailPreviewBtn"><i class="fas fa-print"></i>&nbsp;&nbsp;Preview Email</a></td>
                            <td>
                                <button type="button" id="sendBtn" class="btn btn-primary btn-lg d-inline px-5" id="mailSendBtn"><i class="fas fa-envelope"></i>&nbsp;&nbsp;Send Email</button>
                                <button type="button" id="abortSendBtn" style="min-width:150px" class="btn btn-danger btn-lg d-none"><i class="fas fa-times"></i>&nbsp;Abort</button>
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td class="text-center" id="promptText"><small>You will be prompted to confirm.</small></td>
                        </tr>
                    </table>
                </div>
                <div class="float-right">                    
                    <button type="submit" id="confirmSendBtn" class="btn btn-success btn-lg d-none"><i class="fas fa-check"></i>&nbsp;Confirm Send?</button>                    
                </div>
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