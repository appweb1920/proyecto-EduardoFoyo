<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserInterest extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = "user_interest";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','user_love_id','interest_id'
    ];
}
