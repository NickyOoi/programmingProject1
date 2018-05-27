<?php

namespace ShareMarketGame;

use Illuminate\Database\Eloquent\Model;
use ShareMarketGame\Friend;
use ShareMarketGame\FriendRequest;
use ShareMarketGame\Notification;

class TradingAccount extends Model
{
    protected $primaryKey = 'nickname';
    public $incrementing = false;
    protected $fillable = ['nickname','balance','user_id'];

    public function isFriend($friendName){

    	//Gte all friends
    	$friends=Friend::where('nickname', '=', $this->nickname, 'or')->where('friend', '=', $this->nickname);

    	//Check if no friends exist
    	if($friends->isEmpty()){
    		return false;
    	}

    	//CHeck if each friend matches given name
    	foreach ($friends as $friend) {
    		//Return true if match found
    		if($friend->nickname==$friendName || $friend->friend==$friendName){
    			return true;
    		}
    	}

    	//Return false if friend not found
    	return false;
    }

    //Get all friend requests belonging to this trading account
    public function getFriendRequests(){
        return FriendRequest::where('to', '=', $this->nickname);
    }

    //Get all notification belonging to this tading account
    public function getNotifications(){
        return FriendRequest::where('nickname', '=', $this->nickname);
    }
}
