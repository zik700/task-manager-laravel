<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
