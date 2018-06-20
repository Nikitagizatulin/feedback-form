<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $fillable = [
        'theme', 'message', 'file','user_id','readed'
    ];
}
