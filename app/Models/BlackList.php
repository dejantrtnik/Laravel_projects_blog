<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlackList extends Model
{
    use HasFactory;

    protected $table = 'black_list';
    public $primaryKey = 'id';
    public $timestamps = true;
}
