<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    public function track()
    {
        return $this->belongsTo('App\Track');
    }
}
