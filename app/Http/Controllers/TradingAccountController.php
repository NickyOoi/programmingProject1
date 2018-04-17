<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;

class TradingAccountController extends Controller
{
	const STARTING_BALANCE=1000000;

	//Create trading account with default balance
    public function createTradingAccount($nname,$uid){
    	//Create Trading Account object
    	$account = new TradingAccount;

    	//Set values
    	$account->nickname=$nname;
    	$account->user_id=$uid;
    	$account->balance=STARTING_BALANCE;

    	//Save to database
    	$account->save();

    }

	//Change nickname of trading account
    public function changeNickname($old,$new){
    	//Retrieve record
    	$account=TradingAccount::find($old);

    	//Update nickname
    	$account->update(['nickname'=>$new]);
    }

    //Change nickname of trading account
    public static function sufficientFunds($nickname,$amount){
    	//Retrieve record
    	$account=TradingAccount::find($nickname);

    	//Check for sufficient funds
    	if($account->balance < $amount){
    		return false;
    	}else{
    		return true;
    	}
    }

    //Subtract from current balance
    public static function removeFunds($name,$amount){
    	//Retrieve record
    	$account=TradingAccount::find($name);

    	//Check for sufficient funds
    	if(sufficientFunds($name,$amount)){
    		//Update balance
    		$account->update(['balance'=>$account->balance-$amount]);
    	}else{
    		return false;
    	}
    	return true;
    }

    //Add to current balance
    public static function addFunds($name,$amount){
    	//Retrieve record
    	$account=TradingAccount::find($name);

    		//Update balance
    		$account->update(['balance'=>$account->balance+$amount]);
    	}
    	return true;
    }
}
