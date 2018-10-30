<nav class="navbar navbar-dark navbar-expand-md sticky-top bg-dark navigation-clean">
    <div class="container"><a href="{{route('index')}}" class="navbar-brand"><img src="/storage/images/f4k_logo_nodate.png" alt="Fight for Kidz Logo"></a><button data-toggle="collapse" data-target="#navcol-1" class="navbar-toggler"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse"
            id="navcol-1">
            <ul class="nav navbar-nav ml-auto">
                <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle nav-link dropdown-toggle">Events</a>
                    <div role="menu" class="dropdown-menu">
                        @foreach($events as $event)                        
                            @if($event->is_public)
                                <a role="presentation" href="{{route('event', str_replace(' ', '-', $event->name))}}" class="dropdown-item">{{$event->name}}</a>
                                @if($event == App\Event::current() && $event->isFutureEvent())
                                    <hr class=" my-0">
                                @endif
                            @endif
                        @endforeach
                    </div>
                </li>
                {{-- Event Applications --}}
                @if($currentEvent->isFutureEvent() && $currentEvent->open)
                <!-- Applications Dropdown -->
                <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle nav-link dropdown-toggle">Apply</a>
                    <div role="menu" class="dropdown-menu">
                        <a role="presentation" href="{{route('application.fight')}}" class="dropdown-item">To Fight</a>
                        <a role="presentation" href="{{route('application.sponsor')}}" class="dropdown-item">To be a Sponsor</a>
                    </div>
                </li><!-- End Applications Dropdown -->
                @endif
                <!-- End Buy Tickets Dropdown -->
                
                {{-- Book Tickets (Seats & Tables) --}}
                @if($currentEvent->isFutureEvent())
                <!-- Buy Tickets Dropdown -->
                <li class="dropdown"><a data-toggle="dropdown" aria-expanded="false" href="#" class="dropdown-toggle nav-link dropdown-toggle">Book Tickets</a>
                    <div role="menu" class="dropdown-menu">
                        @if(isset($currentEvent->ticket_seller_url))
                        <a role="presentation" href="{{$currentEvent->ticket_seller_url}}" target="blank" class="dropdown-item">Seats</a>
                        @endif
                        {{-- <a role="presentation" href="#" class="dropdown-item">Tables</a> --}}
                    </div>
                </li><!-- End Book Tickets -->
                @endif
                
                @if(false)
                <!-- Merchandise -->
                <li role="presentation" class="nav-item"><a href="{{route('merchandise')}}" class="nav-link">Merchandise</a></li>
                @endif

                <!-- Contact/Subscribe -->
                <li role="presentation" class="nav-item"><a href="{{route('contact')}}" class="nav-link">Contact Us</a></li>
            </ul>
        </div>
    </div>
</nav>