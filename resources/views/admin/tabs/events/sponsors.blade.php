<h3 class="mt-4">{{$event->name}} Sponsors</h3>

<hr>

<div class="row">

    <div class="col-12">
        <div class="card border-primary mb-2">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Sponsor List</h4>
            </div>

            <div class="card-body">

				@if(count($event->sponsors) < 4)
				<div class="alert alert-warning">
					<p class="text-center mb-0">Please be aware that sponsors will not display on the event page until at least 4 sponsors have been added.</p>
				</div>
				@endif

				@if(count($event->sponsors) > 0)
                <table class="table table-hover" id="event-sponsor-dtable">

                    <thead>                        
						<th>Company Name</th>
						<th>Logo</th>
						<th></th>
                    </thead>

                   <tbody>
                   	 @foreach($event->sponsors as $sponsor)
	                    <tr>
							<td>{{$sponsor->company_name}}</td>
							<td>
								<img class="img-fluid" style="max-width: 160px; max-height: 100px" src="/storage/images/sponsors/{{file_exists(public_path('storage/images/sponsors/' . $sponsor->id . '.png')) ? $sponsor->id : '0' }}.png">
							</td>
							<td>
								<span class="float-right">
									<a class="btn btn-primary mr-2" href="{{route('admin.sponsorManagement.view', $sponsor->id)}}" target="_blank"><i class="fas fa-search-plus"></i>&nbsp; View Details</a>
									<form class="d-inline-block" action="{{route('admin.sponsorManagement.removeFromEvent', ['SponsorID' => $sponsor->id, 'eventID' => $event->id])}}"
									 method="POST">
										@csrf {{method_field('DELETE')}}
										<button role="submit" class="btn btn-danger"><i class="fas fa-minus"></i>&nbsp; Remove from event</button>
									</form>
								</span>
							</td>
						</tr>
	                    @endforeach @else
                   </tbody>
                    <h4 class="text-center">There are no sponsors set for this event.</h4>
                    @endif
                </table>
            </div>
        </div>
    </div>

</div>