<div class="mt-4">
    <h3 class="d-inline">{{$event->name}} : Auction</h3>
</div>

<hr>

<div class="row">
    <div class="col-md-12">
        <!-- Tabs -->
        <div>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tab" data-toggle="tab" href="#tab-active" id="activeItems">Current Items</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tab" data-toggle="tab" href="#tab-deleted" id="deletedItems">Deleted Items</a>
                </li>
            </ul>
        </div>

        <div class="tab-content">
            <div class="tab-pane {{ (app('request')->input('tab') != 'deleted')? 'active': '' }}" role="tabpanel" id="tab-active">
                <table id="auction-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Donor</th>
                            <th>Donor URL</th>
                            <th>Picture</th>
                            <th>Bout</th>
                            <th>Time</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->auction_items as $item)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="dtable-checkbox form-check-input dtable-control" value="checkedvalue">
                                </div>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->desc}}</td>
                            <td>{{$item->donor}}</td>
                            <td><a href="{{$item->donor_url}}">{{$item->donor_url}}</a></td>
                            <td><img src={{$item->picture}} alt={{$item->picture}} height=100 width=100></td>
                            <td>{{$item->bout}}</td>
                            <td>{{$item->approximate_time}}</td>
                            <td>
                                <form action="{{route('admin.auctionManagement.destroy', ['itemID' => $item->id])}}" method="POST">
                                    @csrf
                                    <button class="btn btn-danger mt-4" type="submit"><i class="far fa-times-circle"></i> Delete Item</button>
                                    {{method_field('DELETE')}}
                                </form>
                            <td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="tab-pane {{ (app('request')->input('tab') == 'deleted')? 'active': '' }}" role="tabpanel" id="tab-deleted">
                <table id="auctionDeleted-dtable" class="table table-striped table-hover table-sm">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Donor</th>
                            <th>Donor URL</th>
                            <th>Date Deleted</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($event->auction_items()->onlyTrashed()->get() as $item)
                        <tr>
                            <td>
                                <div class="form-check">
                                    <input type="checkbox" class="dtable-checkbox form-check-input dtable-control" value="checkedvalue">
                                </div>
                            </td>
                            <td>{{$item->name}}</td>
                            <td>{{$item->desc}}</td>
                            <td>{{$item->donor}}</td>
                            <td>{{$item->donor_url}}</td>
                            <td>{{$item->deleted_at->format('d M Y')}}</td>
                            <td>
                                <form action="{{route('admin.auctionManagement.restore', ['itemID' => $item->id])}}" method="POST">
                                    @csrf
                                    <button class="btn btn-info mt-2" type="submit"><i class="far fa-check-circle"></i> Restore Item</button>
                                    {{method_field('PATCH')}}
                                </form>
                            <td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>