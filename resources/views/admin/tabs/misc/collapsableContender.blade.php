<h3 class="d-inline-block">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h3>
<a class="float-right" data-toggle="collapse" href="#{{$contender->id}}-collapsable">Details &nbsp;<i class="fas fa-caret-down"></i></a>

<div class="collapse mt-3" id="{{$contender->id}}-collapsable">

    {{-- edit / remove buttons --}}
    <div class="mb-2">
        <button class="btn btn-primary" onclick="editContenderModal({{$contender->id}})">Edit Details</button> 
        <input type="submit" class="btn btn-warning" onclick="removeContenderFromTeam({{$contender->applicant->id}})" value="Remove from team">            
    </div>

    <div class="row">

        <div class="col-md-6">

            <table class="table table-sm">
                <tr>
                    <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Nickname:</span> {{$contender->nickname ?? 'tbc'}}</td>
                </tr>
                <tr>
                    <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Sponsor:</span> {{$contender->sponsor ? $contender->sponsor->company_name : 'tbc'}}</td>
                </tr>
                <tr>
                    <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Height:</span> {{$contender->height}} cm</td>
                </tr>
                <tr>
                    <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Weight:</span> {{$contender->weight}} kgs</td>
                </tr>
                <tr>
                    <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Reach:</span> {{$contender->reach}} cm</td>
                </tr>
            </table>

        </div>

        <div class="col-md-6 text-center">

        {{-- check if a photo exists for the contender, otherwise use 0.png - the silouhette image --}}
        <img src="{{file_exists(public_path('/storage/images/contenders/' . $contender->id . '.png')) ? '/storage/images/contenders/' . $contender->id . '.png' : '/storage/images/contenders/0.png'}}" 
            class="d-block mx-auto mb-2 img-fluid err-image">

        </div>

        <div class="w-100 p-3">

            <table class="table table-sm">
                    <tr>
                    <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Bio video URL:</span> {{$contender->bio_url}}</td>
                    </tr>
                    <tr>
                        <td><span class="badge {{$contender->team == 'blue' ? 'badge-primary' : 'badge-danger'}}">Bio Text:</span> {{$contender->bio_text}}</td>
                    </tr>
            </table>
        </div>
    </div>
</div>