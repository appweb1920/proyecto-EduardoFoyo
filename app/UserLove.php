<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserLove extends Model
{

    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = "user_love";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','user_token','id_interest','name','email','password',
        'gender','description', 'user_photo'
    ];
}
