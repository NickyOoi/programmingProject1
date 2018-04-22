<?php

namespace ShareMarketGame\Console\Commands;

use Illuminate\Console\Command;

class UpdateShares extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'shares:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update tracked share values';

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
        $shares=Share::all();
        foreach($shares as $share){
            $share->value=getShareValue($share->code);
            $share->save();
        }
    }

    /**
     * Get current value of share from API.
     *
     * @return Value of share
     */
    private function getShareValue($code)
    {
        $response=json_decode(file_get_contents("https://www.alphavantage.co/query?function=TIME_SERIES_INTRADAY&symbol="+$code+".ax&interval=1min&apikey=6DD89FIYMJ57CPGO"));
        return $response["Time Series (1min)"][0]["4. close"];
    }
}
