<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_secondary' => $faker->unique()->safeEmail,
        'cpf' => $faker->numberBetween(00000000000, 99999999999),
        'cel' => $faker->regexify("^[1-9]{2}(?:[2-8]|9[1-9])[0-9]{3}[0-9]{4}$"),
        'address' => $faker->address,
        'status' => $faker->randomElement(['user', 'collaborator']),
        'email_verified_at' => now(),
        'cel_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
