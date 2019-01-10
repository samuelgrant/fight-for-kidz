@extends('admin.layouts.app')
@section('page')
<!-- Breadcrumbs-->
<ol class="breadcrumb">
    <li class="breadcrumb-item">
        <a href="{{route('admin.dashboard')}}">Dashboard</a>
    </li>
    <li class="breadcrumb-item">
        <a href="{{route('admin.groupManagement')}}">Merchandise Management</a>
    </li>
</ol>

<!-- Page Content -->
<div class="row">
    <div class="col-md-12">
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" role="tab" data-toggle="tab" href="#tab-active" id="activeItems">Current Merchandise</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" data-toggle="tab" href="#tab-deleted" id="deletedItems">Deleted Merchandise</a>
                </li>
                <span class="float-right">
                    <button class="btn btn-sm btn-success my-1 ml-1" onclick="merchandiseCreateModal()"><i class="fas fa-plus"></i>&nbsp;Add Item</button>
                </span>
            </ul>
            
        </div>

        <div class="w-100 p-3">
        <div class="mx-auto text-center">
            {{Form::open(['action' => ['admin\MerchandiseManagementController@toggleAll'], 'method' => 'PUT'])}}
            <h5 class="d-inline-block mr-3">Merchandise page is {{App\SiteSetting::getSettings()->display_merch ? 'ENABLED' : 'DISABLED'}}</h5>
            <label class="switch align-middle">
                    <input type="checkbox" {{App\SiteSetting::getSettings()->display_merch ? 'checked' : ''}} onchange="this.form.submit()">
                    <span class="slider round"></span>
            </label> {{Form::close()}}
        </div>
        </div>
        
        <div class="tab-content">
            <!-- Tab 1 -->
            <div class="tab-pane active" role="tabpanel" id="tab-active">
                <table id="merchandise-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Tagline:</th>
                            <th>Description</th>
                            <th>Picture</th>
                            <th>Price</th>
                            <th></th><!--Hide-->
                            <th></th><!--Edit-->
                            <th></th><!--Delete-->
                        </tr>                         
                    </thead>
                    <tbody>
                        @foreach($merch as $item)
                        <tr>
                            <td class="align-middle">{{$item->name}}</td>
                            <td class="align-middle">{{$item->tagline}}</td>
                            <td class="align-middle">{{$item->desc}}</td>
                            <td><img src="{{file_exists(public_path('storage/images/merchandise/' . $item->id . '.png')) ? '/storage/images/merchandise/' . $item->id . 
                                '.png' : '/storage/images/merchandise/0.png'}}" height=100>
                            </td>
                            <td class="align-middle">{{$item->price}}</td>
                            <td class="align-middle">
                                <form class="d-inline" action="{{route('admin.merchandiseManagement.toggleMerchandiseItem', ['itemID' => $item->id])}}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-primary"><i class="far {{$item->item_visible ? 'fa-eye-slash' : 'fa-eye'}}"></i>&nbsp;{{$item->item_visible ? 'Hide' : 'Show'}}</button>    
                                </form>
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-warning" onclick="merchandiseEditModal({{$item->id}})"><i class="fas fa-pencil"></i>&nbsp;Edit</button>
                            </td>
                            <td class="align-middle">
                                <form action="{{route('admin.merchandiseManagement.destroy', ['merchandiseID' => $item->id])}}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger" type="submit"><i class="far fa-times-circle"></i> Delete</button>
                                    {{method_field('DELETE')}}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Tab 2 -->
            <div class="tab-pane" role="tabpanel" id="tab-deleted">
                <table id="merchandiseDeleted-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                            <th>Name</th>
                            <th>Tagline:</th>
                            <th>Description</th>
                            <th>Date Deleted:</th>
                            <th></th><!--Restore-->
                    </thead>
                    <tbody>
                        @foreach($deletedMerch as $item)
                        <tr>
                            <td class="align-middle">{{$item->name}}</td>
                            <td class="align-middle">{{$item->tagline}}</td>
                            <td class="align-middle">{{$item->desc}}</td>
                            <td class="align-middle">{{$item->deleted_at}}</td>
                            <td class="align-middle">
                                <form action="{{route('admin.merchandiseManagement.restore', ['merchandiseID' => $item->id])}}" method="POST">
                                    @csrf
                                    <button class="btn btn-info" type="submit"><i class="far fa-check-circle"></i>&nbsp;Restore</button>
                                    {{method_field('PATCH')}}
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Create / edit merchandise item modal -->
<div class="modal fade" id="createEditMerchandiseItemModal" tabindex="-1" role="dialog" aria-labelledby="Edit Team" aria-hidden="true" >
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark text-white">
                <h4 class="modal-title" id="merchandiseModalTitle"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form id="merchandiseForm" method="POST" action="{{route('admin.merchandiseManagement.store')}}" enctype="multipart/form-data">
                <input id="hiddenMethod" type="hidden" name="_method" value="POST">
                @csrf
                <div class="form-group">
                    <label for="merchandiseName">Item name:</label>
                    <input  type="text" class="form-control" name="name" id="merchandiseName" placeholder="*required"  required>
                </div>

                <div class="form-group">
                    <label for="merchandiseTagline">Item tagline:</label>
                    <input  type="text" class="form-control" name="tagline" id="merchandiseTagline">
                </div>

                <div class="form-group">
                    <label for="merchandiseDescription">Item description:</label>
                    <input  type="text" class="form-control" name="description" id="merchandiseDescription"  placeholder="*required" required>
                </div>


                <div class="form-group">
                    <label for="merchandisePrice">Item price:</label><br>
                    <span>$&nbsp;</span><input  type="text" class="form-control d-inline w-50" name="price" id="merchandisePrice" required>
                </div>

                <div class="card w-50 mx-auto text-center mb-3">
                        <label for="logo">Item Image:</label>
                        <img class="logoPreview img-fluid" id="imgPreview" src="/storage/images/noImage.png">
                        <label for="itemImage" class="btn btn-primary btn-sm mb-0">Change
                            <input type="file" name="itemImage" id="itemImage" class="form-control" hidden>
                        </label>
                    </div>
                
                <button type="submit" id="merchandiseModalButton" class="btn btn-success float-right"></button>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
<!-- End create / edit merchandise item modal -->
@endsection