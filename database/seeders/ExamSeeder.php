<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('exams')->insert([
            [
                'exam_code' => 'EXM-001',
                'subject' =>  'Abstract',
                'description' => 'Test exam',
                'duration' => '15',
                'status' => 'inactive',
            ],
            [
                'exam_code' => 'EXM-002',
                'subject' =>  'English',
                'description' => 'Test exam2',
                'duration' => '15',
                'status' => 'inactive',
            ],
            [
                'exam_code' => 'EXM-003',
                'subject' =>  'Math',
                'description' => 'Test exam 3',
                'duration' => '15',
                'status' => 'inactive',
            ],
        ]);
    }
}
