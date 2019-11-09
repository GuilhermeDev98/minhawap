<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Guilherme Santos',
            'email' => 'guilhermedev@hotmail.com',
            'cpf' => '84611006549',
            'cel' => '79999042394',
            'email_verified_at' => now(),
            'cpf_verified_at' => now(),
            'password' => Hash::make('secret'),
            'status' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);

        factory(App\User::class, 5)->create();
    }
}
