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
        <form class="form">

            

            {{-- target group selector --}}
            <select name="target_groups" class="multi-select form-control" multiple>
                <optgroup label="System Groups">
                <hr>
                <option value="all">All Contacts</option>
                <option value="admins">Administrators</option>
                <option value="applicants">{{App\Event::current()->name}} Applicants</option>
                <option value="sponsors">Sponsors</option>
                <option value="subscribers">Subscribers</option>

            </select>

            <div class="form-group">
                <label for="">Subject</label>
                <input type="text" name="" id="" class="form-control" placeholder="">
            </div>
            <div class="form-group">
              <label for="">Message:</label>
              <textarea name="message" id="" class="form-control" placeholder="" rows="12"></textarea>
              <small id="helpId" class="text-muted float-right">0/5000</small>
            </div>
            <div class="d-block mx-auto">
                <button class="btn btn-info d-inline my-2 px-5"><i class="fas fa-exclamation-triangle"></i> Preview Email</button>
                <button class="btn btn-primary d-inline my-2 px-5"><i class="fas fa-exclamation-triangle"></i> Send Email</button>
            </div>
        </form>
    </div>
</div>
@endsection