<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;

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
	public function requestShareData($code,$timeSeries,$time,$limit){
		$code=$request->input('code');
		$timeSeries=$request->input('timerSeries');
		$time=$request->input('time');
		$limit=$request->input('limit');

		//Check for valid time series
		if($timeSeries!="INTRADAY"||$timeSeries!="DAILY"||$timeSeries!="WEEKLY"||$timeSeries!="MONTHLY"){
			return false;
		}

		if($timeSeries=="INTRADAY"){
			$timestr="&interval=+"$time"+min"
		
			//Check for valid time and limit input
			if($time!=1||$time!=5||$time!=15||$time!=30||$time!=60||$limit>100){
				return false;
			}
		}else{
			$timestr="";
		}

		//Get api response and grab data section
		$response=json_decode(file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_"+
			$timeSeries+"&symbol="+$code+".ax"+$timestr+"&apikey=6DD89FIYMJ57CPGO"));
        $section= $response[1];

        //Add each value to limit
        $array=array();
        for($i=0;$i<$limit,$i++){
        	$array_push($array,$section[$i]["4. close"]);
        }
        return $array;
	}
}
