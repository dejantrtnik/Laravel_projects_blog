<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pages extends Model
{
    use HasFactory;

    public function ipInfo(){
        return $this->belongsTo('App\Models\ipInfo');
    }
}
