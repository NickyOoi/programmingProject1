<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;
use ShareMarketGame\TradingAccount;
define("STARTING_BALANCE", "1000000");
class TradingAccountController extends Controller
{
	//Create trading account with default balance
    public function createTradingAccount(Request $request){
		$session_id = \Auth::user()->id;
        $nname=$request->input('nname');
        $uid = $session_id;

    	//Create Trading Account object
    	$account = new TradingAccount;

    	//Set values
    	$account->nickname=$nname;
    	$account->user_id=$uid;
    	$account->balance=STARTING_BALANCE;

    	//Save to database
    	$account->save();
		return redirect()->back()->with('success', 'Successfully created new trading acoount!');

	}

	//Remove trading account with given name from database
	public function deleteTradingAccount(Request $request){
		$nname = $request->input('deleteName');
		$user = TradingAccount::where('nickname' , '=', $nname)->delete();
		return redirect()->back()->with('success', 'Successfully deleted trading account!');
	}
	
	//Change nickname of trading account
    public function changeNickname(Request $request){
        $old=$request->input('old');
        $new=$request->input('new');
    	//Retrieve record
    	$account=TradingAccount::find($old);

    	//Update nickname
    	$account->update(['nickname'=>$new]);
        return redirect()->back()->with('success', 'Change nickname activity success!');
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
    	if(TradingAccountController::sufficientFunds($name,$amount)){
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

    	return true;
    }

    //Transfer funds between trading account (potentially different users)
    public static function transferFunds(Request $request){
        $sender=$request->input('sender');
        $receiver=$request->input('receiver');
        $amount=$request->input('amount');
    	//Check if sufficient funds if so reduce sender balance
    	if(self::removeFunds($sender,$amount)){
    		//Add transferred funds to receiver
    		self::addFunds($receiver,$amount);
    		//Return success indicator
			return redirect()->back()->with('success', 'Funds successfully transferred!');
    	}
    	//Return false if insufficient funds thus transfer fails
    	return redirect()->back()->with('error', 'Error: Transfer fund activity failed. Please try again.');
    }
}
