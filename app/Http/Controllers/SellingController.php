<?php

namespace ShareMarketGame\Http\Controllers;

use Illuminate\Http\Request;
use ShareMarketGame\Share;
use ShareMarketGame\Holding;
use ShareMarketGame\Transaction;

class SellingController extends Controller
{
    public function sellShares(Request $request){
        //Handle request data
        $name=$request->input('name');
        $code=$request->input('code');
        $amount=$request->input('amount');

        //Retrieve user holding
        $hold=Holding::find($name,$code);

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

        //Save transaction to database
        $trans->save();

        return true;
    }
}
