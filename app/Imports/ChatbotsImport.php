<?php

namespace App\Imports;

use App\Models\Chatbot;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ChatbotsImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Chatbot([
            'category' => $row['category'],
            'question' => $row['question'],
            'answer' => $row['answer'],
        ]);
    }
}
