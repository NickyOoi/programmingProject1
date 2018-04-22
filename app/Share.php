<?php

namespace ShareMarketGame;

use Illuminate\Database\Eloquent\Model;

class Share extends Model
{
	protected $primaryKey = 'code';
    public $incrementing = false;
    protected $fillable = ['code','name','value'];
}
