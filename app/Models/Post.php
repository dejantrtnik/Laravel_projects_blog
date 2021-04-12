<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//use App\Models;

class Post extends Model
{
    use HasFactory;

    //protected $table = 'posts';
    //public $primaryKey = 'id';
    //public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function comments(){
        return $this->belongsTo('App\Models\Comments');
    }
}
