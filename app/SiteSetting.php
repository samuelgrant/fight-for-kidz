<?php

namespace App;

use App\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SiteSetting extends Model
{
    public static function getSettings() {
        return SiteSetting::all()->first();
    }

    public static function getHomeSettings() {
        return SiteSetting::get(['about_us', 'auction', 'display_merch', 'merch'])->first();
    }

    // Returns the configurable site SEO Metadata
    public static function getSiteMeta() {
        return SiteSetting::get(['seo_author', 'seo_description', 'seo_keywords', 'seo_theme_color'])->first();
    }

    /**
     * Returns the altered metadata for a given page
     * Only works for 'contact us', 'apply to fight' & 'event/*'
     * @param string:request_url
     * @return json{page_meta_data}
     */
    public static function getPageMeta($request_url) {
        $meta = SiteSetting::getSiteMeta();

        // The page title should be the URL path without '-'
        $title_string = str_replace('event/', '', $request_url);
        $title_words = str_replace('-', ' ', $title_string) ;
        $meta->seo_title = ucwords($title_words);

        // Get Current Event
        $c_event = Event::current();

        if(false) {
            // on event page and historic
            // desc -> new desc
        } else if ($c_event->isFutureEvent() && $c_event->is_public) {
            $c_event->contenders = count($c_event->contenders);
            if($c_event->contenders < 10) {
                switch($c_event->contenders){
                    case 0: $c_event->contenders = "zero";
                    case 1: $c_event->contenders = "one";
                    case 2: $c_event->contenders = "two";
                    case 3: $c_event->contenders = "three";
                    case 4: $c_event->contenders = "four";
                    case 5: $c_event->contenders = "five";
                    case 6: $c_event->contenders = "six";
                    case 7: $c_event->contenders = "seven";
                    case 8: $c_event->contenders = "eight";
                    case 9: $c_event->contenders = "nine";
                }
            }

            // Setup date string for event
            $c_event->datetime = \DateTime::createFromFormat("Y-m-d H:i:s", $c_event->datetime);
            $c_event->datetime = $c_event->datetime->format('g a \o\n l \t\h\e jS \o\f F');

            $meta->seo_description = "Join us at {$c_event->datetime} when {$c_event->contenders} contenders fight it out at {$c_event->venue_name} to raise money for {$c_event->charity}.";
        }
        return $meta;
    }

    public function setMainPhoto($image) {

        if(isset($image)){
            $image->storeAs('public/images', 'mainPagePhoto.jpg');
        }

        return;
    }
}
