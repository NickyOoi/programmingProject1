<?php
namespace ShareMarketGame\Http\Controllers;
use Illuminate\Http\Request;
use ShareMarketGame\Share;
use ShareMarketGame\Holding;
use ShareMarketGame\Transaction;
class HoldingController extends Controller
{
    //Purchase shares
    public function buyShares(Request $request){
        //Handle request data
        $name=$request->input('name');
        $code=$request->input('code');
        $amount=$request->input('amount');

    	//Retrieve cost of shares
    	$cost=(Share::find($code)->value)*$amount;

    	//Check if user can afford and remove funds if so
    	if(TradingAccountController::removeFunds($name,$cost)){
            $hold=Holding::where('trading_nickname', $name)->where('asx_code', $code)->first();

            if($hold==null){
    		  //Create holding
    		  $hold=new Holding;
            
    		  //Set values
    		  $hold->trading_nickname=$name;
    		  $hold->asx_code=$code;
              $hold->quantity=$amount;

              //Save to database
              $hold->save();
            }else{
                //Set quantity
                $hold->quantity=$hold->quantity+$amount;

                //Update database
                $hold->update(['quantity'=>$hold->quantity]);

            }
            //Record transaction
            $trans = new Transaction();
            $trans->nickname=$name;
            $trans->code=$code;
            $trans->amount=$amount;
            $trans->value=$cost;
            $trans->dateTime=date('Y-m-d H:i:s');
            $trans->purchase=true;

            //Save transaction
            $trans->save();
            
            //redirect to the home page
            return redirect('/home')->with('success', 'Buy shares transaction success!');
    	}
    }
}