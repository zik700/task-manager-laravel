<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = [
        'name', 'description', 'deadline'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
