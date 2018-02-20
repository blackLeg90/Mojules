<?php

use Illuminate\Database\Seeder;

class HomesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Home::class, 1)->create()->each(function ($h) {
            factory(App\Models\Room::class, 1)->create([ 'home_id' => $h->id ])->each(function ($r) {
                factory(App\Models\Material::class, 1)->create([ 'room_id' => $r->id ])->each(function ($m) {
                    factory(App\Models\Image::class, 1)->create([ 'material_id' => $m->id ]);
                });
            });
        });
    }
}
