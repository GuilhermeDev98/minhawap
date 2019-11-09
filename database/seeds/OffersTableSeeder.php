<?php

use Illuminate\Database\Seeder;
use App\Offer;

class OffersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Offer::create([
            'name' => '2GB_disk_space',
            'description' => '2GB de Espaço em Disco',
            'value' => '1'
        ]);

        Offer::create([
            'name' => '2GB_disk_space_discount',
            'description' => 'Desconto 2GB de Espaço em Disco',
            'value' => '1',
            'discount' => 1
        ]);
    }
}
