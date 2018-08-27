<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContenderAppNote extends Model
{
    // Relationship to user
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    // Relationship to application
    public function application()
    {
        return $this->belongsTo('App\ContenderApplication', 'application_id');
    }
}
