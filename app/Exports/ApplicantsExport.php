<?php

namespace App\Exports;

use App\Models\Applicant;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;

class ApplicantsExport implements FromCollection, WithEvents, WithHeadings, ShouldAutoSize, WithColumnFormatting
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return User::all();

        $data = Applicant::select(\DB::raw('applicants.id as Control_Number, 
                                            applicants.fname as First_Name, 
                                            applicants.mname as Middle_Name, 
                                            applicants.lname as Last_Name, 
                                            applicants.email as Email, 
                                            applicants.phone_number as Phone_Number, 
                                            date_format(applicants.created_at, "%d %M %Y") as Date_Created'))
            ->orderBy('applicants.id')
            ->get();

        $data = $data->each(function ($d) {
            $d->setAppends([]);
        });

        return $data;
    }

    public function headings(): array
    {
        return ['Control Number', 'First Name', 'Middle Name', 'Last Name', 'Email', 'Phone Number', 'Date Added'];
    }

    public function columnFormats(): array
    {
        return [
            'F' => NumberFormat::FORMAT_NUMBER,
        ];
    }



    public function registerEvents(): array
    {
        return [
            AfterSheet::class =>  function (AfterSheet $event) {
                $cellRange = 'A1:G1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getSize(12);
            },
        ];
    }
}
