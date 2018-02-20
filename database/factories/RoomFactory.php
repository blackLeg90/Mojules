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

$factory->define(App\Models\Room::class, function (Faker $faker) {
    return [
        'roomImage' => str_random(10) . '.png',
        'roomName' => str_random(10),
        'home_id' => function () {
            return factory(App\Models\Home::class)->create()->id;
        }
    ];
});