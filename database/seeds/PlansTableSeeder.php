<?php

use Illuminate\Database\Seeder;
use App\Plan;

class PlansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::create([
            'name' => 'plan_free_1gb_bonus_12_m',
            'name_descriptive' => 'Plano Free + 1GB de Bônus 12 Meses	',
            'value' => '0',
            'type' => 'free'
        ]);
        Plan::create([
            'name' => 'plan_gold_2gb_bonus_12_m	',
            'name_descriptive' => 'Plano Gold + 2GB de Bônus 12 Meses	',
            'value' => '25'
        ]);
        Plan::create([
            'name' => 'plan_diamond',
            'name_descriptive' => 'Plano Diamante',
            'value' => '50'
        ]);
    }
}
