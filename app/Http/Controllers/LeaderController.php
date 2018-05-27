<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use ShareMarketGame\Leader;

class LeaderController extends Controller
{
    //Return order leaderboard
    public static function getLeaderBoard(){
        return Leader::orderBy('place')->get();
    }
}
