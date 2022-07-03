<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CollegeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('colleges')->insert([
            [
            'college_name' =>  'CEIT',
            'college_desc' => 'College of Engineering and Information Technology',
            ],
            [
            'college_name' =>  'CON',
            'college_desc' => 'College of Nursing',
            ],
            [
            'college_name' =>  'CED',
            'college_desc' => 'College of Education',
            ],
            [
            'college_name' =>  'CAS',
            'college_desc' => 'College of Arts and Sciences',
            ],
            [
            'college_name' =>  'CAFENR',
            'college_desc' => 'College of Agriculture, Food, Environment, and Natural Resources',
            ],
            [
            'college_name' =>  'CEMDS',
            'college_desc' => 'College of Economic Management and Development Studies Technology',
            ],
            [
            'college_name' =>  'CCJ',
            'college_desc' => 'College of Criminal Justice',
            ],
            [
            'college_name' =>  'CSPEAR',
            'college_desc' => 'College of Sports, Physical Education, and Recreation',
            ],
            [
            'college_name' =>  'CVMBS',
            'college_desc' => 'College of Veterenary Medicine, and Biomedical Sciences',
            ],
        ]);
    }
}
