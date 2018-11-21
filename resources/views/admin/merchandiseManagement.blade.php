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
            </ul>
        </div>
        
        <div class="tab-content">
            <!-- Tab 1 -->
            <div class="tab-pane active" role="tabpanel" id="tab-active">
                <table id="merchandise-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
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
                            <td class="align-middle">{{$item->desc}}</td>
                            <td class="align-middle"></td>
                            <td class="align-middle">{{$item->price}}</td>
                            <td>
                                {{-- {!!Form::open([ 'method' => 'POST']) !!}
                                @if($user->active)
                                <button class="btn btn-info w-100" type="submit"><i class="far fa-eye-slash"></i>&nbsp;Hide</button>
                                @else
                                <button class="btn btn-info w-100" type="submit"><i class="far fa-eye"></i>&nbsp;Show</button>
                                @endif
                                {{Form::hidden('_method', 'put')}}
                                {!! Form::close() !!} --}}
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-warning" ><i class="fas fa-pencil"></i>&nbsp;Edit</button>
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
                            <th>Description</th>
                            <th>Date Deleted:</th>
                            <th></th><!--Restore-->
                    </thead>
                    <tbody>
                        @foreach($deletedMerch as $item)
                        <tr>
                            <td class="align-middle">{{$item->name}}</td>
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
@endsection