<div class="mt-4">
    <h3 class="d-inline">{{$event->name}} : Auction</h3>
</div>

<hr>

<table id="auction-dtable" class="table table-striped table-hover table-sm">
    <thead>
        <tr>
            <th></th>
            <th>Name</th>
            <th>Description</th>
            <th>Donor</th>
            <th>Picture</th>
            <th>Bout</th>
            <th>Approximate Time</th>
        </tr>
    </thead>
    <tbody>
        @foreach($auctionItems as $item)
        <tr>
            <td>
                <div class="form-check">
                    <input type="checkbox" class="dtable-checkbox form-check-input dtable-control" value="checkedvalue">
                </div>
            </td>
            <td>{{$item->name}}</td>
            <td>{{$item->desc}}</td>
            <td>{{$item->donor}}</td>
            <td>{{$item->picture}}</td>
            <td>{{$item->bout}}</td>
            <td>{{$item->approximate_time}}</td>
        </tr>
        @endforeach
    </tbody>
</table>