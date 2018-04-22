<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LeaderController extends Controller
{
    //Return order leaderboard
    public static getLeaderBoard(){
    	return Leader::orderBy('place')->get();
    }
}
