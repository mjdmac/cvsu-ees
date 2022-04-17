<?php

namespace App\Exports;

use App\Models\College;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class CollegesExport implements FromCollection, WithEvents, WithHeadings, ShouldAutoSize
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        // return User::all();

        $data = College::select(\DB::raw('colleges.id as ID, colleges.college_name as College, colleges.college_desc as College_Description, date_format(colleges.created_at, "%d %M %Y") as Date_Created'))
            ->orderBy('colleges.college_name')
            ->get();

        $data = $data->each(function ($d)
        {
            $d->setAppends([]);
        });

        return $data;
    }

    public function headings(): array
    {
        return ['ID', 'College', 'College Description', 'Date Created'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class =>  function (AfterSheet $event)
            {
                $cellRange = 'A1:D1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getSize(17);
            },
        ];
    }
}
