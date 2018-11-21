<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MerchandiseItem extends Model
{
    use SoftDeletes;

    /**
     * Show individual items on the public merchandise page
     */
    public function hideMerchandiseItem(){
        $this->item_visible = false;
        $this->save();
    }

    /**
     * Show individual items on the public merchandise page
     */
    public function showMerchandiseItem(){
        $this->item_visible = true;
        $this->save();
    }
}
