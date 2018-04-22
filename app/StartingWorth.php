<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StartingWorth extends Model
{
    protected $primaryKey = 'nickname';
    public $incrementing = false;
    protected $fillable = ['nickname','worth'];
}
