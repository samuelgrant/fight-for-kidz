<div class="mt-4">
    <h3 class="d-inline">{{$event->name}} : Auction</h3>
    <span class="float-right">
        <button class="btn btn-success" onclick="auctionCreateModal()"><i class="fas fa-plus"></i>&nbsp;Add Item</button>
    </span>
</div>

<hr>

<div>
<h5>Auctions are currently {{$event->show_auctions ? 'visible' : 'hidden'}} on the public event page.</h5>
<form class="d-inline" action="{{route('admin.eventManagement.toggleAuctions', ['eventID' => $event->id])}}" method="POST">
    @csrf
    @method('PUT')
    <label class="switch">
        <input type="checkbox" {{$event->show_auctions ? 'checked' : ''}} onchange="this.form.submit()">
        <span class="slider round"></span>
    </label>
</form>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" role="tab" data-toggle="tab" href="#tab-active" id="activeItems">Current Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" role="tab" data-toggle="tab" href="#tab-deleted" id="deletedItems">Deleted Items</a>
                </li>
            </ul>
        </div>
        
        <div class="tab-content">
            <!-- Tab 1 -->
            <div class="tab-pane active" role="tabpanel" id="tab-active">
                <table id="auction-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Description:</th>
                            <th>Donor:</th>
                            <th>Donor Url:</th>
                            <th>Picture:</th>
                            <th></th><!--Edit-->
                            <th></th><!--Delete-->
                        </tr>                         
                    </thead>
                    <tbody>
                        @foreach($event->auction_items as $item)
                        <tr>
                            <td class="align-middle">{{$item->name}}</td>
                            <td class="align-middle">{{$item->desc}}</td>
                            <td class="align-middle">{{$item->donor}}</td>
                            <td class="align-middle">{{$item->donor_url}}</td>
                            <td><img src="{{file_exists(public_path('storage/images/auction/' . $item->id . '.png')) ? '/storage/images/auction/' . $item->id . 
                            '.png' : '/storage/images/auction/0.png'}}" height=100 >
                            </td>
                            <td class="align-middle">
                                <button class="btn btn-warning" onclick="auctionEditModal({{$item->id}})"><i class="fas fa-pencil"></i>&nbsp;Edit</button>
                            </td>
                            <td class="align-middle">
                                <form action="{{route('admin.auctionManagement.destroy', ['itemID' => $item->id])}}" method="POST">
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
                <table id="auctionDeleted-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th>Name:</th>
                            <th>Description:</th>
                            <th>Donor:</th>
                            <th>Donor URL:</th>
                            <th>Date Deleted:</th>
                            <th></th><!--Restore-->
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->auction_items()->onlyTrashed()->get() as $item)
                        <tr>
                            <td class="align-middle">{{$item->name}}</td>
                            <td class="align-middle">{{$item->desc}}</td>
                            <td class="align-middle">{{$item->donor}}</td>
                            <td class="align-middle">{{$item->donor_url}}</td>
                            <td class="align-middle">{{$item->deleted_at->format('d M Y')}}</td>
                            <td class="align-middle">
                                <form action="{{route('admin.auctionManagement.restore', ['itemID' => $item->id])}}" method="POST">
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