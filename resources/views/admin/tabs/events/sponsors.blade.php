<h3 class="mt-4">{{$event->name}} Sponsors</h3>

<hr>

<div class="row">

    <div class="col-12">
        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Sponsor List</h4>
            </div>

            <div class="card-body">
                <table class="table">

                    <thead>
                        <th>View</th>
                        <th>Company Name</th>
                        <th class="text-right">Remove</th>
                    </thead>

                    @if(count($event->sponsors) > 0) @foreach($event->sponsors as $sponsor)
                    <tr>
                        <td>{{$sponsor->company_name}}</td>

                        <td>
                            <a class="btn btn-primary mr-2" href="{{route('admin.sponsorManagement.view', $sponsor->id)}}"><i class="fas fa-search-plus"></i></a>                          
                        </td>

                        <td>
                            <form class="d-inline-block float-right" action="{{route('admin.sponsorManagement.removeFromEvent', ['SponsorID' => $sponsor->id, 'eventID' => $event->id])}}"
                                method="POST">
                                @csrf {{method_field('DELETE')}}
                                <button role="submit" class="btn btn-danger"><i class="fas fa-minus"></i></button>
                            </form>
                        </td>
                    </tr>
                    @endforeach @else
                    <h4 class="text-center">There are no sponsors set for this event.</h4>
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>