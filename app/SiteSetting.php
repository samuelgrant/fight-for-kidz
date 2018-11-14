<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public static function getSettings(){
        return SiteSetting::all()->first();
    }

    public function setMainPhoto($image){

        if(isset($image)){
            $image->storeAs('public/images', 'mainPagePhoto.jpg');
        }

        return;
    }
}
