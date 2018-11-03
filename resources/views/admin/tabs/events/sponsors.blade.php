<h3 class="mt-4">{{$event->name}} Sponsors</h3>

<hr>

<div class="row">

    <div class="col-lg-6">
        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Sponsor List</h4>
            </div>

            <div class="card-body">
                <table class="table">
                    @foreach($event->sponsors as $sponsor)
                    <tr>
                        <td>{{$sponsor->company_name}}
                            <form class="d-inline-block float-right" 
                                action="{{route('admin.sponsorManagement.removeFromEvent', ['SponsorID' => $sponsor->id, 'eventID' => $event->id])}}"
                                method="POST">
                                @csrf
                                {{method_field('DELETE')}}
                                <button role="submit" class="btn btn-warning"><i class="fas fa-minus"></i></button> 
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>