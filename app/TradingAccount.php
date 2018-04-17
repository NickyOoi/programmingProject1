<?php

namespace ShareMarketGame;

use Illuminate\Database\Eloquent\Model;

class TradingAccount extends Model
{
    protected $primaryKey = 'nickname';
    public $incrementing = false;
    protected $fillable = ['nickname','balance','user_id'];
}
