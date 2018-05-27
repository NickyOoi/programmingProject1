<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;
use ShareMarketGame\Share;

class ShareController extends Controller
{
	//Get array of all tracked shares
	public function getAllShares(){
		return Share::orderBy('code')->get();

    	return view('home', compact('lists'));
	}

	//Find share by code
	public function getByCode(Request $request){
		$search=$request->input('search');
		return Share::where('code', 'LIKE', '%'.$search.'%')->get();
	}

	//Find share by name
	public function getByName(Request $request){
		$search=$request->input('search');
		return Share::where('name', 'LIKE', '%'.$search.'%')->get();
	}

	/** Request share data over time based on input
	*	@param $code asx stock code
	*	@param $timeSeries Time series to result results over, INTRADAY, DAILY, WEEKLY, MONTHLY only
	*	@param $time Time period for each value 1,5,15,30 or 60 only, or null if not intraday
	*	@param $limit Number of responses to limit return to
	*	@return Returns false on invalid input otherwise returns array of values
	*/
	public function requestShareData(Request $request){

	    //Take in request data
		$code=$request->input('code');
		$timeSeries=$request->input('timeSeries');
		$time=$request->input('time');
		$limit=$request->input('limit');

		//Check for valid time series
		if($timeSeries!="INTRADAY"||$timeSeries!="DAILY"||$timeSeries!="WEEKLY"||$timeSeries!="MONTHLY"){
			return false;
		}

		//If time series intraday set timeframe
		if($timeSeries=="INTRADAY"){
			$time=$request->input('time');

			//Set timeframe string
			$timestr="&interval="+$time+"min";
			$accessStr=$time+"min";
		

			//Check for valid time and limit input
			if($time!=1||$time!=5||$time!=15||$time!=30||$time!=60||$limit>100){
				return false;
			}
		}else{
			$timestr="";
			$accessStr=$timeSeries;
		}

		try{
			//Get api response and grab data section
			$response=json_decode(file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_"+
				$timeSeries+"&symbol="+$code+".ax"+$timestr+"&apikey=6DD89FIYMJ57CPGO"));
        	$section= $response["Time Series ("+$accessStr+")"];
        }
        //Check if request fails
        catch(\Exception $e){
        	return array();
        }

        //Add each value to limit
        $array=array();
        foreach($section as $ele){
        	array_push($array,$ele["4. close"]);
        }
        return $array;
	}
}
