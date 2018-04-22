<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class UpdateLeaderboard extends Command
{
    const MAX_LEADERS=50;
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'leaderboard:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update leaderboard by calculating daily gains';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        //Get all trading accounts
        $accounts=TradingAccount::all();

        //For each account check gains
        foreach ($accounts as $acc){
            $value=calculateValue($acc);
            $prevValue=StartingWorth::find($acc->nickname);
            $gain=$value-$prevValue;

            //Add to leaderboard if appropriate
            addtoLeaderBoard($acc->nickname,$gain);

        }
    }

    /**
     * Calculate account value
     *
     * @return total value of account
     */
    private function calculateValue($account)
    {
        $total=0;

        //Get balance and add to toal
        $total=$total+$account->balance;

        //Retrieve all holdings
        $holdings=Holding::find('nickname',$nickname);

        //Add value of each holding to total
        foreach($holdings as $hold){
            $total=$total+($hold->value*$hold->amount);
        }

        //Return total value of account
        return $total;
        
    }

    /**
    * Check if gain belongs in leaderboard add if so
    *
    * @return none
    */
    private function addToLeaderboard($nickname,$amount){
        //Get current leaderboard
        $leaders=Leaders::all()->orderBy('place');

        //Set defaults
        $insert=true;
        $location=-1;

        //Set insert position as first if no leaders present
        if(empty($leaders)){
            $location=1;
        }

        //Iterate through leaders
        foreach($leaders as $lead){
            //If $amount is higher than value of this leader
            if($lead->trading_value<$amount){
                //Set insert location
                if($insert){
                    $location=$lead->place;
                    $insert=false;
                }
                //Move leader down leaderboard
                else{
                    //Remove if last entry
                    if($lead->place==MAX_LEADERS){
                        $lead->delete();
                    }
                    else{
                        $lead->update(['place'=>$lead->place+1]);
                    }
                }

            }
            //Insert new leader into appropriate place if found
            if($location!=-1){
                $new = new Leader;
                $new->nickname=$nickname;
                $new->trading_value=$amount;
                $new->date=date('Y-m-d');
                $new->save();
            }
        }
    }
}
