<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Skills;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Skills::create([
        	'name' => 'AJAX', 
        ]);

         Skills::create([
        	'name' => 'HTML', 
        ]);

        Skills::create([
        	'name' => 'Automation', 
        ]);

        Skills::create([
        	'name' => 'Web Development', 
        ]);
        Skills::create([
        	'name' => 'Data Mining', 
        ]);

        Skills::create([
        	'name' => 'Beautiful Soup',  
        ]);

        Skills::create([
        	'name' => 'Scrapy', 
        ]);

        Skills::create([
        	'name' => 'Lead Generation', 
        ]);

        Skills::create([
        	'name' => 'Code Igniter', 
        ]);

        Skills::create([
        	'name' => 'PHP', 
        ]);

        Skills::create([
        	'name' => 'Python', 
        ]);

        Skills::create([
        	'name' => 'Web Designer', 
        ]);

        Skills::create([
        	'name' => 'Moderator', 
        ]);

        Skills::create([
        	'name' => 'Dance Instructor', 
        ]);
        //
    }
}
