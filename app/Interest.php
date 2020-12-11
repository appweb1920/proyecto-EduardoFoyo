<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Interest extends Model
{

    protected $primaryKey = 'id';
    protected $table = "interest";

    protected $fillable = [
        'id','interest'
    ];
}
