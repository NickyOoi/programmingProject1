<?php

use Illuminate\Database\Seeder;

class ShareCodesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('shares')->insert(['code'=>'A2M','name'=>'The A2 Milk Company','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'AGL','name'=>'AGL Energy Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'AIZ','name'=>'Air New Zealand Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'ALL','name'=>'Aristocrat Leisure','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'AMC','name'=>'Amcor Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'AMP','name'=>'AMP Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'ANZ','name'=>'ANZ Banking Group Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'BHP','name'=>'BHP Billiton Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'BXB','name'=>'Brambles Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'CBS','name'=>'Commonwealth Bank of Australia','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'CIM','name'=>'Cimic Group Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'CSL','name'=>'CSL Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'CTX','name'=>'Caltex Australia','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'CWN','name'=>'Crown Resorts Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'DHG','name'=>'Domain Holdings Aus','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'DMP','name'=>'Domino PIZZA Enterprises Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'FMG','name'=>'Fortescue Metals Group','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'GMG','name'=>'Goodman Group','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'HVN','name'=>'Harvey Norman','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'IAG','name'=>'Insurance Australia','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'JBH','name'=>'JB Hi-Fi Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'MQG','name'=>'Macquarie Group Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'NAB','name'=>'National Australia Bank','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'NCM','name'=>'Newcrest Mining','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'NST','name'=>'Northern Star','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'ORG','name'=>'Origin Energy','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'PMV','name'=>'Premier Investments','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'QAN','name'=>'Qantas Airways','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'QBE','name'=>'QBE Insurance Group','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'RHC','name'=>'Ramsay Health Care','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'RIO','name'=>'RIO Tinto Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'S32','name'=>'SOUTH32 Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SCG','name'=>'Scentre Group','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SEK','name'=>'Seek Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SGP','name'=>'Stockland','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SHL','name'=>'Sonic Healthcare','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'STO','name'=>'Santos Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SUN','name'=>'Suncorp Group Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SVW','name'=>'Seven Group Holdings Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SXL','name'=>'STHN Cross Media','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'SYD','name'=>'SYD Airport','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'TAH','name'=>'Tabcorp Holdings Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'TNE','name'=>'Technology One','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'TLS','name'=>'Telstra Corporation','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'TWE','name'=>'Treasury Wine Estate','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'WBC','name'=>'Westpac Banking Corporation','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'WES','name'=>'Wesfarmers Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'WFD','name'=>'Westfield Corporation','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'WOW','name'=>'Woolworths Group Limited','value'=>0.00]);
		DB::table('shares')->insert(['code'=>'WPL','name'=>'Woodside Petroleum','value'=>0.00]);
    }
}
