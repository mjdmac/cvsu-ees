<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class ApplicantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $applicant_id = IdGenerator::generate(['table' => 'applicants', 'length' => 10, 'prefix' => date('ym'), 'reset_on_prefix_change' => true]);

        DB::table('users')->insert([
            [
            'name' =>  'Tristan Sangangbayan',
            'email' => 'sangangbayant@gmail.com',
            'phone' => '639072203266',
            'role' => 'applicant',
            'password' => bcrypt('changetorandomstring')
            ],
            [
            'name' =>  'Dan Lloyd Rosarda',
            'email' => 'danlloyd.rosarda@cvsu.edu.ph',
            'phone' => '639761830787',
            'role' => 'applicant',
            'password' => bcrypt('changetorandomstring')
            ],
        ]);

        DB::table('applicants')->insert([
            [
                'user_id' => '3',
                'fname' => 'Tristan',
                'mname' => 'Martinez',
                'lname' => 'Sangangbayan',
                'birthday' => '2000-08-31',
                'email' => 'sangangbayant@gmail.com',
                'phone_number' => '639072203266',
            ],
            [
                'user_id' => '4',
                'fname' => 'Dan Lloyd',
                'mname' => '',
                'lname' => 'Rosarda',
                'birthday' => '1999-07-03',
                'email' => 'danlloyd.rosarda@cvsu.edu.ph',
                'phone_number' => '639761830787',
            ],
        ]);
    }
}
