<?php

use Illuminate\Database\Seeder;
use App\Note;

class NotesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Note::create([
            'text' => ' Lorem ipsum dolor sit amet consectetur adipisicing elit. Dolorem veniam modi quisquam doloribus iusto ipsam voluptatum quae culpa accusamus perferendis. ',
            'comunity_id' => 1,
            'user_id' => 1
        ]);
    }
}
