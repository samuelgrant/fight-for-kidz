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
        <table id="sponsor-dtable" class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Company name</th>
                    <th>Contact</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Website</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sponsors as $sponsor)
                <tr>
                    <td>{{$sponsor->company_name}}</td>
                    <td>{{$sponsor->contact_name ?? '-'}}</td>
                    <td>{{$sponsor->contact_phone}}</td>
                    <td>{{$sponsor->email}}</td>
                    <td>{{$sponsor->url ?? '-'}}<td>
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
                <form method="post" action="{{route('admin.sponsorManagement.store')}}">

                    to be constructed

                </form>
            </div>
        </div>
    </div>
</div>

@endsection