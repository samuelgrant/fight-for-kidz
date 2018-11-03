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
                <form method="post" action="{{route('admin.sponsorManagement.store')}}">

                    to be constructed

                </form>
            </div>
        </div>
    </div>
</div>

@endsection