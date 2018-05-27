<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use ShareMarketGame\TradingAccount;
use ShareMarketGame\User;
use ShareMarketGame\Holding;
use ShareMarketGame\Transaction;
use ShareMarketGame\Http\Controllers\TradingAccountController;
use ShareMarketGame\Http\Controllers\SellingController;
use ShareMarketGame\Http\Controllers\HoldingController;


define("STARTING_BALANCE", "1000000");
define("TRANSFER_AMOUNT", "1000");
define("BUY_AMOUNT", "100");
define("SELL_AMOUNT", "10");
class TransactionTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    //Test buy function
    public function testBuy(){
        //Create request
        $req = new Request();
        $req->setMethod('POST');
        $req->merge(['name' => "testtradingoneone"]);
        $req->merge(['code'=>"A2M"]);
        $req->merge(['amount' =>BUY_AMOUNT]);

        //Check if already held
        $beforeHold = Holding::where("trading_nickname","=","testtradingoneone")->first();

        //Create holding controller and request buy
        $holdCont = new HoldingController();
        $holdCont.buyShares($req);

        //Retrieve held shares
        $hold = Holding::where("trading_nickname","=","testtradingoneone")->first();

        //Check holding matches bought
        if($beforeHold==null) {
            $this->assertTrue($hold->amount = BUY_AMOUNT);
        }else{
            $this->assertTrue(($hold->amount)-($beforeHold->amount) == BUY_AMOUNT);
        }
    }

    //Test sell function
    public function testSell(){
        //Create request to buy
        $req = new Request();
        $req->setMethod('POST');
        $req->merge(['name' => "testtradingoneone"]);
        $req->merge(['code'=>"A2M"]);
        $req->merge(['amount' =>BUY_AMOUNT]);

        //Create controller and buy shares
        $holdCont = new HoldingController();
        $holdCont.buyShares($req);

        //Check amount of shares held before selling
        $beforeSell = Holding::where("trading_nickname","=","testtradingoneone")->first()->amount;

        //Create sell request
        $req = new Request();
        $req->setMethod('POST');
        $req->merge(['name' => "testtradingoneone"]);
        $req->merge(['code'=>"A2M"]);
        $req->merge(['amount' =>SELL_AMOUNT]);

        //Create selling controller
        $sellCont = new SellingController();

        //Sell shares
        $sellCont.sellShares($req);

        //Retrieve amount of shares held after sell
        $afterSell = Holding::where("trading_nickname","=","testtradingoneone")->first()->amount;

        //Check after hold matches before sell - amount sold
        $this->assertTrue($afterSell==$beforeSell-SELL_AMOUNT);
    }

    //Setup
    public function setUp(){
        parent::setUp();

        //Create users
        User::create([
            'name' => 'Test person one',
            'email' => 'testpersonone@testing.com',
            'password' => Hash::make('testPassword1'),
            'admin' => false,
            'last_active' => date('Y-m-d H:i:s'),
        ]);
        User::create([
            'name' => 'Test person two',
            'email' => 'testpersontwo@testing.com',
            'password' => Hash::make('testPassword2'),
            'admin' => false,
            'last_active' => date('Y-m-d H:i:s'),
        ]);

        //Create trading accounts
        TradingAccount::create([
            'nickname' => 'testtradingoneone',
            'user_id'=>User::where('name','Test person one')->first(),
            'balance'=>STARTING_BALANCE,
        ]);
        TradingAccount::create([
            'nickname' => 'testtradingtwoone',
            'user_id'=>User::where('name','Test person two')->first(),
            'balance'=>STARTING_BALANCE,
        ]);


    }
}
