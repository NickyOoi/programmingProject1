<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;

class ShareController extends Controller
{
	//Get array of all tracked shares
	public function getAllShares(){
		return Share::orderBy('code')->get();
	}
}
