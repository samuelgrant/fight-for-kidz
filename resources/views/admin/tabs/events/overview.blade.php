<h3 class="mt-4">{{$event->name}} Overview</h3>

<hr>

<div class="row">

    <div class="col-lg-6 mb-3">
        <div class="card border-primary mb-2 h-100">

            <div class="card-header bg-primary text-white">
                <h4 class="mb-0 d-inline-block">Event Details</h4>
                <span class="float-right">
                    <button role="button" data-toggle="modal" data-target="#eventDetailsModal" class="btn btn-primary float-right">
                        <i class="fas fa-cog"></i>&nbsp; Edit Details
                    </button> 
                </span>
            </div>

            <div class="card-body">
                <table class="table">
                    <tr>
                        <td>Event Name:</td>
                        <td>{{$event->name}}</td>
                    </tr>
                    <tr>
                        <td>Event Date:</td>
                        <td>{{$event->datetime}}</td>
                    </tr>
                    <tr>
                        <td>Event Description:</td>
                        <td>{{$event->desc_1}}</td>
                    </tr>
                    <tr>
                        <td>Event Venue:</td>
                        <td>{{$event->venue_name}}</td>
                    </tr>
                    <tr>
                        <td>Venue Address:</td>
                        <td>{{$event->venue_address}}</td>
                    </tr>
                    <tr>
                        <td>Event Sponsor:</td>
                        <td>
                            @if(!$event->event_sponsor == "")
                            {{App\Sponsor::find($event->event_sponsor)->company_name}}
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Charity:</td>
                        <td>{{$event->charity}}</td>
                    </tr>
                    <tr>
                        <td>Charity Url:</td>
                        <td><a href="{{$event->charity_url}}">{{$event->charity_url}}</a></td>
                    </tr>
                    <tr>
                        <td>Charity logo:</td>
                        <td>
                            <img class="img-fluid" style="max-width: 160px; max-height: 100px"  src="/storage/images/charity/{{file_exists(public_path('storage/images/charity/' . $event->id . '.png')) ? $event->id : '0' }}.png">
                        </td>
                    </tr>
                    <tr>
                        <td>Buy Tickets (Seats) URL:</td>
                        <td><a href="{{$event->ticket_seller_url}}">{{$event->ticket_seller_url}}</a></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="col-lg-6 mb-3">
        <div class="card border-primary mb-2 h-100">
            <div class="card-header bg-primary text-white">
                <h4 class="text-white d-inline-block mb-0">Pending Applications</h4>
                <span class="float-right"><a class="btn btn-primary" href="/a/event-management/{{$event->id}}?tab=applicants"><i class="fas fa-search"></i>&nbsp; View</a></span>
            </div>
            <div class="card-body">

                <div class="mx-auto text-center">
                    {{Form::open(['action' => ['admin\EventManagementController@toggleApplications', $event->id], 'method' => 'PUT'])}}
                    <h5 class="d-inline-block mr-3">Applications are {{$event->open ? 'OPEN' : 'CLOSED'}}</h5>
                    <label class="switch align-middle">
                            <input type="checkbox" {{$event->open ? 'checked' : ''}} onchange="this.form.submit()">
                            <span class="slider round"></span>
                    </label> {{Form::close()}}
                </div>

                <hr>

                <div>

                    <h5 class="d-inline-block">Custom Questions</h5>
                    {{-- only show 'add question' button if no applications received and less than 5 questions exist --}}
                    @if(count($event->applicants) == 0 && count($event->customQuestions) < 5)
                        <button type="button" data-toggle="modal" data-target="#addQuestionModal" class="btn btn-sm btn-primary float-right"><i class="fas fa-plus"></i>&nbsp;Add Question</button>                    
                    @else
                        @if(count($event->applicants) > 0)
                            <button type="button" class="btn btn-secondary btn-sm float-right" disabled>Applications Received!</button>
                        @elseif(count($event->customQuestions) == 5)
                            <button type="button" class="btn btn-secondary btn-sm float-right" disabled>Limit reached!</button>
                        @endif
                    @endif

                    <small class="d-block">You can only edit customs questions until the first application is received.</small>

                    <table class="table table-striped table-sm mt-2">
                        <thead>
                            <th>Question</th>
                            <th>Type</th>
                            <th class="text-center">Required</th>
                            <th></th>
                        </thead>
                        
                            @foreach($event->customQuestions as $question)
                            <tr>
                                <td><small>{{$question->text}}</small></td>
                                <td>{{$question->type}}</td>
                                <td class="text-center">{{$question->required ? 'Yes' : 'No'}}</td>
                                <td>
                                    {{-- only show delete button if no applicantions received --}}
                                    @if(count($event->applicants) == 0)
                                    <form action="{{route('admin.eventManagement.removeQuestion', ['questionID' => $question->id])}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="btn btn-sm btn-danger float-right"><i class="fas fa-trash"></i></button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                    </table>

                </div>

                <hr>

                <div class="gray-card">
                    <h3 class="text-center">Applications Received</h3>
                    <h2 class="text-grey text-center">{{count($event->applicants)}}</h2>
                </div>

                <hr>

                <div class="row">
                    <div class="col-6">
                        <div class="gray-card">
                            <h3 class="text-center">Blue Fighters Selected</h3>
                            <h2 class="text-center">{{count($event->getTeam('blue'))}}</h2>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="gray-card">
                            <h3 class="text-center">Red Fighters Selected</h3>
                            <h2 class="text-center">{{count($event->getTeam('red'))}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

{{-- Add question modal --}}
<div class="modal fade" id="addQuestionModal" tabindex="-1" role="dialog"aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-dark">
                <h4 class="modal-title text-white">Add Custom Question</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span class="text-white" aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{route('admin.eventManagement.addQuestion', ['eventID' => $event->id])}}">
                    <div class="form-group">
                        <label for="question">Question</label>
                        <input type="text" name="question" id="question" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="type">Answer Type</label>
                        <select name="type" id="type" class="form-control">
                            <option value="Text">Text</option>
                            <option value="Yes/No">Yes/No</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="required">Required?</label>
                        <select name="required" id="required" class="form-control">
                            <option value="Yes">Yes</option>
                            <option value="No">No</option>
                        </select>
                    </div>                    
                    @csrf
                    <button type="submit" class="btn btn-success float-right"><i class="fas fa-plus"></i> Save Question</button>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- end of add question modal --}}