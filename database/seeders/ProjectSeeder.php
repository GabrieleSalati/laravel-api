<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Support\Str;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $project = new Project;
        $project->title = "Laravel Backoffice CRUD";
        $project->slug = Str::of($project->title)->slug('-');
        $project->description = "Base CRUD function development project";
        $project->image = "C:\coding_projects\laravel-auth\public\Screenshot (9).png";
        $project->link = "https://github.com/GabrieleSalati/laravel-base-crud";

        $project->save();
    }
}
