<div class="mt-4">
    <h3 class="d-inline">{{$event->name}} : Applications</h3>
    <span class="float-right">
            <button class="btn btn-warning" onclick="removeSelectedFromTeam()"><i class="fas fa-minus"></i>&nbsp;Remove selected from team</button>
            <button class="btn btn-success" data-toggle="modal" data-target="#editTeamModal" onclick="countSelected('applicants')"><i class="fas fa-plus"></i>&nbsp;Add selected to team</button>
            <a class="btn btn-info" href="{{route('admin.eventManagment.downloadApplicants', [$event->id])}}"><i class="fas fa-file-excel"></i> Download</a>
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
                <button class="btn btn-info" type="button" onclick="applicantManagementModal({{$applicant->id}})"><i class="fal fa-info-circle"></i>&nbsp;More Info</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>