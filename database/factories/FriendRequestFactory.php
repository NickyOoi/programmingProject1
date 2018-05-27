<?php

use Faker\Generator as Faker;

$factory->define(ShareMarketGame\FriendRequest::class, function (Faker $faker) {
    return [
        'to' => function () {
            return factory(ShareMarketGame\TradingAccount::class)->create()->nickname;
        },
        'from' => function () {
            return factory(ShareMarketGame\TradingAccount::class)->create()->nickname;
        },
        //'message' => $faker->text($maxNbChars = 20),
    ];
});
