<?php

use Illuminate\Database\Seeder;

class ProjectsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Models\Project::class, 1)->create()->each(function ($p) {
            factory(App\Models\Layout::class, 1)->create([ 'project_id' => $p->id ]);
        });
    }
}
