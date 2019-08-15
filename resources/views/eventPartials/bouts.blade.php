<!-- All bouts will be contained within single row -->
<div id="bouts-section" class="row bouts-row">
    <div class="container pt-5">
        <div id="bouts-section" class="row bouts-row">
            {{-- @foreach($event->bouts as $bout) --}}
            @for($i = 0; $i < count($event->bouts); $i++ )
                <?php $bout = $event->bouts[$i] ?>

                <div class="col-lg-6 bout-column">
                    <!-- Each bout has a bout header -->
                    <div class="bout-card">
                        <div class="bout-header">
                            <h2>BOUT {{$i + 1}}</h2>

                            @if($bout->sponsor)
                                <div class="sponsor-badge">
                                    <div class="vertical-aligner"></div>
                                    @if($bout->sponsor->url)
                                        <a href="{{$bout->sponsor->url}}" target="_blank">
                                            <img style="max-height:60px;" src="{{'/storage/images/sponsors/' . $bout->sponsor->id . '.png'}}" class="img-fluid bout-sponsor" title="{{$bout->sponsor->company_name}}">
                                        </a>
                                    @else
                                        <img style="max-height:60px;" src="{{'/storage/images/sponsors/' . $bout->sponsor->id . '.png'}}" class="img-fluid bout-sponsor" title="{{$bout->sponsor->company_name}}">
                                    @endif
                                </div>
                            @endif
                        </div>

                        @foreach($bout->contenders() as $contender)
                        <!-- Each bout card will contain two contender-cards -->
                        <div class="contender-card contender-card-{{$contender->coloroverride == null ? $contender->team : $contender->coloroverride}}">
                            <div class="contender-card-inner">
                                <img src="{{file_exists(public_path('/storage/images/contenders/' . $contender->id . '.jpg')) ? '/storage/images/contenders/' . $contender->id . '.jpg' : '/storage/images/contenders/0.png'}}" class="mx-auto contender-img">
                                <div class="contender-name">
                                    <h5>{{$contender->first_name}}</h5>
                                    <div class="nickname-wrapper">
                                        <h4 class="nickname-cell">{{$contender->nickname}}</h4>
                                    </div>
                                    <h5>{{$contender->last_name}}</h5>
                                </div>

                                {{-- Sponsor Logo --}}
                                <label for="red-sponsor" style="font-size:14px;">Sponsored by</label>
                                <div class="contender-sponsor-section">
                                    @if(App\Contender::find($contender->id)->sponsor_id)
                                        @if(App\Sponsor::find(App\Contender::find($contender->id)->sponsor_id)->url)              						                
                                            <a href="{{App\Sponsor::find(App\Contender::find($contender->id)->sponsor_id)->url}}" target="blank" class="contender-sponsor-logo-wrapper">
                                                <img id="contendersponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($contender->id)->sponsor_id . '.png')) ? '/storage/images/sponsors/' . App\Contender::find($contender->id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}" class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($contender->id)->sponsor_id)->company_name}}">
                                            </a>
                                        @else
                                            <div class="contender-sponsor-logo-wrapper">
                                                <img id="contendersponsor" src="{{file_exists(public_path('/storage/images/sponsors/' . App\Contender::find($contender->id)->sponsor_id . '.png')) ? '/storage/images/sponsors/' . App\Contender::find($contender->id)->sponsor_id . '.png' : '/storage/images/sponsors/0.png'}}" class="mx-auto contender-sponsor-logo" title="{{App\Sponsor::find(App\Contender::find($contender->id)->sponsor_id)->company_name}}">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                                <div class="bout-btn bout-btn-{{$contender->coloroverride == null ? $contender->team : $contender->coloroverride}} bio-view-button" data-toggle="modal" data-target="#bio-modal" data-contenderId="{{$contender->id}}">
                                    View Bio
                                </div>

                                @if($event->isFutureEvent())
                                <div class="bout-btn bout-btn-{{$contender->coloroverride == null ? $contender->team : $contender->coloroverride}} {{$bout->red_contender->donate_url ? '' : 'invisible'}}" onclick="window.open('{{$contender->donate_url}}', '_blank')">
                                    Donate
                                </div>
                                @endif
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div> <!-- end each bout -->
            @endfor
        </div>
    </div>
</div>