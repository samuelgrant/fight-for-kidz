<div class="mt-1">
    <h3 class="d-inline-block my-3">{{$event->name}} : Applications</h3>
    <span class="float-right d-inline-block">
            <div class="d-inline-block gray-card mr-5">
				<p class="mb-0">Set team for selected applicants:</p>
				<span>
						<button class="btn btn-warning" onclick="removeSelectedFromTeam()">No team</button>
						<button class="btn btn-primary" onclick="addSelectedToTeam('blue')">Blue</button>
						<button class="btn btn-danger" onclick="addSelectedToTeam('red')">Red</button>
				</span>
            </div>
            
            <div class="d-inline-block gray-card">
				<p class="mb-0 text-center">Export All</p>
				<a class="btn btn-info" href="{{route('admin.eventManagment.downloadApplicants', [$event->id])}}"><i class="fas fa-file-excel"></i>&nbsp; Download</a>
			</div>
        </span>
</div>

<hr>

<table id="applicant-dtable" class="table table-striped table-hover table-sm">
    <thead>
        <tr>
            <th></th>
            <th>Team</th>
            <th>Name</th>
            <th>Age</th>
            <th>Gender</th>
            <th>Height (cm)</th>
            <th>Current Weight (kg)</th>
            <th>Expected Weight (kg)</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($event->applicants as $applicant)
        <tr>
            <td>
                <div class="form-check">
                    <input type="checkbox" class="dtable-checkbox form-check-input dtable-control" id="{{$applicant->id}}" value="checkedvalue"
                        data-applicant-id="{{$applicant->id}}">
                </div>
            </td>
            <td>
                @if($applicant->contender != null) @if($applicant->contender->team == 'red')
                <span class="badge badge-danger">Red</span> @elseif($applicant->contender->team == 'blue')
                <span class="badge badge-primary">Blue</span> @endif @endif
            </td>
            <td>{{$applicant->first_name . ' ' . $applicant->last_name}}</td>
            <td>{{$applicant->getAge()}}</td>
            @if($applicant->is_male)
            <td>M</td>
            @else
            <td>F</td>
            @endif
            <td>{{$applicant->height}}</td>
            <td>{{$applicant->current_weight}}</td>
            <td>{{$applicant->expected_weight}}</td>
            <td>
                <button class="btn btn-info" type="button" onclick="applicantManagementModal({{$applicant->id}})"><i class="fal fa-info-circle"></i> More Info</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>