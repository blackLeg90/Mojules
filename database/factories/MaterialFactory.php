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

$factory->define(App\Models\Material::class, function (Faker $faker) {
  return [
      'materialName' => $faker->name,
      'room_id' => factory(App\Models\Room::class)->create()->id,
  ];
});