@extends('admin.layouts.app')
@section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item active">Sponsor Management</li>
</ol>

<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <div class="mb-3">
            <button class="btn btn-success" data-toggle="modal" data-target="#addSponsorModal">Add New Sponsor</button>
        </div>
    </div>
    <div class="col-md-12">
        <table id="sponsor-dtable" class="table table-striped table-sm table-hover">
            <thead>
                <tr>
                    <th>Company name</th>
                    <th>Logo</th>
                    <th>Website</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($sponsors as $sponsor)
                <tr class="clickable-row" data-href="sponsor-management/{{$sponsor->id}}">
                    <td class="align-middle">{{$sponsor->company_name}}</td>
                    <td><img class="img-fluid" style="max-width: 200px;" src="/storage/images/sponsors/{{file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')) ? $sponsor->id : '0' }}.png"></td>
                    <td class="align-middle">{{$sponsor->url ?? '-'}}</td>
                    <td class="align-middle"></td>
                </tr>
                @endforeach
            </tbody>
        </table>  
    </div>
</div>

{{-- Add sponsor modal --}}
<div class="modal fade" id="addSponsorModal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title">Add New Sponsor</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.sponsorManagement.store')}}" enctype="multipart/form-data">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="companyName">Company Name:</label>
                            <input type="text" name="companyName" id="companyName" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="contactName">Contact Name:</label>
                            <input type="text" name="contactName" id="contactName" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label for="phone">Phone:</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email">Email:</label>
                            <input type="text" name="email" id="email" class="form-control" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="url">Website URL:</label>
                        <input type="url" name="url" id="url" class="form-control">
                    </div>
                    <div class="card w-50 mx-auto text-center mb-3">
                        <label for="logo">Logo:</label>                        
                        <img class="logoPreview img-fluid" id="logoPreview" src="/storage/images/sponsors/0.png">
                        <label for="logoInput" class="btn btn-primary">Change
                            <input type="file" name="logo" id="logoInput" class="form-control" hidden>
                        </label>
                    </div>
                    @csrf
                    <button class="btn btn-danger" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-edit"></i> Save Changes</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection