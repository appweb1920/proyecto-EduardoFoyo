<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Like extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = "like";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','user_love_like','user_love_liked'
    ];
}
