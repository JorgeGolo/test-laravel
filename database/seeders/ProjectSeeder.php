<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $Project = new Project();
        $Project->name='Proyecto Alfa';

        $Project->save();

        $Project2 = new Project();
        $Project2->name='Proyecto Beta';

        $Project2->save();

        $Project3 = new Project();
        $Project3->name='Proyecto Gamma';

        $Project3->save();
    }
}
