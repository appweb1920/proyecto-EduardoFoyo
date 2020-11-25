<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchUsers extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = "match_users";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','user_love_first','user_love_second'
    ];
}
