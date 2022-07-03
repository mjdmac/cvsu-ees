<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChatbotSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chatbots')->insert([
            [
                'category' =>  'Requirements',
                'question' => 'If I submitted the requirements online last semester, can I use that again to apply this 1st semester SY2021-2022?',
                'answer' => 'No need, you just submit your application to the gates of CvSU, to the guard. There is a drop box for the application.',
            ],
            [
                'category' =>  'Requirements',
                'question' => 'How about me, a graduate of SHS last 2020, do I still need to certify the grades with my former adviser even though I already have my final report card?',
                'answer' => 'There is no need to submit certification of grades from class adviser (form) if you are an SHS graduate.',
            ],
            [
                'category' =>  'Courses',
                'question' => 'I would like to ask regarding the courses offered within my strand. If I can shift to other course, what are the processes, or if there is a way, I can take that course this semester?',
                'answer' => 'The course you want is not aligned with the strand. Course shifting is only possible after a semester or a year. And it depends on the College’s evaluation and their policy on shifting. As a new student, you can only apply to courses that are aligned with your strand.',
            ],
            [
                'category' =>  'Admission',
                'question' => 'I just ask why the course I want is not in the option choices in the application form?',
                'answer' => 'It may be that the course you want is not aligned with your strand',
            ],
            [
                'category' =>  'Courses',
                'question' => 'I plan to apply at two CvSU campuses. I was able to answer the application but when I wanted to try to apply again, the system did not allow me. Is there a chance that I can submit an application on both campuses?',
                'answer' => 'You can only answer once in the online admission system. Having multiple registers of one applicant is avoided especially now that the admission system of almost all CvSU Campuses are all the same. If you really want to transfer an application from one Campus to another, you need to contact OSAS first.',
            ],
            [
                'category' =>  'Courses',
                'question' => 'About multiple registration. There are applicants who have been admitted to various campuses. Is this ok?',
                'answer' => 'It is not okay. Applicants must submit only one application',
            ],
            [
                'category' =>  'Contact Information',
                'question' => 'Office of the Student Affairs and Services (OSAS)',
                'answer' => 'Email: cvsumainosas@cvsu.edu.ph | Contact Number: (046) 481-8722',
            ],
            [
                'category' =>  'Contact Information',
                'question' => 'University Webmaster ',
                'answer' => 'Email: webmaster@cvsu.edu.ph',
            ],
            [
                'category' =>  'Contact Information',
                'question' => 'Office of the University Registrar',
                'answer' => 'Email: registrarmain@cvsu.edu.ph | Contact Number: (046) 862-0853',
            ],
        ]);
    }
}
