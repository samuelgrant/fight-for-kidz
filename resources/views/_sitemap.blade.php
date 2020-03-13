<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>

<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    @if(App\Event::current()->isFutureEvent() && App\Event::current()->open)
    <!-- Apply to Fight -->
    <url>
        <loc>{{env('APP_URL')}}/fighter-application</loc>
        <lastmod>{{substr(App\Event::current()->updated_at, 0, strpos(App\Event::current()->updated_at, ' '))}}</lastmod>
        <priority>1.0</priority>
    </url>
    @endif

    @if(App\Event::current()->isFutureEvent())
    <!-- Future Event -->
    <url>
        <loc>{{env('APP_URL')}}/event/{{str_replace(' ', '-', App\Event::current()->name)}}</loc>
        <lastmod>{{substr(App\Event::current()->updated_at, 0, strpos(App\Event::current()->updated_at, ' '))}}</lastmod>
        <priority>0.9</priority>
    </url>
    @endif

    <!-- Index Page -->
    <url>
        <loc>{{env('APP_URL')}}</loc>
        <lastmod>{{substr($index->updated_at, 0, strpos($index->updated_at, ' '))}}</lastmod>
        <priority>0.9</priority>
    </url>    

    <!-- Contact Us -->
    <url>
        <loc>{{env('APP_URL')}}/contact-us</loc>
        <priority>0.8</priority>
    </url>
    
    {{-- Get a start priority of 7 --}}
    <?php $priority = 0.7; ?>

    @foreach($events as $event)
        @if(!$event->isFutureEvent() || !App\Event::current()->isFutureEvent() || $event->id != App\Event::current()->id)
        <!-- Event: {{$event->name}} -->
        <url>
            <loc>{{env('APP_URL')}}/event/{{str_replace(' ', '-', $event->name)}}</loc>
            <lastmod>{{substr($event->updated_at, 0, strpos($event->updated_at, ' '))}}</lastmod>
            <priority>{{($priority >= 0.0) ? $priority : 0.1}}</priority>
        </url>
        {{-- This value should go down by 0.1 each cycle --}}
        <?php $priority = $priority - 0.1; ?>
        @endif
    @endforeach
</urlset>