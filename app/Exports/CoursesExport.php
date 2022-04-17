<?php

namespace App\Exports;

use App\Models\Course;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CoursesExport implements FromCollection, WithEvents, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $data = Course::join('colleges', 'courses.college_id', '=', 'colleges.id')
            ->select(\DB::raw('colleges.college_name as College, courses.id as ID, courses.course_name as Course_Code, courses.course_desc as College_Description, date_format(courses.created_at, "%d %M %Y") as Date_Created'))
            ->orderBy('courses.course_name')
            ->get();

        $data = $data->each(function ($d) {
            $d->setAppends([]);
        });

        return $data;
    }

    public function headings(): array
    {
        return ['College', 'ID', 'Course Code', 'College Title', 'Date Created'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class =>  function (AfterSheet $event) {
                $cellRange = 'A1:E1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getSize(17);
            },
        ];
    }
}
