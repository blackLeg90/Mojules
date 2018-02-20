<?php

use Faker\Generator as Faker;

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

$factory->define(App\Models\Home::class, function (Faker $faker) {
    return [
        'homeName' => str_random(10),
        'availableTypes' => App\Models\Home::$TYPES[rand(0, 5)],
        'layoutAvailable' => App\Models\Home::$LAYOUTS[rand(0, 1)]
    ];
});