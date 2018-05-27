<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use ShareMarketGame\TradingAccount;
use ShareMarketGame\User;
use ShareMarketGame\Http\Controllers\TradingAccountController;


define("STARTING_BALANCE", "1000000");
define("TRANSFER_AMOUNT", "1000");
class TradingAccountTest extends TestCase
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

	//Funds transfer test
    public function testTransfer(){
    	//Initialize request obejct
    	$req = new Request();
    	$req->setMethod('POST');
    	$req->merge(['sender' => "testtradingoneone"]);
    	$req->merge(['receiver'=>"testtradingtwoone"]);
    	$req->merge(['amount' =>TRANSFER_AMOUNT]);

    	//Transfer funds
        $tCont = new TradingAccountController();
    	$tCont.transferFunds($req);

    	//Get balances
    	$balSender=TradingAccount::where('nickname','=','testtradingoneone')->first()->balance;
    	$balReceiver=TradingAccount::where('nickname','=','testtradingtwoone')->first()->balance;

    	//Check successful
    	$this->assertTrue($balSender==STARTING_BALANCE-TRANSFER_AMOUNT);
    	$this->assertTrue($balReceiver==STARTING_BALANCE+TRANSFER_AMOUNT);
    }

    public function testDeleteTradingAccount(){
        //Create trading accounts
        TradingAccount::create([
            'nickname' => 'deletetradingoneone',
            'user_id'=>User::where('name','Test person one')->first(),
            'balance'=>STARTING_BALANCE,
        ]);

        //Initialize request obejct
        $req = new Request();
        $req->setMethod('POST');
        $req->merge(['deleteName' => "deletetradingoneone"]);

        //Delete account
        $tCont = new TradingAccountController();
        $tCont.transferFunds($req);

        //Attempt to retrieve account
        $account = TradingAccount::where("nickname","=","deletetradingoneone")->first();

        //Make sure account no longer exists
        $this->assertTrue($account==null);
    }

    //Funds transfer test
    public function testChangeNickname(){
    	//Initialize request obejct
    	$req = new Request();
    	$req->setMethod('POST');
    	$req->merge(['old'=>"testtradingoneone"]);
    	$req->merge(['new'=>"testtradingonetwo"]);

        //Change name
        $tCont = new TradingAccountController();
        $tCont.changeNickname($req);

    	//Check success
    	$this->assertTrue(User::where('name', '=', 'testtradingonetwo')->exists());
    	$this->assertFalse(User::where('name', '=', 'testtradingoneone')->exists());
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
