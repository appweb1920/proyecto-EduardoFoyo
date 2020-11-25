<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id';
    protected $table = "interest";

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'id','interest'
    ];
}
