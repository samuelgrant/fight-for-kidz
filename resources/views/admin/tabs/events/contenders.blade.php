<div class="mt-4">
        <h3>{{$event->name}} : Contenders</h3>
    </div>

    <hr>

    <div class="row">
    
        {{-- start of blue team --}}
        <div class="col-lg-6">
        
            <div class="card border-primary">
            
                <div class="card-header bg-primary text-white">
                
                    <h4 class="d-inline-block">Blue Team</h4>
                    <h5 class="d-inline-block float-right">{{count($event->getTeam('blue'))}} members</h5>
                
                </div>

                <div class="card-body">
                
                    <table class="table table-sm">
                    
                        @foreach($event->getTeam('blue') as $contender)

                            <tr>
                                <td>
                                    <h3 class="d-inline-block">{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h3>
                                    <a class="float-right" data-toggle="collapse" href="#{{$contender->id}}-collapsable">Details &nbsp;<i class="fas fa-caret-down"></i></a>

                                    {{-- collapsable contender info --}}

                                    <div class="collapse" id="{{$contender->id}}-collapsable">
                                    
                                        <div class="row">

                                            <div class="col-md-6">
                                                
                                                <table class="table table-sm">
                                                    <tr><td>Nickname: {{$contender->nickname ?? 'tbc'}}</td></tr>
                                                    <tr><td>Sponsor: {{$contender->sponsor ? $contender->sponsor->company_name : 'tbc'}}</td></tr>
                                                    <tr><td>Height: {{$contender->height}} cm</td></tr>
                                                    <tr><td>Weight: {{$contender->weight}} kgs</td></tr>
                                                    <tr><td>Reach: {{$contender->reach}} cm</td></tr>
                                                </table>

                                            </div>

                                            <div class="col-md-6 text-center">
                                                
                                                <img src="/storage/images/fighters/{{$contender->id}}.png" class="d-block mx-auto mb-1 img-fluid">
                                                <button class="btn btn-primary">Change</button>

                                            </div>

                                            <div>

                                                Bio video URL: {{$contender->bio_url}}

                                            </div>

                                        </div>

                                    </div>
                                </td>
                            </tr>

                        @endforeach

                    </table>

                </div>
            
            </div>
        
        </div>
        {{-- end of blue team --}}

        {{-- start of red team --}}
        <div class="col-lg-6">
        
            <div class="card border-danger">
            
                <div class="card-header bg-danger text-white">
                
                    <h4 class="d-inline-block">Red Team</h4>
                    <h5 class="d-inline-block float-right">{{count($event->getTeam('red'))}} members</h5>
                
                </div>

                <div class="card-body">
                
                    <table class="table table-hover table-sm">
                    
                        @foreach($event->getTeam('red') as $contender)

                            <tr>
                                <td><h3>{{$contender->applicant->first_name.' '.$contender->applicant->last_name}}</h3></td>
                            </tr>

                        @endforeach

                    </table>

                </div>
            
            </div>
        
        </div>
        {{-- end of red team --}}
    
    </div>  