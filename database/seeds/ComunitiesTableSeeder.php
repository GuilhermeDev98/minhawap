<?php

use Illuminate\Database\Seeder;
use App\Comunity;

class ComunitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Comunity::create([
            'name' => 'EvolutionWap',
            'link' => 'https://evolutionwap.herokuapp.com',
            'active' => 0,
            'status' => 'WA',
            'user_id' => 1,
            'plan_id' => 2,
            'due_date' => '10',
            'billing_cycle' => '1'
        ]);
    }
}
