<?php

use Illuminate\Database\Seeder;
use App\OfferPlan;

class OffersPlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OfferPlan::create([
            'offer_id' => '1',
            'plan_id' => '1',
        ]);
        OfferPlan::create([
            'offer_id' => '2',
            'plan_id' => '1',
        ]);
    }
}
