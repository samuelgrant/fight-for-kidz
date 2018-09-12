<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Groupable;
use Illuminate\Support\Facades\Log;

class Contact extends Model
{

    use Groupable;

    public function removeIfNotGrouped(){
        if(count($this->groups) == 0){
            $this->delete();
            Log::debug($this->name.' was deleted from contacts table as they have no group membership.');
        }
    }
}
