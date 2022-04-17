<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Events\AfterSheet;

class UsersExport implements FromCollection, WithEvents, WithHeadings, ShouldAutoSize
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return User::all();

        $data = User::select(\DB::raw('users.id as ID, users.name as Name, users.role as Role, users.email as Email, users.phone as Phone_Number, date_format(users.created_at, "%d %M %Y") as Date_Created'))
            ->orderBy('users.name')
            ->get();

        $data = $data->each(function ($d)
        {
            $d->setAppends([]);
        });

        return $data;
    }

    public function headings(): array
    {
        return ['ID', 'Name', 'Role', 'Email', 'Phone Number', 'Date Created'];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class =>  function (AfterSheet $event)
            {
                $cellRange = 'A1:F1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->getSize(17);
            },
        ];
    }
}
