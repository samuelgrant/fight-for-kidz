<div class="mt-4">
        <h3 class="d-inline">{{$event->name}} : Bout Management</h3>
        <span class="float-right btn btn-success" onclick="addBout({{$event->id}})"><i class="fas fa-plus"></i>&nbsp;Add Bout</span>
    </div>

    <hr>

    <div>
    <h5>Bouts are currently {{$event->show_bouts ? 'visible' : 'hidden'}} on the public event page.</h5>
    <form class="d-inline" action="{{route('admin.eventManagement.toggleBouts', ['eventID' => $event->id])}}" method="POST">
        @csrf
        @method('PUT')
    <button type="submit" class="btn btn-primary"><i class="far {{$event->show_bouts ? 'fa-eye-slash' : 'fa-eye'}}"></i>&nbsp;{{$event->show_bouts ? 'Hide bouts' : 'Show bouts'}}</button>    
    </form>
    </div>

    <hr>

    @if(count($event->bouts) > 0)
    <div class="row" style="display: flex">
    <?php global $i; ?> {{-- Counter that is used to name bouts --}}                
        @foreach($event->bouts as $bout)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="card boutMgmt-card border-primary h-100">
                <div class="card-header boutMgmt-header bg-primary text-white">
                    <h4 class="mb-0 d-inline">Bout {{++$i}}</h4> {{-- Counter increments, then prints --}}
                    <span class="btn btn-primary float-right" onclick="removeBout({{$bout->id}})"><i class="fas fa-trash"></i></span>
                </div>
                <div class="card-body boutMgmt-body">

                    {{-- This alert will show if either the blue or red contender is missing, and will inform the admin that the bout
                            will not be displayed on the public site --}}
                    @if(!$bout->contendersSet())
                        <div role="alert" class="alert alert-warning">
                            <p class="mb-0">This bout will not display on the public website until both a blue and red contender have been assigned!</p>
                        </div>
                    @endif


                    <form data-bout-id="{{$bout->id}}" action="{{route('admin.eventManagement.updateBoutDetails', ['boutId' => $bout->id])}}"
                        data-red-id="{{$bout->red_contender_id ?? '0'}}" data-blue-id="{{$bout->blue_contender_id ?? '0'}}" data-sponsor-id="{{$bout->sponsor_id ?? '0'}}"
                        data-winner-id="{{$bout->victor_id ?? '0'}}" data-video-url="{{$bout->video_url}}"
                        method="POST">
                        <div class="form-group">
                            <label for="sponsor-select-{{$bout->id}}">Bout Sponsor</label>
                            <select name="sponsor" id="sponsor-select-{{$bout->id}}" class="form-control sponsor-select">
                                <option value="0">---</option>
                                @foreach($event->sponsors as $sponsor)
                                    <option value="{{$sponsor->id}}">{{$sponsor->company_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="blue-select-{{$bout->id}}">Blue Corner</label>
                            <select name="blue" id="blue-select-{{$bout->id}}" class="form-control blue-select">
                                <option value="0">---</option>
                                @foreach($event->getTeam('blue') as $contender)
                                    <option value="{{$contender->id}}">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="red-select-{{$bout->id}}">Red Corner</label>
                            <select name="red" id="red-select-{{$bout->id}}" class="form-control red-select">
                                <option value="0">---</option>
                                @foreach($event->getTeam('red') as $contender)
                                    <option value="{{$contender->id}}">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="winner-{{$bout->id}}">Winner</label>
                            <select name="winner" id="winner-{{$bout->id}}" class="form-control winner-select">
                                <option value="0">---</option>
                                @if($bout->red_contender)
                                    <option value="{{$bout->red_contender->id}}">(Red) {{$bout->red_contender->getFullName()}}</option>
                                @endif
                                @if($bout->blue_contender)
                                    <option value="{{$bout->blue_contender->id}}">(Blue) {{$bout->blue_contender->getFullName()}}</option>
                                @endif
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="video-{{$bout->id}}">Video URL:</label>
                            <input class="form-control video-url" type="text" name="video" id="video-{{$bout->id}}" placeholder="Enter video url">
                        </div>

                        <div class="form-group float-right mb-0" style="display:none" id="bout-buttons" class='bout-buttons-div'>                                    
                            <button id="cancel-button" class="btn btn-danger mr-2">Cancel</button>
                            <input type="submit" id="save-button" class="btn btn-success float-right" value="Save Changes">
                        </div>

                        @csrf
                        {{method_field('PATCH')}}
                    </form>
                </div>
            </div>
        </div>        
        @endforeach

    </div>
    @else
        <h4 class="text-center">There are no bouts set for this event.</h4>
    @endif