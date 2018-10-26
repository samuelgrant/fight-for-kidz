<h3 class="d-inline-block">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h3>
<a class="float-right" data-toggle="collapse" href="#{{$contender->id}}-collapsable">Details &nbsp;<i class="fas fa-caret-down"></i></a>

<div class="collapse" id="{{$contender->id}}-collapsable">

    <div class="row">

        <div class="col-md-6">

            <table class="table table-sm">
                <tr>
                    <td>Nickname: {{$contender->nickname ?? 'tbc'}}</td>
                </tr>
                <tr>
                    <td>Sponsor: {{$contender->sponsor ? $contender->sponsor->company_name : 'tbc'}}</td>
                </tr>
                <tr>
                    <td>Height: {{$contender->height}} cm</td>
                </tr>
                <tr>
                    <td>Weight: {{$contender->weight}} kgs</td>
                </tr>
                <tr>
                    <td>Reach: {{$contender->reach}} cm</td>
                </tr>
            </table>

        </div>

        <div class="col-md-6 text-center">

        <img src="{{file_exists(public_path('/storage/images/contenders/' . $contender->id . '.png')) ? '/storage/images/contenders/' . $contender->id . '.png' : '/storage/images/contenders/0.png'}}" class="d-block mx-auto mb-1 img-fluid err-image">
            <button class="btn btn-primary">Change</button>

        </div>

        <div>

            Bio video URL: {{$contender->bio_url}}

        </div>

    </div>

</div>