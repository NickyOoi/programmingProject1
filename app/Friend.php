<?php

namespace ShareMarketGame;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public $incrementing = false;
    protected $fillable = ['nickname','friend'];
    public $timestamps = false;
}
