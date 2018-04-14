<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;

class HoldingController extends Controller
{
    //Purchase shares
    public function buyShares($name,$code,$amount){
    	//Retrieve cost of shares
    	$cost=(Share::find($code)->value)*$amount;

    	//Check if user can afford and remove funds if so
    	if(TradingAccountController::removeFunds($name,$cost)){
    		//Create holding
    		$hold=new Holding;

    		//Set values
    		$hold->nickname=$name;
    		$hold->code=$code;
    		$hold->quantity=$amount;

    		//Save to database
    		$hold->save();

            //Record transaction
            $trans = new Transaction();
            $trans->nickname=$name;
            $trans->code=$code;
            $trans->amount=$amount;
            $trans->value=$cost;
            $trans->dateTime=date('Y-m-d H:i:s');
            $trans->purchase=true;
            $trans->save();

    	}
    }


    public function sellShares($name,$code,$amount){
    	//Retrieve user holding
    	$hold=Holding::find($name,$code)

    	//Retrieve amount of share user holds
    	$amountheld=$hold->quantity;

        //Retrieve price of shares
        $cost=(Share::find($code)->value)*$amount;

    	//Return false if insufficient shares
    	if($amountheld<$amount){
    		return false;
    	}

    	//Check if amount held equals sell amount and delete hold if so
    	if(TradingAccountController::removeFunds($name,$cost)){
    		$hold->delete();
    	}
    	//Reduce quantity by amount sold
    	else{
    		//Set values
    		$hold->update(['quantity'=>$amountheld-$amount]);
    	}

    	//Increment trading account balance by sold value
    	TradingAccountController::addFunds($name,$cost);

        //Record transaction
        $trans = new Transaction();
        $trans->nickname=$name;
        $trans->code=$code;
        $trans->amount=$amount;
        $trans->value=$cost;
        $trans->dateTime=date('Y-m-d H:i:s');
        $trans->purchase=false;
        $trans->save();

    	return true;
    }
}
