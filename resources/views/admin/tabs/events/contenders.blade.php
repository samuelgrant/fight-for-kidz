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
                                    {{-- collapsable contender info --}}
                                    @include('admin.tabs.misc.collapsableContender')
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
                
                    <table class="table table-sm">
                    
                        @foreach($event->getTeam('red') as $contender)

                            <tr>                                
                                <td>
                                    {{-- collapsable contender information --}}
                                    @include('admin.tabs.misc.collapsableContender')
                                </td>
                            </tr>

                        @endforeach

                    </table>

                </div>
            
            </div>
        
        </div>
        {{-- end of red team --}}
    
    </div>  