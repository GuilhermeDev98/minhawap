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
            'active' => 1,
            'status' => 'OA',
            'user_id' => 1
        ]);
    }
}
